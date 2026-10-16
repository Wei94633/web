
const form = document.getElementById("productForm");
const message = document.getElementById("message");

form.addEventListener("submit", function(event) {
    event.preventDefault();

    const type = document.getElementById("type").value;
    const brand = document.getElementById("brand").value;
    const price = document.getElementById("price").value;
    const stock = document.getElementById("stock").value;

    message.textContent = "";

    const params = new URLSearchParams({
        type: type,
        brand: brand,
        price: price,
        stock: stock
    });

    fetch("task06.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: params.toString()
    })
        .then(function(response) {
            return response.json().then(function(data) {
                if (!response.ok) {
                    throw new Error(data.error || "Request failed");
                }

                return data;
            });
        })
        .then(function(data) {
            message.textContent = data.message;
            message.className = "mt-3 text-success";
        })
        .catch(function(error) {
            message.textContent = error.message;
            message.className = "mt-3 text-danger";
        });
});
