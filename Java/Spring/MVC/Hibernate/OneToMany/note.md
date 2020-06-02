# @OneToMany
updated 2020.01.23
## 단방향 (Uni-Directional)
```
// One

@Entity
@Table(name="user")
public class User {

    @Id @GeneratedValue(strategy=GenerationType.IDENTITY)
    private Long id;

    @Column(name="name")
    private String name;

    @OneToMany(cascade = CascadeType.ALL)
    @JoinColumn(name="friend_id")
    private List<Friend> friends;
    // 관계키가 friend 테이블에 생성된다!
    ...

    public void add(Friend friend) {
        if(friends == null) friends = new ArrayList<>();

        friends.add(friend);
    }
}
```
```
// Many

@Entity
@Table(name="friend")
public class Friend {

    @Id @GeneratedValue(strategy=GenerationType.IDENTITY)
    private Long id;

    @Column(name="name")
    private String name;

    ...
}
```


## 양방향 (Bi-Directional)
```
// One

@Entity
@Table(name="user")
public class User {

    @Id @GeneratedValue(strategy=GenerationType.IDENTITY)
    private Long id;

    @Column(name="name")
    private String name;

    @OneToMany(mappedBy="user", cascade = {
        CascadeType.PERSIST, CascadeType.MERGE,
        CascadeType.DETACH, CascadeType.REFRESH
    })
    private List<Friend> friends;

    ...

    public void add(Friend friend) {
        if(friends == null) friends = new ArrayList<>();

        friends.add(friend);
        friend.setUser(this);
    }
}
```
```
// Many

@Entity
@Table(name="friend")
public class Friend {

    @Id @GeneratedValue(strategy=GenerationType.IDENTITY)
    private Long id;

    @Column(name="name")
    private String name;

    @ManyToOne(cascade = {
        CascadeType.PERSIST, CascadeType.MERGE,
        CascadeType.DETACH, CascadeType.REFRESH
    })
    @JoinColumn(name="user_id")
    private User user;

    ...
}
```