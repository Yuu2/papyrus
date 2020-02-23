# 유효성검사 (Validation)
updated 2020.02.24

## @NotNull
기본적으로 제공. 객체가 **not null**인지 검사. 
```
@NotNull(message="is required")
private String name;
```
기본적으로 제공. int형의 null검사는 랩퍼클래스 (Integer 타입)일 필요성이 있다.
## @Size
```
@Size(min=1, max=10)
private String name;
```
기본적으로 제공. 문자열의 길이를 검사

## @Min / @Max
기본적으로 제공. int형의 최솟값, 최댓값 검사
```
@Min(value="must be greater than or equal to zero")
@Max(value="must be less then or equal to 10")
private int count;
```

## @Pattern 
기본적으로 제공. 객체의 정규표현식 검사
```
@Pattern(regexp="^[a-zA-Z0-9]{5}", message="only 5 chars/digit")
private String code;
```

## Custom Validator
커스텀 유효성검사 어노테이션을 생성해보자.
```java
// 간단한 예제
@Contraint(validatedBy = TestValidator.class)
@Target({ElementType.METHOD, ElementType.FIELD})
@Retention(RetentionPolicy.RUNTIME)
public @interface ValidTest() {

    public String value() default "";
    
    public String message() default "";

    /**
     * Groups: can group related constraints
     */
    public Class<?>[] groups() default {};
    /**
     * Payloads: provide custom details about validation failure (severity level, error etc)
     */
    public Class<? extends Payload>[] payload() default {};
}
```
어노테이션 인터페이스를 생성해야 한다. <br>
다음 제약조건에 해당하는 구현 클래스가 필요하다.
```java
public class TestValidator implements ConstraintValidator<ValidTest, String> {
    
  private String text;
    
   @Override
  public void initialize(ValidTest validTest) {
    // 어노테이션 value()에 해당하는 값.
    this.text = validTest.value();
  }

  @Override
  public boolean isValid(String value, ConstraintValidatorContext context) {  
    // 제약조건 메소드. String value는 입력한 값에 해당한다.
  }
}
```
해당 어노테이션을 선언한 엘리먼트 타입에 맞는 수식자에 사용 하면 된다.