let count = 0;

const box = document.querySelector("footer div");   // 找到白色方框
// document.querySelector(footer div): 尋找footer裡的第一個div
 
box.addEventListener("click", function() {      // addEventListener: 監聽事件
    // 當事件發生時，執行裡面的程式             // click: 滑鼠點擊
    count++;
    box.textContent = count;     // 修改HTML裡面的文字
});