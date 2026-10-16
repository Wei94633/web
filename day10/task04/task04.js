
const typeInput = document.getElementById("type");
const brandInput = document.getElementById("brand");

const typeMessage = document.getElementById("typeMessage");
const brandMessage = document.getElementById("brandMessage");

let requestNumber = 0;

function validate() {
    const type = typeInput.value;
    const brand = brandInput.value;
    const currentRequest = ++requestNumber;

    const params = new URLSearchParams({
        type: type,
        brand: brand
    });

    fetch("task04.php?" + params.toString())
        .then(function(response) {
            if (!response.ok) {
                throw new Error("Request failed");
            }

            return response.json();
        })
        .then(function(data) {
            if (currentRequest !== requestNumber) {
                return;
            }

            typeMessage.textContent = data.typeMessage;
            brandMessage.textContent = data.brandMessage;

            typeMessage.className = data.typeValid
                ? "mt-2 text-success"
                : "mt-2 text-danger";

            brandMessage.className = data.brandValid
                ? "mt-2 text-success"
                : "mt-2 text-danger";
        })
        .catch(function(error) {
            if (currentRequest !== requestNumber) {
                return;
            }

            typeMessage.textContent = "An error occurred";
            brandMessage.textContent = "An error occurred";

            typeMessage.className = "mt-2 text-danger";
            brandMessage.className = "mt-2 text-danger";
        });
}

typeInput.addEventListener("input", validate);
brandInput.addEventListener("input", validate);

validate();
