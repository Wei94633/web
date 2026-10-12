import { arrayFiltering } from "./task06.mjs";

let numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9];

let result = arrayFiltering(numbers, (x) => x % 3 === 0);

console.log(result);
