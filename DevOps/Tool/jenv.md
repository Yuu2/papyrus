# jEnv 
updated 2020.02.04

## 개요
Mac OS에서 복수의 자바 버전을 관리하기 위한 툴

## 자바 버전 확인
```
jenv versions
```

## JDK 설정하기
```
// 지역 설정
jenv local JDK경로/Contents/Home

// 전역 설정
jenv global JDK경로/Contents/Home
```

## JDK, 메이븐 동기화
```
/* Maven 동기화 */
jenv exec mvn -version
```