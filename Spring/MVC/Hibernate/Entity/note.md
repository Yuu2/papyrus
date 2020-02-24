# 엔티티 (Entity)
updated 2020.01.22
## @GeneratedValue
```
@GeneratedValue(strategy=GenerationType.타입)
```
|명칭|설명|
|----|----|
|GenerationType.AUTO|분산 데이터베이스에서 알아서 적절하게 고르도록 함.|
|GenerationType.IDENTITY|고유 컬럼에 기본키를 지정|
|GenerationType.SEQUENCE|데이터베이스 시퀀스에 기본키 지정|
|GenerationType.TABLE|고유함을 보장하는 근본적인 데이트베이스 테이블에 기본키를 지정