console.log("Task07 JavaScript loaded!");

const box = document.querySelector("footer div");
const link = document.querySelector("footer a");
const footer = document.querySelector("footer");

// Check cookie
function checkCookie() {
    if (document.cookie.split("; ").includes("acceptsCookies=true")) {
        box.style.display = "none";
        showDeleteButton();
    } else {
        box.style.display = "block";
    }
}

// Show delete button
function showDeleteButton() {
    const deleteBox = document.createElement("div");
    const button = document.createElement("button");

    button.textContent = "Delete the cookie";

    deleteBox.appendChild(button);
    footer.appendChild(deleteBox);

    button.addEventListener("click", function() {
        document.cookie = "acceptsCookies=; max-age=0; path=/";
        deleteBox.remove();
        box.style.display = "block";
    });
}

// Accept cookie
link.addEventListener("click", function(event) {
    event.preventDefault();

    document.cookie = "acceptsCookies=true; max-age=86400; path=/";

    checkCookie();
});

// Check on page load
checkCookie();