(function () {
    var btn = document.getElementById('dark-toggle');
    var body = document.body;
    var KEY = 'web3-dark';

    if (localStorage.getItem(KEY) === '1') {
        body.classList.add('dark-mode');
        if (btn) btn.textContent = '☀️';
    }
    if (!btn) return;
    btn.addEventListener('click', function () {
        var isDark = body.classList.toggle('dark-mode');
        localStorage.setItem(KEY, isDark ? '1' : '0');
        btn.textContent = isDark ? '☀️' : '🌙';
    });
})();
