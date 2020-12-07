# JavaScript
updated 2020.12.07 <br>

## Summary
필기노트
## Array.prototype.sort()
> 배열 정렬
```js
const nums = [1, 100, 2, 200, 4, 300, 3]

nums.sort();
// 기본적으로 sort 함수는 문자열 대로 정렬됨 => 1, 100, 2, 200, 3, 300, 4

/**
 * 리턴 값이 0보다 작으면 a before b
 * 리턴 값이 0이면 그대로
 * 리턴 값이 0보다 크면  b before a
 */
 
// 오름차순
nums.sort((a, b) => a - b); 

// 내림차순
nums.sort((a, b) => b - a);

```
https://developer.mozilla.org/ko/docs/Web/JavaScript/Reference/Global_Objects/Array/sort

## Array.prototype.reduce()
> 배열 집계
```js
const nums = [1,2,3,4,5];

/**  
 * 배열을 돌면서 누산기의 값을 바꿈.
 */ 
nums.reduce((accumulator, val, idx) => {
  return accumulator += val;
}, 0); 

// => 15 가 출력됨.
```
https://developer.mozilla.org/ko/docs/Web/JavaScript/Reference/Global_Objects/Array/Reduce