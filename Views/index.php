<body>
    <main>
        <div class="wrapper">
            <div class="box">
                <div class="search-box">
                    <form action="<?php echo FRONT_ROOT ?>Movie/search" method="get">
                        <input class="search-txt" type="text" name="movieName" placeholder="Busqueda de Peliculas" required autocomplete="off">
                        <button type="submit" class="search-button">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
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