# Vue.js
updated 2021.07.03

## 개요
vue.js 학습노트

## 컴포넌트 (Component)
> vue에서 재사용 가능한 스크립트

### 전역 컴포넌트
```js
// main.js
import ExpComponent from './components/ExpComponent.vue';

app.component('exp-component' ExpComponent);
app.mount('#app');
```

### 지역 컴포넌트
> 인스턴스 범위에서만 사용가능한 컴포넌트
```js
import ExpComponent from './components/ExpComponent';

export default () {
    components: {
        ExpComponent
    }, 
}
```
### 동적 컴포넌트
> 분기에 따른 컴포넌트 렌더링이 필요 할 때 
```html
<template>
    <button>A</button>
    <button>B</button>
    <!-- 동적으로 A 또는 B 컴포넌트를 렌더링 -->
    <component :is="selected"></component>
</template>

<script>
    import A from './components/A.vue';
    import B from './components/A.vue';
    export default () {
        components: {
            A, B
        },
        data() {
            selected: null,
        },
        methods: {
            setSelected(selected) {
                this.selected = selected;
            }
        }
    }
</script>
```

#### keep-alive
> 컴포넌트를 분기했더니 데이터가 사라졌을 때
<p>기본적으로 컴포넌트가 교체 될 때 (updated) DOM의 노드가 제거된다.</p>
<p>vue 는 DOM 노드를 기억하고 싶을 때 'keep-alive' 태그를 이용하여 캐싱하도록 권장한다.</p>

```js
// App.vue
<template>
    <keep-alive>
        <!-- A 컴포넌트의 데이터는 캐싱 될 것-->
        <A />
    </keep-alive>
</template>

// A.vue
// 동적 컴포넌트를 통해 B 컴포넌트로 교체하였을 경우 A 컴포넌트가 제거되므로
// B -> A 로 다시 이동할 때 모든 노드는 새로이 생성되어 사실상 필드의 값은 사라짐
// 허나 keep-alive 태그 아래의 입력 값은 캐싱되게금 할 수 있다!
<template>
    <div>
        <input type="text" />
    </div>
</template>
```
#### teleport
> 컴포넌트지만 렌더링 할 때는 특정 DOM에서 렌더링 하고 싶을 때

```js
// teleport 태그는 DOM 이 렌더링 될 때 특정 선택자의 자식태그로 생성되게 한다.
<teleport to="#app">
    <template>
        선택자 아래에 렌더링 될 거야 #app 이니까 id가 app인 html 태그 하에 출력 될 것
    </template>
</teleport>
```


## 참조
```
https://kr.vuejs.org/v2/style-guide/index.html (vue.js 표준코딩 가이드)
```