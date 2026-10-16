
const form = document.getElementById("searchForm");
const table = document.getElementById("productTable");
const errorMessage = document.getElementById("errorMessage");

form.addEventListener("submit", function(event) {
    event.preventDefault();

    const type = document.getElementById("type").value;
    const brand = document.getElementById("brand").value;
    const price = document.getElementById("price").value;
    const number = document.getElementById("number").value;

    // Clear previous results
    table.innerHTML = "";
    errorMessage.textContent = "";

    const params = new URLSearchParams({
        type: type,
        brand: brand,
        price: price,
        number: number
    });

    fetch("task05.php?" + params.toString())
        .then(function(response) {
            return response.json().then(function(data) {
                if (!response.ok) {
                    throw new Error(data.error || "Search failed");
                }

                return data;
            });
        })
        .then(function(data) {
            data.products.forEach(function(product) {
                const row = document.createElement("tr");

                ["type", "brand", "price", "number", "stock"].forEach(function(key) {
                    const cell = document.createElement("td");
                    cell.textContent = product[key];
                    row.appendChild(cell);
                });

                table.appendChild(row);
            });
        })
        .catch(function(error) {
            errorMessage.textContent = error.message;
        });
});