# 의존성 주입(Dependency Injection)

## 생성자 주입(Constructor Injection)

## 메소드 주입(Setter Injection)

## 필드 주입(Field Injection)

## @Qualifier(식별자)
컴포넌트 스캔중 여러 구현 오브젝트가 주입 될 경우 NoUniqueBeanDefinitionException 발생.
그러므로, 특정 식별자를 부여할 필요가 있다.
```
@Component
public class 클래스 implements 인터페이스 {
    @Autowired
    @Qualifier(의존성주입 구현객체)
    private 의존성주입 인터페이스
}
```
식별자는 생성자, 메소드, 필드 주입에서 사용 할 수 있다. 그리고 식별자 안의 값으로는
Bean 객체의 id가 들어오며 해당 id는 Bean의 클래스 명명규칙에 따라 소문자부터 시작하게 된다.
```
FooBah -> fooBah / X -> x
```
그러나 특별한 경우, 예를들어 "URL"같이 대문자의 나열은 명명규칙대상에서 제외된다.
```
URL -> URL
```

## 프로퍼티 주입(Property Injection)
자바 어노테이션을 이용하여 프로퍼티를 주입 할 수도 있다. 어떤 **.properties** 파일을 생성하자.
```
yuu2.email=myco8332v2@gmail.com
```
설정에서 프로퍼티 파일을 로드한다.
```
<context:property-placeholder location="classpath:프로퍼티파일" />
```
의존성 주입이 되는 객체에서 위 프로퍼티 값을 불러오려면
```
@Value("${yuu2.email}")
String email
```
**@Value** 어노테이션을 이용하면 된다.