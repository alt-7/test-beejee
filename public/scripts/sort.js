$(document).ready(function () {
    $('.sort').on('click', function (event) {
        event.preventDefault();
        var sort = $(this).attr('data-sort'),
            refresh = window.location.protocol + "//" + window.location.host + window.location.pathname + '?sort=' + sort;
        window.history.pushState({ path: refresh }, '', refresh);
        window.location.href = refresh;
    });
});
