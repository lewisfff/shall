document.addEventListener('DOMContentLoaded', () => {
    if ('loading' in HTMLImageElement.prototype) {
        sizeImages();
    }

    var links = document.querySelectorAll('.side-image');

    for (let i = 0; i < links.length; i++) {
        links[i].addEventListener("click", function (e) {
            e.preventDefault();
            var alt = links[i].children[0].alt;
            window.location.hash = alt;
            var scrollElem = document.querySelector('.lazy[alt="' + alt + '"]');
            scrollElem.scrollIntoView({behavior: "smooth", block: "center", inline: "nearest"});
        });
    }

    if (window.location.hash.length > 2) {
        var alt = decodeURI(window.location.hash.substring(1));
        var scrollElem = document.querySelector('.lazy[alt="' + alt + '"]');
        scrollElem.scrollIntoView({behavior: "smooth", block: "center", inline: "nearest"});
    }

    var doit;
    window.onresize = function () {
        clearTimeout(doit);
        doit = setTimeout(resizedw, 100);
    };
});

function resizedw() {
    sizeImages();
}

function sizeImages() {
        var images = document.querySelectorAll('img.lazy');
        var windowHeight = window.innerHeight;
        var containerWidth = document.querySelector('.image').clientWidth;
        images.forEach(img => {
            var ratio = parseInt(img.width, 10) / parseInt(img.height, 10);
            img.style.height = containerWidth / ratio + 'px';
            if (parseInt(img.style.height, 10) > windowHeight) {
                img.style.height = windowHeight + 'px';
            }
            img.src = img.dataset.src;
        });
}
