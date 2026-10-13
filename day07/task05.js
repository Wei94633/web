const canvas = document.querySelector("canvas");
const ctx = canvas.getContext("2d");      // ctx: 在畫布上畫圖的工具

// Draw triangle
ctx.beginPath();       // 開始一個新的繪圖路徑
ctx.moveTo(6, 6);      // 將起點移到這裡
ctx.lineTo(14, 10);    // 從起點畫線到這裡
ctx.lineTo(6, 14);      
ctx.closePath();       // 最後一點連回起點

ctx.fillStyle = "white";
ctx.fill();

ctx.lineWidth = 1;         // 外框寬度
ctx.strokeStyle = "white";     // 外框
ctx.stroke();

// Audio
const audio = document.querySelector("audio");
const buttons = document.querySelectorAll("button");

audio.src = "https://universal-soundbank.com/sounds/13631.mp3";

// Play
canvas.addEventListener("click", function() {
    audio.play();
});

// Pause
buttons[0].addEventListener("click", function() {
    audio.pause();
});

// Stop
buttons[1].addEventListener("click", function() {
    audio.pause();
    audio.currentTime = 0;
});