# 일대일 관계(OneToOne)
: 일대일 관계의 소유편은 외래키를 가진 엔티티이다.
## 1. 예제
- Owner Entity
```php
/**
 * @ORM\OneToOne(targetEntity="App\Entity\C", cascade={"persist", "remove"})
 */
private $c;
```
cascade: Owner 데이터 변경 시 Target 테이블의 데이터도 연쇄작용된다.



