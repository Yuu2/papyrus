# 일대다 관계(OneToMany), 다대일 관계(ManyToOne)
: 일대다 관계(OneToMany)는 항상 양방향 관계의 반대편(Inverse Side)이다. <br>
: 다대일 관계(ManyToOne)는 항상 양방향 관계의 소유편(Owning Side)이다.

## 1. 개요 (Summary)
```php
/** 
 * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="$user")
 */
private $articles;
```
- cascade
[User] 삭제시 [Article]의 관계키를 NULL로 만든다. (삭제하지 않음) <br>
ex). cascade={"remove"}


- orphanRemoval  
A 삭제시 [Article]의 해당 리코드를 함께 제거된다. <br>
ex). orphanRemoval=true

--
```php
/**
 * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="articles")
 */
private $user;
```
@ORM\JoinCoulmn(onDelete="CASCADE") <br>
: [User] 삭제시 user_id를 함께 삭제한다.

## 2. 측면 (Side)
- mappedBy <br>
: 이 속성은 소유편을 참조하기 위해서 양방향 관계의 반대편에 넣는다. <br>
: 이 속성은 OneToOne, OneToMany 또는 ManyToMany 매핑 정의를 다룬다.

- inversedBy <br>
: 이 속성은 반대편을 참조하기 위해서 양방향 관계의 소유편에 넣는다. <br>
: 이 속성은 OneToOne, ManyToOne 또는 ManyToMany 매핑 정의를 다룬다.
