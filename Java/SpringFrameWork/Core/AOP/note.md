# 관점 지향적 프로그래밍 (Aspect Of Programming)
updated 2020.02.11

## @EnableAspectJAutoProxy
자바빈 설정 클래스에 해당 어노테이션을 선언.

## @Aspect
Aspect(관점) 역할을 지닌 클래스임을 명시한다.
```
@Aspect
public class 클래스 {}
```
## Execution
어드바이스 타입의 인자이며 execution으로 타겟 객체를 탐색한다.
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

### 2. 재사용가능(Reuseable)
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
## JoinPoint
JoinPoint를 인자로 건내면 관점역할 메소드의 정보를 얻을 수 있다.
### Method Signature
메소드 문자열(String)을 취득한다.
```
public void 메소드(JoinPoint joinPoint) {
  ...
  MethodSignature signature = (MethodSignature) joinPoint.getSignature();
}
```
### Method Arguments
인자 객체배열(Array)를 취득한다.
```
public void 메소드(JoinPoint joinPoint) {
  ...
  Object[] args = joinPoint.getArgs();
}
```

## Advice Types

### @Pointcut
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
### @Order
Aspect가 어느 순서로 실행 할지 번호를 부여 할 수 있다.
```
@Aspect
@Order(1) ... @Order(2) ... @Order(3) ...
public class 클래스 {}

/* 만약 포인트컷을 찾을 수 없다는 에러가 출력되면 패키지.클래스 경로로 포인트컷을 설정할 것. */
```

### @After
```
@After("execution(패키지경로)")
public void 메소드(JoinPoint joinPoint) {
  ...
}

```
**타겟 메소드가 실행된 직후에 실행된다**<br>

주로 예외처리 또는 검사 할 때 사용되며 
이 기능으로 캡슐화 함으로써 AOP 관점에서 재사용하기 쉽다.

@After 어노테이션은 Success 또는 failure **(finally)** 일때 사용해야 한다.
이는 코드가 예외 발생이 되어서는 안되며
로깅, 검사와 같은 쉬운 작업들에서만 사용되야함을 의미한다.

### @AfterReturning
```
@AfterRetunring(
  pointcut="execution(패키지경로)",
  returning=매개변수)
public void 메소드(JoinPoint joinPoint, 타입 매개변수) {
  ...
}
```
**타겟 메소드가 리턴된 시점에 실행된다**<br>

주로 데이터를 가공처리하거나 로깅, 시큐리티, 트랙잭션에 활용 된다.
### @AfterThrowing
```
@AfterThrowing(
  pointcut="execution(패키지경로)",
  throwing=매개변수)
public void 메소드(JoinPoint joinPoint, Throwable 매개변수) {
  ...
}
```
**타겟 메소드가 예외가 발생한 시점에 실행된다.**<br>

주로 예외 처리 로그에 사용되며,
예외처리를 알리거나 서버관리 측에 Mail 또는 SNS를 보낼 때 쓰여진다.
이 기능으로 캡슐화 함으로써 AOP 관점에서 재사용하기 쉽다.

### @Around
```
@Around("execution(패키지경로)")
public void 메소드(ProceedJoinPoint joinPoint) throws Throwable {
  
  ...
  long start = System.currentTimeMillis();
  
  // 타겟 메소드 실행부
  
  try {
    Object result = joinPoint.proceed();

  } catch(Exception e) {

  }

  long end = System.currentTimeMillis();

  long duration = end - start / 1000.0; 

  System.out.println(duration);
}
```
**타겟 메소드가 실행되기 전후를 다룬다.**<br>
주로 로깅, 검사, 시큐리티, 예외를 관리하기 위해 사용한다.
특히, ProceedJoinPoint는 try catch 블록을 통해 예외 처리를 수행한다.
(catch 블록에서 예외가 또 발생한다면 .. GG)