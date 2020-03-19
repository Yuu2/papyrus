# 매개변수 (Argument)
updated 2020.03.18

## 개요
매개변수의 목록으로 부터 함수에 정보를 건낼 수 있다. 이 목록은 컴마로 구분 된 식의 목록이다. 매개변수의 평가는 왼쪽에서 오른쪽으로 행해진다.
<br>
PHP는 값 건내기 (Default), 참조 건내기, 매개변수의 기본 값을 서포트 하고 있다. 그리고 가변인수 리스트도 서포트하고 있다.

## 1. 매개변수의 참조건내기

## 2. 매개변수의 기본 값

## 3. 형선언
형선언을 하면 함수를 호출 할 때 건내는 파라미터가 특정 형인지를 함수 선언할 때 요구 할 수 있게 된다. 함수에 건내어진 값이 정확하지 않은 형일 때 에러를 발생시킨다. PHP5에서는 이 에러를 recoverable fatal error 였다.
PHP7에서는 TypeError 예외를 발생시킨다.

|형|설명|이용가능한 PHP버전|
|---|---|---|
|self|파라미터는 그 메소드가 정의하고 있는 클래스와 같은 클래스의 인터페이스 이지 않으면 안된다. 이것을 사용 하는 것은 클래스 메소드나 인터페아스 메소드 뿐 입니다.|5.0.0|
|string||5.1.0|
|callable||5.4.0|
|bool||7.0.0|
|int||7.0.0|
|string||7.0.0|
|iterable||7.1.0|
|object||7.2.0|


#### Q. bool vs boolean 차이는 뭔가요?
bool의 별칭이다. 타입힌팅에서는 적용되지 않으므로 별칭은 사용하지 않는 것이 좋다. <br>
https://stackoverflow.com/questions/44009037/php-bool-vs-boolean-type-hinting

## 참조 (Reference)
https://www.php.net/manual/ja/functions.arguments.php