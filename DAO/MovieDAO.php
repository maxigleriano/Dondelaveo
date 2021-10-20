<?php

    namespace DAO;

    use Models\Movie as Movie;
    use Models\Provider as Provider;

    class movieDAO 
    {
        public function getMovie($id) 
        {
            $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/$id?api_key=" . API_KEY . "&language=es");
            
            $jsonToDecode = json_decode($jsonContent, true);

            $movie = null;

            if($id == $jsonToDecode["id"]) 
            {
                $movie = new Movie();

                $movie->setId($jsonToDecode["id"]);
                $movie->setPosterPath("http://image.tmdb.org/t/p/original" . $jsonToDecode["poster_path"]);
                $movie->setBackdropPath("http://image.tmdb.org/t/p/original" . $jsonToDecode["backdrop_path"]);
                $movie->setTitle($jsonToDecode["title"]);
                $movie->setVoteAverage($jsonToDecode["vote_average"]);
                $movie->setOverview($jsonToDecode["overview"]);
                $movie->setReleaseDate(date($jsonToDecode["release_date"]));
                $movie->setRuntime($jsonToDecode["runtime"]);

                $jsonProviders = file_get_contents("https://api.themoviedb.org/3/movie/" . $movie->getId() . "/watch/providers?api_key=" . API_KEY);   
                $toDecode = json_decode($jsonProviders);
                if (!empty($toDecode->results->AR->flatrate)) {
                    $_flatrate = $toDecode->results->AR->flatrate;

                    if($_flatrate)
                    {
                        $provider_list = array();
                        foreach($_flatrate as $provider) 
                        {
                            array_push($provider_list, $provider->provider_id);
                        }
                        $movie->setProviders($provider_list);
                    }
                }
            }

            return $movie;
        }

        public function getByName($movieTitle) 
        {
            $newTitle = str_replace(" ", "%20", $movieTitle);

            $jsonContent = file_get_contents("https://api.themoviedb.org/3/search/movie?api_key=" . API_KEY . "&language=es&query=" . $newTitle);
            
            $arrayToDecode = json_decode($jsonContent, true);

            $movieList = null;

            if($arrayToDecode["results"])
            {
                $movieList = array();

                foreach($arrayToDecode["results"] as $valueArray) 
                {  
                    $movie = new Movie();
                    
                    $movie->setId($valueArray["id"]);
                    $movie->setTitle($valueArray["title"]);
                    $movie->setPosterPath("http://image.tmdb.org/t/p/original" . $valueArray["poster_path"]);
                    $movie->setBackdropPath("http://image.tmdb.org/t/p/original" . $valueArray["backdrop_path"]);
                    $movie->setVoteAverage($valueArray["vote_average"]);
                    $movie->setOverview($valueArray["overview"]);
    
                    /*Get the providers of the movie from the api*/
    
                    $jsonProviders = file_get_contents("https://api.themoviedb.org/3/movie/" . $movie->getId() . "/watch/providers?api_key=" . API_KEY);   
                    $toDecode = json_decode($jsonProviders);
                    if (!empty($toDecode->results->AR->flatrate)) {
                        $_flatrate = $toDecode->results->AR->flatrate;
    
                        if($_flatrate)
                        {
                            $providerList = array();
                            foreach($_flatrate as $provider) 
                            {
                                array_push($providerList, $provider->provider_id);
                            }
                            $movie->setProviders($providerList);
                        }
                    }
    
                    array_push($movieList, $movie);
                }
            }

            return $movieList;
        }

        public function getTrailer($id) 
        {
            $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/$id/videos?api_key=" . API_KEY . "&language=es-ES");
            
            $jsonToDecode = json_decode($jsonContent, true);

            $trailer = null;

            if(isset($jsonToDecode["results"][0])) 
            {
                $trailer = $jsonToDecode["results"][0]["key"];
            }

            return $trailer;
        }
    }
