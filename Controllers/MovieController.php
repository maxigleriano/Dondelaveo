<?php
    namespace Controllers;

    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;

    use DAO\ProviderDAO as ProviderDAO;
    use Models\Provider as Provider;

    class MovieController
    {
        private $movieDAO;
        private $providerDAO;

        public function __construct() {
            $this->movieDAO = new MovieDAO();
            $this->providerDAO = new ProviderDAO();
        }

        public function search($movieName)
        {
            if(trim($movieName)) {
                $movieList = $this->movieDAO->getByName($movieName);
                if($movieList)
                {
                    require_once(VIEWS_PATH."searchResults.php");
                }
                else
                {
                    echo '<script language="javascript">alert("No hay resultados para tu busqueda");</script>'; 
                    $this->Index(); 
                }  
            }
            else {
                echo '<script language="javascript">alert("No puede haber campos en blanco");</script>'; 
                $this->Index();  
            }
        }

        public function getMovie($movieId)
        {
            $movie = $this->movieDAO->getMovie($movieId);
            $trailer = $this->movieDAO->getTrailer($movieId);

            if($movie) {
                require_once(VIEWS_PATH."movieDetails.php");
            }
            else
            {
                echo '<script language="javascript">alert("No encontramos la pelicula que estabas buscando. Por favor vuelva a intentarlo.");</script>'; 
                $this->Index(); 
            }
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."index.php");
        }
    }
 