(function () {
    var bar = document.createElement('div');
    bar.id = 'read-progress';
    document.body.prepend(bar);
    window.addEventListener('scroll', function () {
        var scrollTop = window.scrollY;
        var docHeight = document.documentElement.scrollHeight - window.innerHeight;
        var pct = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        bar.style.width = pct.toFixed(2) + '%';
    }, { passive: true });
})();
