# REST API
updated 2020.02.25

## 개요
REST(Representational State Transfer)는 로이 필딩(Roy Fielding)이 자신의 2000년 박사 학위 논문에 정의한 웹 기반 아키텍쳐.
#### XML
```xml
# todo
```
#### JSON
```json
{
  "id": 1,
  "name": "yuu2",
  "active": true,
  "skill": null
}
```
JSON에는 다음과 같은 기술을 할 수 있다.
- Number : 따옴표를 붙이지 않는다.
- String : 쌍 따옴표를 붙인다.
- Boolean : true, false
- 중첩 JSON object
- Array
- null
## REST HTTP
|메소드|동작|
|---|---|
|POST|새로운 엔티티 생성|
|GET|엔티티 불러오기|
|PUT|엔티티 갱신|
|DELETE|엔티티 삭제|

## @RestController
- @Controller의 확장판으로 REST 요청과 응답을 핸들링한다.
- Spring REST는 자동으로 Java POJO를 JSON으로 변환해준다.

## JSON To POJO
Json 확장자를 자바 POJO로 불러오기 위해서는
**jackson-databind** 라이브러리가 필요하다.
(https://mvnrepository.com/artifact/com.fasterxml.jackson.core/jackson-databind)
<br><br>
예제는 다음과 같다.

```java
/* 프로젝트 경로의 json/test.json 파일을 매핑*/
Apple apple = mapper.readValue(new File("json/test.json", Apple.class));
```
json파일로 부터 자바 객체를 생성 할 수 있다. <br>
한 편, default 설정으로는 해당 객체와 json의 데이터가 완전히 **일치 해야된다**는 애로사항이 있다. 
```java
@JsonIgnoreProperties(ignoreUnknown=true)
```
**@JsonIgnoreProperties** 어노테이션 타입을 지정하면 자바 객체와 데이터가 일치하지 않아도 된다.


## POJO To JSON