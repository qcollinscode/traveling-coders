(function() {
    $(window).scrollTop(0)
    window.addEventListener("DOMContentLoaded", function () {

        const searchForm            = document.querySelector('.search-form'),
              searchSection         = document.querySelector('.search'),
              searchFormButtom      = document.querySelector('.search-form .fa-search'),
              body                  = document.body,
              navSearchButton       = document.querySelector('.search-icon-lnk'),
              blogGallery           = document.querySelector('.blogs'),
              popular               = document.querySelectorAll('.sort>h2>span'),
              navigation            = document.querySelector('.navbar-default'),
              $wrapper              = $('.wrapper'),
              $logo                 = $('.logo'),
              $boardSectionTitle     = $('.boards-section').find('.title'),
              $userSectionTitle     = $('.user-section').find('.title'),
              $threadSectionTitle    = $('.threads-section').find('.title'),
              $boardSectionButton    = $('.boards-section').find('button'),
              $threadSectionButton   = $('.threads-section').find('button'),
              $userSection          = $('.user-section'),
              $landingImg           = $('.home-jumbotron'),
              $userMenu             = $('.user-section').find('.user-menu'),
              $userSectionWrapper   = $('.temp'),
              $userSectionMenuBtn       = $('.user-section').find('.fa-bars'),
              loginFormButton      = document.querySelector('.login-signup>.login-signup-buttons>.login'),
              signupFormButton      = document.querySelector('.login-signup>.login-signup-buttons>.signup'),
              userContentButton    = document.querySelectorAll('.user-content>.tabs>span'),
              userContentPage      = document.querySelectorAll('.user-content-container>div'),
              $loginForm             = $('.login-signup>.login-form-container'),
              $signupForm             = $('.login-signup>.signup-form-container'),
              $commentsLikeButton   = $('.comments-page-bd').find('.fa-heart'),
              range                 = 800,
              speed                 = 0.5;

/**
 * Loader Default State
 */

        window.onscroll = function() {
            /**
             * Navigation Background Color
             */
            var y = this.pageYOffset;

            if($wrapper.length !== 0) {
                var $wrapperLoc = $wrapper.offset().top;
    
                if (y > $wrapperLoc) {
                    navigation.classList.add('nav-bg');
                } else if (y < $wrapperLoc) {
                    navigation.classList.remove('nav-bg');
                }
            }

            if($userSectionWrapper.length !== 0) {
                var $userSectionWrapperLoc = $userSectionWrapper.offset().top - 100;

                if(y > $userSectionWrapperLoc) {
                    if(!$userSectionMenuBtn.hasClass('menu-btn-rotate')) {
                        $userSectionMenuBtn.addClass('menu-btn-clr');
                    }
                    navigation.classList.add('nav-bg');
                } else {
                    $userSectionMenuBtn.removeClass('menu-btn-clr');
                    navigation.classList.remove('nav-bg');
                }

            }

            /**
             * Landing Image Opacity
             */

             if($landingImg.length !== 0) {
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
             }

             /**
              * Logo Parallax
              */

              if ($logo.length !== 0) {
                  $logo.css({"top": (y * speed) + "px"});
              }



              function threadBoardParallax(arr) {
                  var len = arr.length;
                  for(var i = 0; i < len; i++) {
                      arr[i].css({"top": (y * speed) + "px"});
                  }
              }

              if($boardSectionTitle.length !== 0) {
                  threadBoardParallax([$boardSectionTitle]);
              } else if ($threadSectionTitle.length !== 0) {
                  threadBoardParallax([$threadSectionTitle]);
              } else if ($userSectionTitle.length !== 0) {
                  threadBoardParallax([$userSectionTitle]);
              }
            

        };


        /**
         * User Account Menu
         */
         if ($userSectionMenuBtn.length !== 0) {

                function reset() {
                    $(this).removeClass('menu-btn-rotate');
                    $userMenu.removeClass('show-menu');
                    $userSection.removeClass('show-overlay');
                    if(window.pageYOffset > $userSectionWrapper.offset().top - 100) {
                        $(this).addClass('menu-btn-clr');
                    }
                    $("body").css({"overflow": "auto"});
                }

                function showMenu() {
                    $(this).removeClass('menu-btn-clr');
                    $(this).addClass('menu-btn-rotate');
                    $userMenu.addClass('show-menu');
                    $("body").css({"overflow": "hidden"});
                    $userSection.addClass('show-overlay');
                }

                $userSectionMenuBtn.on('click', function(event) {
                    if($(this).hasClass('menu-btn-rotate')) {
                        reset.call(this);
                    } else {
                        showMenu.call(this);
                    }
                    event.stopPropagation();
                });

                $userSection.on('click', function(event) {
                    if(event.target !== $userMenu[0] && event.target === $userSection[0]) {
                        reset.call($userSectionMenuBtn);
                    }
                })
            }



    /**
     * Comment Like Button
     */
    $commentsLikeButton.on('click', function() {
        $.post({
            url: "/comment_likes.php?cid",
            success: function(response) {
                $('.loader-container').fadeOut().hide();
                $('.blogs').html(response).fadeIn();
            }
        });
    });



    /**
     * Search Page
     */


        navSearchButton.addEventListener("click", function(e) {
            
            var event = window.event || e;
            // Prevent browser refresh
            e.preventDefault();


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


/**
 * Login/Signup Page 
 */
        if( loginFormButton !== null) {
            var formButtons = [loginFormButton, signupFormButton];
        
            $signupForm.hide();

            formButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    removeClass(formButtons, "login-signup-selected");
                    this.classList.add('login-signup-selected');
                    if(this === formButtons[0]) {
                        $signupForm.fadeOut(function() {
                            $signupForm.hide();
                        });
                        $loginForm.fadeIn();
                    } else if (this === formButtons[1]) {
                        $loginForm.fadeOut(function() {
                            $loginForm.hide();
                        });
                        $signupForm.fadeIn();
                    }
                });
            });
        }

/**
 * User Page 
 */
        if( userContentButton !== null) {
        var blogsPage = userContentPage[0],
            threadsPage = userContentPage[1],
            commentsPage = userContentPage[2];            

            userContentButton.forEach(function(button) {
                button.addEventListener('click', function() {
                    removeClass(userContentButton, "selected");
                    this.classList.add('selected');

                    if(this.classList.contains("blogs-tab")) {
                        fadeHideShow([threadsPage, commentsPage], blogsPage);
                    } else if(this.classList.contains("threads-tab")) {
                        fadeHideShow([blogsPage, commentsPage], threadsPage);
                    } else if(this.classList.contains("comments-tab")) {
                        fadeHideShow([blogsPage, threadsPage], commentsPage);
                    }


                });
            });
        }


    });

    function fadeHide(arr) {
        var len = arr.length;
        for(var i = 0; i < len; i++) {
            $(arr[i]).fadeOut(function() {
                $(arr[i]).hide();
            });
        }
    }

    function fadeHideShow(arr, el) {
        fadeHide(arr);
        $(el).fadeIn(function() {
            $(el).show()
        });
    }

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
