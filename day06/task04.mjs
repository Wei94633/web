export function fizzBuzz(num){
    let result = [];

    for (let i = 1; i <= num; i++){
        if (i % 3 === 0 && i % 5 === 0){     // &&: and
            result.push("FizzBuzz");
        } else if (i % 3 === 0){
            result.push("Fizz");
        } else if (i % 5 === 0){
            result.push("Buzz");
        } else {
            result.push(i);     // push: list.append()
        }
    }

    console.log(result.join(", "));     // 陣列 (組合成字串)
}