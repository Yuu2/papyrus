# @OneToOne
updated 2020.01.23
## 단방향 (Uni-Directional)
- 엔티티의 생명주기

|Cascade 타입|설명|
|---|---|
|DETACH|엔티티가 detached 되면, 하이버네이트 세션과 상관없게 된다.|
|MERGE|인스턴스가 세션으로부터 detached 되면 merge는 세션에 reattach 할 것이다.|
|PERSIST|관리되는 새로운 인스턴스인 트랜지션. 다음 flush / commit로 db에 보존.|
|REMOVE|삭제되기 위한 관리되는 엔티티인 트랜지션. 다음 flush / commit로 db에서 삭제.|
|REFRESH| db 에서 Reload / synch 되는 오브젝트 데이터. 데이터 상태를 보호. |
|ALL|모든 cascade 타입을 실행|

- 간단한 예제
```
// Owner

@Entity
@Table(name="user")
public class User {
    
    @Id @GeneratedValue(strategy=GenerationType.IDENTITY)
    private Long id;
    
    @Column(name="name")
    private String name;
    
    @OneToOne(cascade=CascadeType.ALL)
    @JoinColumn(name=address) // 관계키
    private Address address;

    ...
}
```
```
// Member

@Entity
@Table(name="address")
public class Address {
    
    @Id @GeneratedValue(strategy=GenerationType.IDENTITY)
    private Long id;
    
    @Column(name="name")
    private String name;

    ...
}
```

## 2. 양방향 (Bi-Directional)

```
// One

@Entity
@Table(name="user")
public class User {
    
    @Id @GeneratedValue(strategy=GenerationType.IDENTITY)
    private Long id;
    
    @Column(name="name")
    private String name;
    
    @OneToOne(cascade=CascadeType.ALL)
    @JoinColumn(name=address) // 관계키
    private Address address;

    ...
}
```
```
// One

@Entity
@Table(name="address")
public class Address {
    
    @Id @GeneratedValue(strategy=GenerationType.IDENTITY)
    private Long id;
    
    @Column(name="name")
    private String name;

    @OneToOne(mappedBy="user", cascade = CascadeType.ALL)
    private User user;

    ...
}
```
역방향인 Address에서 User를 조회 할 수 있다.
한편, Address는 삭제 하나 User 데이터는 남기고 싶다면 즉, User의 관계키를 null 로 설정하기 위해서는 CascadeType을 바꿀 필요가 있다.
CascadeType.REMOVE를 제외한 나머지 **{CascadeType.DETACH, CascadeType.REFRESH ... }** 로 설정하면 Owner인 User의 관계키는 null로 남게 된다.
그리고 실제 실행부 클래스에서는 User.setAddress(null) 지정과 세션팩토리를 직접 다룬다면 메모리 누수를 제어하기 위해 finally 블록 안에서 session.close() 해주는 것을 잊지 말자.