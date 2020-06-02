# 기초(Foundation)
updated 2020.02.24

## 개요
일부코드는 레거시나 다름 없지만 하이버네이트의 기본 작동원리를 익힐 수 있다.

|클래스|설명|
|----|----|
|SessionFactory|하이버네이트 설정파일을 읽고 세션 오브젝트들을 생성한다. 무거운 오브젝트는 앱에서 하나만 생성 할 수 있다.|
|Session|JDBC 커넥션을 랩(Wrap)하고 메인 오브젝트 저장하거나 돌려주기도 한다. 짧은 생명주기의 오브젝트이며 세션 팩토리가 생성한다.|
```java
try(
  
  /* [1] 세션팩토리 생성 */
  SessionFactory sessionFactory = new Configuration()
    .configure("hibernate.cfg.xml")
    .addAnnotatedClass(Student.class)
    .buildSessionFactory();
  
  /* [2] 세션 생성 */
  Session session = factory.getCurrentSession();

) {
  
  /* [3] 트랜잭션 시작 */
  session.beginTransaction();

  /* [4] 쿼리 작성 코드 */

  /* [5] 트랜잭션 커밋 */
  session.getTransaction().commit();

} catch(Exception e) {
  /* [6] 세션 종료 */
  session.close();
  
  /* [7] 세션팩토리 종료 */
  sessionFactory.close();
}               
```
## find()
```java
public User find(Long id) {
  Session session = sessionFactory.getCurrentSession();
  User user = session.get(User.class, id);
  return user;
}
```
## findAll()
```java
public List<User> findAll() {
    Session session = sessionFactory.getCurrentSession();
    return session
      .createQuery("from", User.class)
      .list();
}
```
## findBy()
```java
public User findByName(String name) {
  Session session = sessionFactory.getCurrentSession();
  Query<User> query = session.createQuery("from User where name = :name", User.class);
              query.setParameter("name", name);
  
  return query.getSingleResult();
}
```
## save()
```java

```
## saveOrUpdate()
```java
public void saveOrUpdate(User user) {
	Session session = sessionFactory.getCurrentSession();
		      session.saveOrUpdate(user);
}
```
## delete
```java

```