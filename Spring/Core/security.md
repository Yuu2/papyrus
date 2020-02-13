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
## 설정 클래스 메소드
|메소드|설명|
|---|---|
|configure(AuthenticationManagerBuilder)|유저 설정(in memory, database, ldap, etc)|
|configure(HttpSecurity)|어플리케이션에서 웹 경로,  로그인 로그아웃 등에 대한 시큐리티 설정|

## 인증처리(로그인 / 로그아웃)
기초적인 로그인, 로그아웃이다.
```java
@Override
	protected void configure(HttpSecurity http) throws Exception {
		http.authorizeRequests()
				.anyRequest().authenticated()

			// 로그인
			.and()
				.formLogin()
				.loginPage("로그인폼")
				.loginProcessingUrl("로그인처리")
				.permitAll()

			// 로그아웃
			.and()
				.logout()
				.permitAll();
	}
```
JSP 템플릿에서는 아래와 같은 폼을 이용 할 수 있다.
```jsp
<form:form action="${pageContext.request.contextPath}/authenticateTheUser" method="POST" class="form-horizontal">

  <div class="form-group">
      <div class="col-xs-15">
          <div>							
              <c:if test="${param.error != null}">            
                <div class="alert alert-danger col-xs-offset-1 col-xs-10">
                  유효하지 않은 계정입니다.
                </div>
              </c:if>
                
              <c:if test="${param.logout != null}">            
                <div class="alert alert-success col-xs-offset-1 col-xs-10">
                  로그아웃 처리 되었습니다.
                </div>
              </c:if>
          </div>
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
