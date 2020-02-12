# 메이븐(Maven)
updated 2020.02.12
```
[1] 설정파일 작성 (Spring, Hibernate, Commons Logging, JSON ...)
      ->
[2] 메이븐 로컬리포지토리 확인
      ->
[3] 메이븐 중앙 리포지토리 확인
```
Java 기반 빌드 도구. **pom.xml** 에 jar 목록을 작성함으로써 라이브러리를 다운 받으러 사이트에 방문하는 수고로움을 덜게 되었다..

## 표준 디렉토리 구조
|디렉토리|설명|
|---------|-----------|
|src/main/java|자바 소스코드|
|src/main/resources|어플리케이션의 properties / 설정파일|
|src/main/webapp|템플릿과 웹 설정파일 그리고 정적파일|
|src/test|테스트 코드와 properties|
|target|컴파일된 코드 출력물의 최종 지점. 메이븐에 의해서 생성된다.|

## 메이븐 요소

|명칭|설명|
|----|----|
|Group ID|회사이름, 그룹 또는 조직 또는 조합의 도메인 명칭|
|Artifact ID|프로젝트 명칭|
|Version|프로젝트 버전|

## 로컬 리포지토리
```
~/.m2/repository
```
기본적인 위치는 .m2폴더 안에 있다. 메이븐은 중앙 리포지토리에 접근하기 전에 이 로컬리포지토리를 탐색한다.

## 중앙 리포지토리
https://repo.maven.apache.org/maven2/
## 메이븐 빠른 설치
### Eclipse의 경우
```
Help -> Install New Software ... -> m2e 검색
```
하면 대게 설치되어있다. (**m2e - Maven Integration for Eclipse**가 있어야 한다.)

```
신규 프로젝트 생성 -> Other -> Maven -> maven-archetype-webapp
```