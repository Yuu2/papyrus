## Rest API
updated 2020.01.14

## @RestController

## @Data

## 컬렉션 조회 V3
```
// [1] Api 매핑
@GetMapping("/api/v3")
public List<EntityDto> v3() {
    
    List<Entity> entities = 쿼리
    
    return entities.stream()
        .map(EntityDto::new)
        .collect(Collectors.toList());
}
```
```
// [2] 쿼리 작성
public List<Entity> 쿼리() {
    return em.createQuery(
        "select distinct e from Entity e" +
        " join fetch e.조인테이블 a" + 
        ...
    ).getResultList();
}
```
**distinct**는 1대다 row의 중복조회를 방지해준다.
그러나, 페이징이 안된다는 단점이 있다.