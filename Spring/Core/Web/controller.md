# Controller

## @Controller
POJO 클래스에 어노테이션을 부여하면 다음과 같은 효과를 얻을 수 있다.
- 컴포넌트 스캔을 통해 DI컨테이너에 Bean 등록 가능.
- 요청을 핸들링하는 메소드로 인식.

value 속성에 DI 컨테이너로 등록하는 Bean ID를 지정 할 수 있다.
생략하면 스프링 명명규칙에 의해 자동으로 지정된다.

### 1. Handler 메소드의 매개변수
|타입|설명|
|---|---|
|Model|이동 할 화면의 데이터|
|BindingResult|폼 클래스의 입력체크 결과|
|Principal|클라이언트 인증 유저 정보|

### 2. Handler 메소드의 반환 값
## @RequestMapping
HTTP GET, POST 등의 메소드를 구별한다.


## @PathVariable
**{}** 에 해당하는 경로변수 값을 취득 할 수 있다.
```
@RequestMapping(path = "/{}")
public String 메소드() { // ... }
```
## @RequestParam
**?요청변수=** 에 해당하는 변수를 취득 할 수 있다.

```
@RequestMapping(path = 경로)
pulbic String 메소드(@RequestParam String 요청변수) { // ... }
```

## @ModelAttribute
- 매개변수로 지정 할 경우 Model에 격납된 오브젝트를 매개변수로 취득할 수 있게 된다.
- 반환값으로 지정 할 경우 Model에 격납된 오브젝트를 반환 할 수 있다.

메소드로 부여 해두었을 경우,
```
@ModelAttribute
public 리턴타입 메소드() {
   // ... 
}
@RequestMapping(요청 경로)
public String 메소드() {
    // ...
}
```
Handler 메소드가 호출되기 전에 실행되어 반환한 오브젝트가 Model에 격납되는 구조로 되어 있다.
