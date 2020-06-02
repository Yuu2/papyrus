## REST API
updated 2020.02.25
 
## 개요

## @RestController

## @Data

## 컬렉션 조회 (OneToMany)
```
// [1] Api 매핑
@GetMapping("/api")
public List<엔티티DTO> api() {
    
    List<엔티티> entities = find쿼리
    
    return entities.stream()
        .map(엔티티DTO::new)
        .collect(Collectors.toList());
}
```
```
// [2] 쿼리 작성
public List<Entity> 쿼리() {
    return em.createQuery(
        "select distinct e from 엔티티 e" +
        " join fetch e.조인테이블 a" + 
        ...
    ).getResultList();
}
```
**distinct**는 1대다 Row의 중복조회를 방지해준다.
그러나, 컬렉션을 패치 조인하게 되버리면 페이징이 불가능하다.
그러면 페이징, 컬렉션 엔티티를 어떻게 함께 조회 할 수 있을까.

- XToOne관계를 모두 패치 조인한다. XToOne 관계는 Row수를 증가 시키지 않으므로
페이징 쿼리에 영향을 주지 않는다.
- 컬렉션은 지연 로딩으로 조회한다.
- 지연 로딩 성능 최적화를 위해, **hibernate.default_batch_size** 또는 **@BatchSize**를 적용한다.

```
@GetMapping("/api")
public List<엔티티Dto> api(
    @RequestParam(value = "offset", defaultValue = "0") int offset,
    @RequestParam(value = "limit", defaultValue = "100") int limit) {
      
    List<엔티티> entities = find쿼리(offset, limit);
    List<엔티티Dto> result = entities.stream()
        .map(e -> new 엔티티Dto(e))
        .collect(toList());
    return result;
}
```
```
# application.yml
Spring:
    jpa:
        properties:
            hibernate:
                default_batch_fetch_size: 1000 # 전역 최적화 설정
```
find쿼리는 위 쿼리와 동일하다. 그러나 DB 데이터 전송량이 최적화된다. 패치 조인 방식과 비교해서 쿼리 호출 수가 약간 증가하지만
DB 데이터 전송량이 감소한다. XToOne관계는 페이징에 영향을 주지 않는다. 따라서 XToOne 관계는 패치 조인으로 쿼리 수를 미리 줄이고 
나머지는 위 옵션(100 ~ 1000)으로 최적화 할 것. 
