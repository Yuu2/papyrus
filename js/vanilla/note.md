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

## innerHTML
> 요소에 속한 HTML 출력
```html
<form>
  <input type="text">
  <input type="submit">
</form>
<script>
  const form = document.querySelector('form');
  console.log(form.innerHTML);
  /*
      <input type="text">
      <input type="submit">
  */
</script>
```
## innerText
> 요소의 문자열
```html
<p>
  Hello JavaScript
  <script>
    console.log("Hello JavaScript");
  </script>
</p>

<script>
  const p = document.querySelector('p');
  console.log(form.innerText);
  /*
    Hello JavaScript
  */
</script>
```
## textContent
> 요소의 텍스트 (태그포함)
```html
<p>
  Hello JavaScript
  <script>
    console.log("Hello JavaScript");
  </script>
</p>

<script>
  const p = document.querySelector('p');
  console.log(p.textContent);
  /*
    Hello JavaScript
    console.log("Hello JavaScript")
  */
</script>
```
## getAttribute() & setAttribute()
> 요소의 값 Getter, Setter
```html
<input type="text" value="Hello">

<script>
const input = document.querySelector('input');
input.getAttribute('value'); // Hello
input.setAttribute('value', 'Hello JavaScript'); // Hello JavaScript
</script>
```
더 간단한 접근법도 있다.
```js
console.log(input.value); // Hello JavaScript
console.log(input.type); // text
```
## parentElement
> 부모속성
```html
<ul>
  <li>A</li>
  <li>B</li>
  <li>C</li>
</ul>

<script>
  const firstli = document.querySelector('li'); // li의 첫번째 요소 
  console.log(firstli.parentElement; //<ul>...</ul>
</script>
```
## children
> 자식속성
```html
<ul>
  <li>A</li>
  <li>B</li>
  <li>C</li>
</ul>

<script>
  const ul = document.querySelector('ul');  
  console.log(ul.children); // HTMLCollection(3) [li, li, li]
</script>
```

## nextSibling & previousSibling
> 주변속성
```html
<ul>
  <li id="a">A</li>
  <li id="b">B</li>
  <li id="c">C</li>
</ul>

<script>
  const firstli = document.querySelector('li');  
  console.log(firstli.nextElementSibling); 
  // <li id="b">B</li>
  console.log(firstli.nextElementSibling.previousElementSibling);
  // <li id="a">A</li> 
</script>
```
__nextElementSibling__ 또는 __previousElementSibling__ 으로 사용가능 


> https://developer.mozilla.org/ko/docs/Web/API/Node/nextSibling
> https://developer.mozilla.org/ko/docs/Web/API/Node/previousSibling