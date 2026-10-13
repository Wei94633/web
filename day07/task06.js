const box = document.querySelector("footer div");
const square = document.querySelector("canvas");    // 黑色方塊
const coordinates = document.querySelectorAll("footer div")[1];    // 第二個白色方框

box.style.position = "relative";    // 調整黑色方塊的位置
square.style.position = "absolute";
square.style.margin = "0";

let dragging = false;    // 紀錄現在是否正在拖曳
let startX = 0;     // 記錄滑鼠與方塊在 X 方向的相對位置
let startY = 0;     // 記錄滑鼠與方塊在 y 方向的相對位置

square.addEventListener("mousedown", function(event) {
    dragging = true;    

    const rect = square.getBoundingClientRect();

    startX = event.clientX - rect.left;
    startY = event.clientY - rect.top;
});

document.addEventListener("mousemove", function(event) {
    if (dragging) {
        const rect = box.getBoundingClientRect();

        x = event.clientX - rect.left - box.clientLeft - startX;
        y = event.clientY - rect.top - box.clientTop - startY;

        // 限制移動範圍，避免黑色方塊超出白色容器
        x = Math.max(0, Math.min(x, box.clientWidth - square.offsetWidth));
        y = Math.max(0, Math.min(y, box.clientHeight - square.offsetHeight));
        // clientWidth：元素內部寬度
        // offsetWidth：元素包含邊框的寬度

        square.style.left = x + "px";
        square.style.top = y + "px";

        coordinates.textContent = `New coordinates => {x:${x}, y:${y}}`;
    }
});

document.addEventListener("mouseup", function() {     // 放開滑鼠
    dragging = false;
});