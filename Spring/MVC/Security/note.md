# 시큐리티 (Security)
updated 2020.02.23<br>

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
Spring Security는 특히 버전에 민감하므로 프레임워크와 대응하는 버전들을 맞춰서 기술해야한다.

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

  ...
}
```
## 시큐리티 설정 메소드

|메소드|설명|
|---|---|
|configure(AuthenticationManagerBuilder)|유저 설정(in memory, database, ldap, etc)|
|configure(HttpSecurity)|어플리케이션에서 웹 경로,  로그인 로그아웃 등에 대한 시큐리티 설정|

## 시큐리티 세부 메소드

```java
http.authrizeRequests()
```

요청을 가로챈 후 경로에 대한 세부 설정을 하기 위한 메소드는 다음과 같다.

|메소드|설명|
|---|---|
|antMatchers(String s)|Ant 와일드카드를 사용하여 조건에 맞는 경로를 탐색|
|regexMatchers(String s)|정규 표현식을 사용하여 조건에 맞는 경로를 탐색|

경로를 설정한 후 어떠한 처리를 할 것인가 에대한 메소드들은 다음과 같다.

|메소드|설명|
|---|---|
|access(String s)|주어진 SpEL 표현식의 결과가 true 라면 접근허용|
|anonymous()|익명의 사용자 접근 허용|
|authenticated()|인증된 사용자의 접근 허용|
|denyAll()|모든 접근을 허용하지 않음.|
|fullyAuthenticated()|사용자가 완전히 인증되면 접근허용|
|hasAnyRole(String s1, s2 ...)|사용자가 주어진 역할이 있다면 접근허용|
|hasAuthority(String s)|사용자가 주어진 권한이 있다면 접근허용|
|hasRole(String s)|사용자가 주어진 역할이 있다면 접근허용|
|not()|다른 접근 방식을 무효화|
|permitAll()|무조건 접근 허용|
|rememberMe()|기억하기를 통해 인증된 사용자의 접근을 허용|

## 인증처리(로그인 / 로그아웃)
기초적인 로그인, 로그아웃이다.
```java
@Override
	protected void configure(HttpSecurity http) throws Exception {
		
    http.authorizeRequests()

		  .anyRequest().authenticated()
    
      // .anyMatchers("/test/**") '**'는 서브디렉토리를 모두 허용한다는 의미.

			/* 로그인 */
			.and()
				.formLogin()
				.loginPage("로그인폼")
				.loginProcessingUrl("로그인처리")
				.permitAll()

			/* 로그아웃 */
			.and()
				.logout()
				.permitAll();
	}
```
JSP 템플릿에서는 아래와 같은 폼을 이용 할 수 있다.
```jsp
<form:form action="${pageContext.request.contextPath}/authenticate" method="POST" class="form-horizontal">

  <div class="form-group">
      <div>							
          <c:if test="${param.error != null}">            
            유효하지 않은 계정입니다.
          </c:if>
                
          <c:if test="${param.logout != null}">            
            로그아웃 처리 되었습니다.
          </c:if>
      </div>
  </div>

  <!-- 유저명 -->
  <div style="margin-bottom: 25px" class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> 
    
    <input type="text" name="username" placeholder="username" class="form-control">
  </div>

  <!-- 비밀번호 -->
  <div style="margin-bottom: 25px" class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span> 
    
    <input type="password" name="password" placeholder="password" class="form-control" >
  </div>

  <!-- 로그인 버튼 -->
  <div style="margin-top: 10px" class="form-group">						
    <div class="col-sm-6 controls">
      <button type="submit" class="btn btn-success">Login</button>
    </div>
  </div>

</form:form>
```
## CSRF (Cross Site Request Forgery)
CSRF 공격으로 부터 방어하기 위함으로 HTML 폼에 추가적인 인증 토큰을 내장시킨다. 웹 어플리케이션은 리퀘스트 과정에서 토큰이 유효한지 검사한다. <br>

스프링 MVC에서 자동으로 CSRF 토큰을 제공하나 직접 기술 할 필요가 있을 경우 아래와 같은 코드를 템플릿 폼태그 안에 추가한다.
```jsp
<input type="hidden" name="${_csrf.parameterName}" value="${_csrf.token}" />
```
## 403 에러페이지 핸들링
인증되지 않은 접근이 있을 경우 해당 경로로 리다이렉트
```java
.and()
.exceptionHandling()
.accessDeniedPage("에러페이지경로");
```
## 인가된 컨텐츠
루팅을 인가처리 하는 것 이외에 요소 단위로 인가처리 하는 방법을 다룬다.
#### JSP
```jsp
<sec:authorize access="hasRole('ADMIN')">
		<p>인증이 필요한 컨텐츠<p>
</sec:authorize>
```
## 데이터베이스 보안
#### Plain-Text
- 암호화 되지 않은 순수 문자열로 이루어져 있다.
- 데이터베이스 상에서 전치사 **noop**이 더해져 보존된다.
- 인메모리 인증(Deprecated)에서 테스트용도로 사용한다.
```java
  @Override
	protected void configure(AuthenticationManagerBuilder auth) throws Exception {
		
		UserBuilder users = User.withDefaultPasswordEncoder();

		auth.inMemoryAuthentication().withUser(
      users.username("yuu2")
        .password("1234")
        .roles("ADMIN"))
	}
```
#### bcrypt
- 스프링 시큐리티에서 권장하는 암호화 알고리즘
- 암호화된 해싱을 단방향으로 수행
- 패스워드를 보호하기 위해 무작위로 정렬
## 데이터베이스 유저 인증
스프링은 데이터베이스로 부터 유저 정보를 취득할 수 있는 기본적인 기능을 제공하고 있다.

1. 테이블
- users (username, password, enabled)
- authorities (username, authority)

2. 시큐리티 설정  
```java
// SecurityConfig.java
@Autowired
private DataSource dataSource;

@Override
protected void configure(AuthenticationManagerBuilder auth) throws Exception {
	auth.jdbcAuthentication().dataSource(dataSource);
}
```
위 방법은 스프링에 부합하는 틀 안에서 유저정보를 취득하거나 보존해야하는 애로사항이 있다.

## 데이터베이스 커스텀 유저 인증

