(function() {
    $(window).scrollTop(0)
    window.addEventListener("DOMContentLoaded", function () {

        const searchForm            = document.querySelector('.search-form'),
              searchSection         = document.querySelector('.search'),
              searchFormButtom      = document.querySelector('.search-form .fa-search'),
              body                  = document.body,
              navSearchButton       = document.querySelector('.navbar-default .search-icon-lnk'),
              blogGallery           = document.querySelector('.blogs'),
              popular               = document.querySelectorAll('.sort>h1>span'),
              navigation            = document.querySelector('.navbar-default'),
              $wrapper              = $('.wrapper'),
              logo                  = document.querySelector('.logo'),
              $landingImg           = $('.home-jumbotron'),
              range                 = 800,
              speed                 = 0.5;

/**
 * Loader Default State
 */

/**
 * Blogs Preview Default State
 */

$('.blogs').fadeOut(() => {
            $.ajax({
            cache: false,
            url: "/blog_gallery_new.php",
            success: function(response) {

                $('.loader-container').fadeOut().hide();
                $('.blogs').html(response).fadeIn();
            }
        });
    });

        window.onscroll = function() {
            /**
             * Navigation Background Color
             */
            var y = this.pageYOffset,
                $wrapperLoc = $wrapper.offset().top;
    
            if (y > $wrapperLoc) {
                navigation.classList.add('nav-bg');
            } else if (y < $wrapperLoc) {
                navigation.classList.remove('nav-bg');
            }

            /**
             * Landing Image Opacity
             */

             var $scrollTop        = $(this).scrollTop(),
                 $landingImgOffset = $landingImg.offset().top,
                 $landingImgHeight = $landingImg.outerHeight();

             $landingImgOffset     = $landingImgOffset + $landingImgHeight / 2;
             
             var $calc             = 1.4 - ($scrollTop - $landingImgOffset + range) / range;
             $landingImg.css({ 'opacity': $calc });

             if ($calc > '1' ) {
                 $landingImg.css({ 'opacity': 1 });
             } else if ( $calc < '0') {
                 $landingImg.css({ 'opacity': 0 });
             }

             /**
              * Logo Parallax
              */

              $(logo).css({"top": (y * speed) + "px"});

              console.log(y * speed)

            

        };

        popular.forEach((el) => {
            el.addEventListener("click", (e) => {
                if(e.target === popular[0] && e.target.classList.contains("selected") === false) {
                    
                    removeClass(popular, "selected");

                    el.classList.add("selected");
                    
                    $('.blogs').fadeOut(() => {
                        $('.loader-container').fadeIn().show();

                            $.ajax({
                            cache: false,
                            url: "/blog_gallery_pop.php",
                            success: function(response) {
                                $('.loader-container').fadeOut().hide();
                                $('.blogs').html(response).fadeIn();
                            }
                        });
                    });
                } else if(e.target === popular[1] && e.target.classList.contains("selected") === false) {
                    
                    removeClass(popular, "selected");
                    
                    e.target.classList.add("selected");
                    
                    $('.blogs').fadeOut(() => {
                        $('.loader-container').fadeIn().show();
                        $.ajax({
                            url: "/blog_gallery_new.php",
                            success: function(response) {
                                $('.loader-container').fadeOut().hide();
                                $('.blogs').html(response).fadeIn();
                            }
                        });
                    });

                }
                
            });
        });


        searchFormButtom.addEventListener("click", function () {
            searchForm.submit();
        });


        navSearchButton.addEventListener("click", function() {
            if(body.classList.contains('dsble')) {
                body.classList.remove('dsble');
                searchSection.classList.remove('showSearch');
                searchSection.classList.add('hideSearch');
            } else {
                body.classList.add('dsble');
                searchSection.classList.remove('hideSearch');
                searchSection.classList.add('showSearch');
            }
        });
    });

    function removeClass(elName, className) {
        if (elName.length > 0) {
            for(var x = 0; x < elName.length; x++) {
            elName[x].classList.remove(className);
            }
        } else {
            elName.classList.remove(className);
        }
        return elName;
    }



}());
