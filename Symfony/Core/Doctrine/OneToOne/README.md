# 일대일 관계(OneToOne)
Updated 2019.12.17.Tue

## 단방향(Unidirectional)

```php
class Parent {

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Child")
     */
    private $Child;
}
```
: 자식 테이블 관계 키는 디폴트로 적용된다.

## 양방향(Bidirectional)
```php
/** @Entity */
class Parent {
    /**
     * @OneToOne(targetEntity="Child", mappedBy="Parent")
     */
    private $Child;
}

/** @Entity */
class Child {
    /**
     * @OneToOne(targetEntity="Parent", inversedBy="Child")
     */
    private $Parent;
}
```
: @JoinColumn은 필수 요소는 아니다. 디폴트 값으로 적용 된다.


