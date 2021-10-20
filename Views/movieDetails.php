<body style="background-color: #2f3640;">
    <main>
        <div class="container">
            <div class="movie-container">
                <div class="movie">
                    <div class="movie-img">
                            <img src="<?php echo $movie->getPosterPath()?>" alt="<?php echo $movie->getTitle() ?>">
                    </div>

                    <div class="movie-details">
                        <h3> <a href="<?php echo FRONT_ROOT ?>Movie/getMovie/<?php echo $movie->getId()?>"><?php echo $movie->getTitle() ?></a><span>(<i class="fas fa-star"></i> <?php echo $movie->getVoteAverage() ?>)</span></h3>
                        <p> <?php echo $movie->getOverview() ?> </p>
                        
                        <div class="providers">
                            <?php if($movie->getProviders()) {
                                foreach($movie->getProviders() as $id) { 
                                $provider = $this->providerDAO->getProvider($id);   
                            ?>

                                <a href="<?php echo $provider->getUrl() ?>" target="_blank">
                                    <img src="<?php echo $provider->getLogo() ?>" width="35px" height="35px" alt="<?php echo $provider->getName() ?>">
                                </a>

                            <?php } }else{ ?>
                                <p>No disonible en tu region</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php if($trailer) { ?>
                    <span class="trailer">Trailer</span>
                    <div class="embed-container">
                        <iframe 
                            src="https://www.youtube.com/embed/<?php echo $trailer ?>" 
                            title="YouTube video player" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                <?php } ?>
                
            </div>
        </div>
    </main>

    <script type="text/javascript">
        $(".menu-toggle-btn").click(function(){
            $(this).toggleClass("fa-times");
            $(".navigation-menu").toggleClass("active");
        });
    </script>
</body>