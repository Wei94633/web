const box = document.querySelector("footer div");

box.addEventListener("click", function() {
    let name = "";

    while (!name || !name.trim()) {      // name.trim():移除字串前後空白
        name = prompt("What's your name?");
    }

    const answer = confirm("Are you sure that name is your name ?");

    if (answer) {      // 當answer是true時，就執行以下
        alert("Hello " + name + "!");     // 警告視窗
        box.textContent = "Hello " + name + "!";
    }
});