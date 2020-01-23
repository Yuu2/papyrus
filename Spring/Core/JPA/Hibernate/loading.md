# 로딩 (Loading)
updated 2020.01.23

## Lazy
- 요청에 의한 검색 <br>
**@OneToMany, @ManyToMany**는 Lazy 로딩에 해당한다. <br>
- 세션이 닫히면 예외 발생
- 예외가 발생되면 닫기 전에 lazy data를 취득해두거나 HQL JOIN FETCH를 이용할 것 (연관된 데이터를 한번에 취득하는 쿼리).

## Eager
- 모든 것을 검색 (가급적 사용하지 않는걸 추천)<br>
**@OneToOne, @ManyToOne**는 Eager 로딩에 해당한다.

