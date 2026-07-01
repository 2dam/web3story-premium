(function () {
    document.querySelectorAll('a[href]').forEach(function (a) {
        try {
            var url = new URL(a.href);
            if (url.hostname !== location.hostname) {
                a.setAttribute('target', '_blank');
                a.setAttribute('rel', 'noopener noreferrer');
            }
        } catch (e) {}
    });
})();
