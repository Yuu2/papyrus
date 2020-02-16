# 유효성검사 (Validation)
updated 2020.01.22

## @NotNull
객체가 **not null**인지 검사.
```
@NotNull(message="is required")
private String name;
```
int형의 null검사는 랩퍼클래스 (Integer 타입)일 필요성이 있다.
## @Size
```
@Size(min=1, max=10)
private String name;
```
문자열의 길이를 검사

## @Min / @Max
int형의 최솟값, 최댓값 검사
```
@Min(value="must be greater than or equal to zero")
@Max(value="must be less then or equal to 10")
private int count;
```

## @Pattern 
객체의 정규표현식 검사
```
@Pattern(regexp="^[a-zA-Z0-9]{5}", message="only 5 chars/digit")
private String code;
```

## Custom Validator
직접 유효성 검사 어노테이션을 생성 하여 검사.
```
// 간단한 예제
@Contraint(validatedBy = SimpleTestConstraintValidator.class)
@Target({ElementType.METHOD, ElementType.FIELD})
@Retention(RetentionPolicy.RUNTIME)
public @interface SimpleTest() {

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
우선 어노테이션 인터페이스를 생성해야 한다. <br>
그 다음 제약조건에 해당하는 구현 클래스가 필요하다.
```
public class SimpleTestConstraintValidator implements ConstraintValidator<SimpleTest, String> {
    
    private String text;
    
    @Override
    public void initialize(SimpleTest simpleTest) {
        // 어노테이션 value()에 해당하는 값.
        this.text = simpleTest.value();
    }

    @Override
    public boolean isValid(String value, ConstraintValidatorContext arg1) {
        
        // 제약조건 메소드. String value는 입력한 값에 해당한다.
    }
}
```
이제 @SimpleTest를 필드나 메소드에 부여하기만 하면 된다.

