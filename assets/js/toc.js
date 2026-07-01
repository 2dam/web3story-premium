(function () {
    var content = document.querySelector('.entry-content');
    if (!content) return;
    var headings = content.querySelectorAll('h2, h3');
    if (headings.length < 2) return;

    var toc = document.createElement('div');
    toc.className = 'toc-box';
    var title = document.createElement('p');
    title.className = 'toc-title';
    title.textContent = '목차';
    toc.appendChild(title);

    var list = document.createElement('ul');
    list.className = 'toc-list';
    headings.forEach(function (h, i) {
        var id = 'heading-' + i;
        h.id = id;
        var li = document.createElement('li');
        li.style.paddingLeft = h.tagName === 'H3' ? '16px' : '0';
        var a = document.createElement('a');
        a.href = '#' + id;
        a.textContent = h.textContent;
        li.appendChild(a);
        list.appendChild(li);
    });
    toc.appendChild(list);
    content.insertBefore(toc, content.firstChild);
})();
