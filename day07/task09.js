const button = document.querySelector("button");
const paragraphs = document.querySelectorAll("p");

button.addEventListener("click", function() {
    paragraphs.forEach(function(paragraph) {
        paragraph.style.display = "none";
    });
});