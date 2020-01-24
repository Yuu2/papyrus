# 기초(Foundation)
updated 2020.01.24

## 개요
레거시나 다름 없지만 하이버네이트의 기본 작동원리를 익힐 수 있다.

|클래스|설명|
|----|----|
|SessionFactory|하이버네이트 설정파일을 읽고 세션 오브젝트들을 생성한다. 무거운 오브젝트는 앱에서 하나만 생성 할 수 있다.|
|Session|JDBC 커넥션을 랩(Wrap)하고 메인 오브젝트 저장하거나 돌려주기도 한다. 짧은 생명주기의 오브젝트이며 세션 팩토리가 생성한다.|


```
SessionFactory factory = new Configuration()
                        .configure("hibernate.cfg.xml")
                        .addAnnotatedClass(Student.class)
                        .buildSessionFactory();

Session session = factory.getCurrentSession();

try {
    // 트랜잭션 시작
    session.beginTransaction();
    
    // 쿼리 작성
    session.createQuery(
        쿼리,
        클래스.class
    );

    // 데이터 취득
    session.get(클래스.class, id);

    // 데이터 생성
    session.save(객체);

    // 데이터 생성 및 갱신
    session.saveOrUpdate(객체)

    // 데이터 삭제
    session.delete(객체);

    // 트랜잭션 커밋
    session.getTransaction().commit();

} catch(Exception e) {
    // 세션 종료 - 메모리 누수 관련해서 닫아두어야 한다.
    session.close();

    // 세션팩토리 종료
    factory.close();
}               
```