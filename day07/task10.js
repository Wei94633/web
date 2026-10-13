const input = document.querySelector("#listItem");
const button = document.querySelector("button");

button.addEventListener("click", function() {
    const div = document.createElement("div");

    div.textContent = input.value;

    input.after(div);

    input.value = "";
});