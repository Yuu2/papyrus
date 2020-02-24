# 롬복(Lombok)
updated 2020.02.16

## @Getter
```
public 리턴타입 메소드() {
    return this.필드
}
```
필드에 해당하는 **Getter**를 생성
## @Setter
```
public void 메소드(매개변수) {
    this.필드 = 매개변수
}
```
필드에 해당하는 **Setter**를 생성
# @ToString
toString() 생성
## @RequiredArgsConstructor
**final**이나 **@NonNull**에 해당하는 필드를 참조하여 생성자를 생성
```
public final 리포지토리;

// @RequiredArgsConstructor를 사용하면 해당 코드가 생략.
public 생성자(리포지토리) {
    this.리포지토리 = 리포지토리
}
```
- 생성자가 하나면은 @Autowired를 생략 할 수 있다.
- Spring Data JPA를 사용하면 EntityManager도 주입 가능하다.
## @EqualsAndHashCode
객체의 equals()와 hashCode() 생성
## @Data
@Getter(모든 속성), @Setter(final이 아닌 것),
@ToString, @EqualsAndHashCode,  @RequiredArgsConstructor 