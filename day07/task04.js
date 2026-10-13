const buttons = document.querySelectorAll("footer button");     // 找到所有符合條件的元素
const select = document.querySelector("footer select");      // 找到第一個符合條件的元素
// select: 下拉選單的標籤名稱

let fontSize = 16;

buttons[0].addEventListener("click", function() {   // + 按鈕
    fontSize += 2;
    document.body.style.fontSize = fontSize + "px";
});

buttons[1].addEventListener("click", function() {    // - 按鈕
    fontSize -= 2;
    document.body.style.fontSize = fontSize + "px";
});

select.addEventListener("change", function() {
    document.body.style.backgroundColor = select.value;
});