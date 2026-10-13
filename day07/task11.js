const paragraphs = document.querySelectorAll("p");

paragraphs.forEach(function(paragraph) {

    // Mouse enters
    paragraph.addEventListener("mouseenter", function() {
        paragraph.classList.add("blue");
    });

    // Mouse leaves
    paragraph.addEventListener("mouseleave", function() {
        paragraph.classList.remove("blue");
    });

    // Click
    paragraph.addEventListener("click", function() {
        paragraph.classList.toggle("highlighted");
    });

});