# 어노테이션(Annotation)
updated 2020.01.01
## 1. @interface
어노테이션을 적용함은 다음과 같다.
- 컴파일러에게 코드 문법 에러를 체크하도록 정보를 제공
- 소프트웨어 개발 툴이 빌드나 배치 시 코드를 자동으로 생성 할 수 있도록 정보 제공
- 실행 시(런타임) 특정 기능을 실행하도록 정보를 제공
## 2. @Target
적용 대상은 다음과 같다.
 * TYPE 클래스, 인터페이스, 열거 타입
 * ANNOTATION_TYPE 어노테이션
 * FIELD 필드
 * CONSTRUCTOR 생성자
 * METHOD 메소드
 * LOCAL_VARIABLE 로컬 변수
 * PACKAGE 패키지
## 3. @Retention
어노테이션 정의 시 사용 용도에 따라 어느 범위 까지 유지 할 것인지 지정해야 한다.

* SOURCE : 소스에서만 어노테이션 정보를 가진다.
* CLASS : 바이트 코드 파일까지 어노테이션 정보를 가진다.
* RUNTIME : 바이트 코드는 물론 런타임시 리플렉션을 이용해서 어노테이션 정보를 얻을 수 있다.
## 
```java
// 어노테이션 인터페이스
import java.lang.annotation.*;

@Target({ElementType.METHOD})
@Retention(RetentionPolicy.RUNTIME)
public @interface ExampleAnnotation {
  
  // value 요소는 기본적으로 가지고 있다. (생략가능)
  String value() default "";

  int number() default 0;
}
```
```java
// 어노테이션 적용 클래스
public class Example {
  
  @ExampleAnnotation(value="HELLO", number=1)
  public void method() {}
}
```