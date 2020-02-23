# 스프링 부트 설정(SpringBoot Config)
updated 2020.02.17

## 개요(Summary)
스프링 프로젝트를 생성 한 후 application.properties 또는 application.yaml에 기술하는 설정이 외우기가 쉽지 않아 집대성하기 위함

## 데이터베이스 설정
```yaml
spring:
  datasource: 
    url: # jdbc:mysql://localhost:3306/app_db (MySQL)
    username:
    password:
```
## 스프링 부트 서버 설정
```yaml
server:
  port: # 포트번호 설정 기본은 8080.
```
