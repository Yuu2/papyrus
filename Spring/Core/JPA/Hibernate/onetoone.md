# @OneToOne
updated 2020.01.22
## 단방향 (Uni-Directional)

|Cascade 타입|설명|
|---|---|
|PERSIST|엔티티가 persist / saved 된다면 관계 엔티티 또한 persisted|
|REMOVE|엔티티가 removed / deleted 된다면 관계 엔티티 또한 deleted|
|REFRESH||
|DETACH||
|MERGE||
|ALL|모든 cascade 타입을 실행|

간단한 예제는 아래와 같다. <br>
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