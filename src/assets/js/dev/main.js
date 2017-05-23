window.onbeforeunload = function() {
    window.scrollTo(0, 0);
}
(function() {
    window.addEventListener("DOMContentLoaded", function () {

        const searchForm = document.querySelector('.search-form'),
              searchSection = document.querySelector('.search'),
              searchFormButtom = document.querySelector('.search-form .fa-search'),
              body             = document.body,
              navSearchButton  = document.querySelector('.navbar-default .search-icon-lnk'),
              blogGallery = document.querySelector('.blogs'),
              popular = document.querySelectorAll('.sort>h1>span');

              $('.loader-container').hide();

        popular.forEach((el) => {
            el.addEventListener("click", (e) => {
                if(e.target === popular[0] && e.target.classList.contains("selected") === false) {
                    removeClass(popular, "selected");
                    el.classList.add("selected");
                    $('.loader-container').show();
                    $('.blogs').fadeOut(() => {
                        $.ajax({
                            cache: false,
                            url: "/blog_gallery_pop.php",
                            success: function(response) {
                                $('.loader-container').hide();
                                let oldResponse;
                                $('.blogs').html(response).fadeIn();
                                oldResponse = response;
                            }
                        });
                    });
                } else if(e.target === popular[1] && e.target.classList.contains("selected") === false) {
                    removeClass(popular, "selected");
                e.target.classList.add("selected");
                    $('.blogs').fadeOut(() => {
                        $.ajax({
                            url: "/blog_gallery_new.php",
                            success: function(response) {
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
