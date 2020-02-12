# 시큐리티 (Security)
updated 2020.02.12<br>

Spring MVC 를 표준으로 서술합니다.
Spring Boot에서는 아래와 같은 몇몇 설정은 생략되오니 나는 부디 잊지 마시길 ...
## Spring Security 설치하기
### 의존성 주입
- 메이븐(Maven)
```XML
<dependency>
  <groupId>org.springframework.security</groupId>
  <artifactId>spring-security-web</artifactId>
  <version>${springsecurity.version}</version>
</dependency>

<dependency>
    <groupId>org.springframework.security</groupId>
    <artifactId>spring-security-web</artifactId>
    <version>${springsecurity.version}</version>
</dependency>
```
Spring Security는 특히 버전에 민감하므로 서로 대응하는 버전을 맞춰서 기술해야한다.

### 필터 클래스 작성
- XML 
```
@Todo:
언젠간 기록하겠지 ... ?
아마 그 날은 오지 않을거야
```

- Java Config
```java
public class SecurityWebApplicationInitializer extends AbstractSecurityWebApplicationInitializer {

}
```
해당 클래스는 **Spring Security Filters**라고하는 특별한 클래스를 웹브라우저 <=> 보호된 웹 리소스, 유저정보, 시큐리티 설정 사이에 위치하게 한다.

다시 말하자면 이 클래스가 수문장 역할을 하게 되는 것이다.

### 설정 클래스 작성
```java
@Configuration
@EnableWebSecurity
public class DemoSecurityConfig extends WebSecurityConfigurerAdapter {

  @Override
	protected void configure(AuthenticationManagerBuilder auth) throws Exception {}
}
````
