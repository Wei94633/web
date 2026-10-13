const box = document.querySelector("footer div");

let text = "";

document.addEventListener("keydown", function(event) {    // keydown: 按下鍵盤按鍵時觸發
    if (event.key.length === 1) {     //event.key: 取得使用者按下的按鍵名稱或字元
        text += event.key;      
        text = text.slice(-42);    // slice(): 擷取字串
        box.textContent = text;
    }
});