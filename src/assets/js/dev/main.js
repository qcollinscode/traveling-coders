(function() {
    window.addEventListener("DOMContentLoaded", function () {
        const searchForm = document.querySelector('.search-form'),
              searchSection = document.querySelector('.search'),
              searchFormButtom = document.querySelector('.search-form .fa-search'),
              body             = document.body,
              navSearchButton  = document.querySelector('.navbar-default .search-icon-lnk');

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
}());
