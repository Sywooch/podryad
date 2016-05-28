window.onbeforeunload = function () {
    localStorage.setItem('scrollPosition', 0);
};

$(function () {
    $('a').click(function () {
        window.onbeforeunload = null;
    });

    $('form').submit(function () {
        window.onbeforeunload = null;
    });
});
