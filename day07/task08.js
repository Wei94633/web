const links = document.querySelectorAll('a:not([target="_blank"])');

links.forEach(function(link) {
    link.style.opacity = "0.5";
});