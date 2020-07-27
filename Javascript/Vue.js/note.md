# Vue.js
updated 2020.07.28

## 설치하기
```sh
# CLI 설치
npm install -g @vue/cli

# 버전 확인
vue --version

# 프로젝트 생성
vue create [프로젝트 명]
```

## Directive
지시문에 대해서 알아보자.
아래는 기본적인 뷰 객체의 접근 방법을 서술했다.
```html
<div id="app">
  <h1>{{ welcome }}</h1>
  <p>{{ hello() }}</p>
</div>

<script>
  new Vue({
    // 템플릿 요소
    el: '#app',

    // 뷰 객체
    data: {
      welcome: 'Welcome'
    },

    // 돔이 바뀔때마다 항상 실행되는 메소드 영역
    methods: {
      hello() {
        return 'Vue.js!'
      }
    }
  });
</script>
```
### v-bind
HTML 속성에 데이터 값을 적용한다.
#### v-bind:href
```html
<a v-bind:href="link">v-bind 링크</a> <br>

<a :href="link">v-bind 축약 링크</a>

<script>
  new Vue({
    ...
    data: {
      link: 'http://portfolio-blog.yuu2dev.me'
    }
  })
</script>
```
#### v-bind:class
```html
<button :class="{
    btn btn-primary: isBtn, 
    btn btn-danger: !isBtn
}">
  버튼
</button>

<!-- default는 name, isBtn이 false 일때 동적으로 교체 -->
<button :class="[
    name, 
    {btn btn-danger: !isBtn}
]">
  버튼
</button>

<script>
  new Vue({
    ...
    data: {name: 'btn btn-success', isBtn: true}
  })
</script>
```
### v-once
단 한번 렌더링 후에 요소는 변동되지 않는다.
```html
<h1 v-once> {{ welcome }}</h1>
```

### v-html
문자열에 속한 HTML 태그를 인식하고 출력한다.
```html
<p v-html>{{ getLinkBlog() }}</p>

<script>
  new Vue({
    ...
    methods: {
      getLinkBlog() { 
        return "<a href='http://portfolio-blog.yuu2dev.me'>링크</a>;
      }
    }
  })
</script>
```

### v-on
이벤트 핸들링을 담당
#### v-on:click
: 마우스 클릭 이벤트
```html
<button v-on:click="count++">+1</button>

<button @click="count++">축약 +1</button>

<button v-on:click="increase(count, $event)">+1</button>

<script>
  new Vue({
    ...
    data: { count: 0 }
    methods: {
      // 이벤트는 $event 매개변수를 사용해야 호출 가능하다
      increase(count, event) {
        this.count++;
        console.log(event)
      }
    }
  })
</script>
```
#### v-on:mousemove
: 마우스 이동 이벤트
```html
<p v-on:mousemove="updateMovement">이 영역에서 움직일 때 +1</p>

<p v-on:mousemove.stop="">이 영역에서 움직일 때 카운팅 멈춤</p>

<script>
  new Vue({
    ...
    data: { count: 0 }
    methods: {
      updateMovement(event) {
        this.count++;
        console.log("x: " + event.clientX + "/" + "y: " + event.clientY);
      }
    }
  })
</script>
```
#### v-on:keyup
```html
<input type="text" v-on:keyup="alertMe"/>

<!-- 엔터나 스페이스바를 누르는 경우-->
<input type="text" v-on:keyup.enter.space="alertMe"/>

<script>
  new Vue({
    ...
    data: { count: 0 }
    methods: {alertMe() {alert('~~~~');}}
  })
</script>
```

### v-model
객체 양방향 바인딩
```html
<input type="text" v-model="name"/>
<script>
  new Vue({
    ...
    data: { name: '아무개' }
  })
</script>
```

## computed
뷰 객체의 methods 영역은 돔이 바뀔때 마다 항상 메소드를 확인하는 특징을 가지고 있는 반면에 <br>
computed는 연관된 필드 객체가 바뀔때 메소드를 확인하는 특징을 가지고 있다.
```html
<input type="text" />
<input type="text" v-model="name"/>
<script>
  new Vue({
    data: {
      name: ''
    }
    computed: {name: function() {console.log('computed')}}
    methods: {checkMethods() {console.log('methods')}
    }
  })
</script>
```
## watch
특정 뷰 객체를 항상 감시하는 영역이다. 
```html
<input type="text" v-model="name"/>
<script>
data: {
  name: ''
}
watch: {
  name: function(value) {
    console.log(value);
  }
}
</script>
```
