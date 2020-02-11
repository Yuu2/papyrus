# 관점 지향적 프로그래밍 (Aspect Of Programming)
updated 2020.02.11

```
@Aspect
public class 클래스 {}
```
## @PointCut
Advice를 어느 곳에 적용 할지에 대한 표현이다.
일단 컴포넌트 스캔의 대상이 된 객체들만 해당 된다.

### 1. 와일드카드(Wirdcard)
```
@Before("execution(Modifier Return Type Target-Method)")
```
주요 특징은 *와일드카드*를 이용 할 수 있는데 예를 들면,

"add로 시작하기 직전에 작동해!" 라는 Advice를 만들 수도 있다.
```
@Before(execution(public void add*()))
public void beforeMung() {
    System.out.println("동물이 짖을 것 같아요 ... ");
}
```
```
public void addMung() {
    System.out.println("멍멍");
}
public void addYaong() {
    System.out.println("야옹");
}
```
개나 고양이나 짖으면 짖기 직전에 동물이 짖을 것 같아요라는 메시지를 출력하게 된다.
이러한 와일드카드는 *Modifier*, *Return type*, *method name*등에 적용 할 수 있다. <br>
```
@Before("execution(public void 패키지.클래스.메소드)")
```
만약 특정 클래스의 메소드만 적용하고 싶다면 정확히 타겟팅 할 필요가 있다.<br>

다음은 와일드카드의 파라미터패턴에 대해 알아보자.

|매개변수|설명|
|---|---|
|()|매개변수가 아무것도 없을 때 ...|
|(*)|어떠한 매개변수가 오던지 상관없다. 1개이상|
|(..)|어떠한 매개변수가 오던지 상관없다. 0개 이상|

```
// 모든 리턴타입의 com.yuu2.dev 패키지 아래의 모든 클래스, 메소드의 어떠한 매개변수
@Before("execution(* com.yuu2.dev.*.*(..))")
// 모든 리턴타입의 com.yuu2.dev 패키지 아래의 Example 클래스에서 어떠한 매개변수
@Before("execution(* add*(com.yuu2.dev.aop.Example, ..))")
```

### 2. 재사용(Reuse)
매번 execution() 문자열을 재선언 하는건 불편하므로 재사용 가능한 방법이 있다.
```
@Aspect
@Component
public class MyAspect {

    @Pointcut("execution(* com.yuu2.dev.*.*(..))")
    private void reuse() {}

    @Before("reuse()")
    public void beforeAction1() { ... }

    @Before("reuse()")
    public void beforeAction2() { ... }
}
```
## @Pointcut
```
@Aspect
@Component
public class MyAspect {

    @Pointcut("execution(* com.yuu2.dev.*.get*(..))")
    private void getter() {}
    
    @Pointcut("execution(* com.yuu2.dev.*.set*(..))")
    private void setter() {}

    @Before("!(getter() || setter())")
    public void beforeAction() { ... }
}
```
표현식의 재사용을 허용한다.
## @Order
Aspect가 어느 순서로 실행 할지 번호를 부여 할 수 있다.
```
@Aspect
@Order(1) ... @Order(2) ... @Order(3) ...
public class 클래스 {}

/* 만약 포인트컷을 찾을 수 없다는 에러가 출력되면 패키지.클래스 경로로 포인트컷을 설정할 것. */
```
## JoinPoints

### Method Signature
메소드 문자열(String)을 취득한다.
```
public function 메소드(JoinPoint joinPoint) {
  ...
  MethodSignature signature = (MethodSignature) joinPoint.getSignature();
}
```
### Method Arguments
인자 객체배열(Array) 취득한다.
```
public function 메소드(JoinPoint joinPoint) {
  ...
  Object[] args = joinPoint.getArgs();
}
```