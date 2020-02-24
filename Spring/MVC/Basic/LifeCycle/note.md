# Bean 범위와 생명주기 (LifeCycle)
updated 2020.01.20

## @Scope
Bean의 범위(Scope)는 기본적으로 **singleton**이다. 
- 스프링 컨테이너는 기본적으로 오직 하나만 생성된다.
- 캐시 메모리
- Bean에대한 모든요청은 같은 Bean을 참조하여 리턴 하게 된다. 
```
@Component
@Scope("singleton")
public class Bean객체 implements 인터페이스 {
    ...
}
```
만약 새로운 빈 객체를 생성하고 싶다면
```
@Component
@Scope("prototype")
public class Bean객체 implements 인터페이스 {
    ...
}
```
**prototype**을 값으로 설정한다.

## @PostConstruct / @PreDestroy
자바9 버전이후 기존 라이브러리에서 제외되었다.
https://search.maven.org/remotecontent?filepath=javax/annotation/javax.annotation-api/1.3.2/javax.annotation-api-1.3.2.jar

- **@PostConstruct**는 생성자가 생성된 이후 실행되는 메소드
- **@PreDestroy**는 객체가 제거되기 전에 실행되는 메소드.

@PreDestroy 같은 경우 prototype 스코프에서는 호출 할 수 없다.
