export function drawTriangle(height){
    for (let i = 1; i <= height; i++){          // 就像python: for i in range(1, height + 1):
        console.log("$".repeat(i));
    }
}