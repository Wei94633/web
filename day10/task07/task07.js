
const form = document.getElementById("chatForm");
const chatBox = document.getElementById("chatBox");
const errorMessage = document.getElementById("errorMessage");

// Load chat messages
function loadMessages() {
    fetch("task07.php")
        .then(function(response) {
            if (!response.ok) {
                throw new Error("Failed to load messages.");
            }

            return response.json();
        })
        .then(function(data) {
            chatBox.innerHTML = "";

            data.messages.forEach(function(item) {
                const paragraph = document.createElement("p");

                const name = document.createElement("strong");
                name.textContent = item.name + ": ";

                const message = document.createElement("span");
                message.textContent = item.message;

                paragraph.appendChild(name);
                paragraph.appendChild(message);

                chatBox.appendChild(paragraph);
            });
        })
        .catch(function(error) {
            errorMessage.textContent = error.message;
        });
}

// Send a message
form.addEventListener("submit", function(event) {
    event.preventDefault();

    const name = document.getElementById("name").value;
    const message = document.getElementById("message").value;

    errorMessage.textContent = "";

    const params = new URLSearchParams({
        name: name,
        message: message
    });

    fetch("task07.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: params.toString()
    })
        .then(function(response) {
            return response.json().then(function(data) {
                if (!response.ok) {
                    throw new Error(data.error || "Failed to send message.");
                }

                return data;
            });
        })
        .then(function(data) {
            document.getElementById("message").value = "";
            loadMessages();
        })
        .catch(function(error) {
            errorMessage.textContent = error.message;
        });
});

// Load messages when opening the page
loadMessages();

// Refresh messages every 4 seconds
setInterval(loadMessages, 4000);
