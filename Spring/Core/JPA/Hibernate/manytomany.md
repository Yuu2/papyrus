# @ManyToMany
updated 2020.01.23

```
// Many - Owner

@Entity
@Table(name="user")
public class User {

    @Id @GeneratedValue(strategy=GenerationType.IDENTITY)
    private Long id;

    @Column(name="name")
    private String name;

    @ManyToMany(
        fetch = FetchType.LAZY,
        cascade = {
        CascadeType.PERSIST, CascadeType.MERGE, CascadeType.DETACH, CascadeType.REFRESH
     })
    @JoinTable(
        name="user_article",
        joinColumns=@JoinColumn(name="user_id")
        inverseJoinColumns=@JoinColumn(name="article_id")
    )
    private List<Article> articles;
    
    ...

    public void add(Article article) {
        if(articles == null) articles = new ArrayList<>();

        articles.add(article);
    }
}
```
```
// Many

@Entity
@Table(name="article")
public class Article {

    @Id @GeneratedValue(strategy=GenerationType.IDENTITY)
    private Long id;

    @Column(name="title")
    private String title;

    @ManyToMany(
            fetch = FetchType.LAZY,
            cascade = {
            CascadeType.PERSIST, CascadeType.MERGE, CascadeType.DETACH, CascadeType.REFRESH
    })
    @JoinTable(
        name="user_article",
        joinColumns=@JoinColumn(name="article_id")
        inverseJoinColumns=@JoinColumn(name="user_id")
    )
    @JoinColumn(name="article_id")
    private Article article;

    ...
}
```
ManyToMany 관계에 있는 user, course 테이블의 관계키는 user_course에 있음.