document.addEventListener('DOMContentLoaded', () => {
    if ('loading' in HTMLImageElement.prototype) {
        var images = document.querySelectorAll('img.lazy');
        var windowHeight = window.innerHeight;
        var containerWidth =  document.querySelector('.image').clientWidth;
        images.forEach(img => {
            if (parseInt(img.style.height, 10) > windowHeight) {
                img.style.height = windowHeight + 'px';
            } else {
                var ratio = parseInt(img.width, 10) / parseInt(img.height, 10);
                img.style.height = containerWidth / ratio + 'px';
            }
            img.src = img.dataset.src;
        });
    } else {
        let script = document.createElement("script");
        script.async = true;
        script.src =
            "https://cdnjs.cloudflare.com/ajax/libs/lazysizes/4.1.8/lazysizes.min.js";
        document.body.appendChild(script);
    }
})


