# 마이바티스 (MyBatis)
updated 2020.02.16 <br>
## 개요
MyBatis3에 해당하는 라이브러리를 기술함.

## 시작하기
```java
@SpringBootApplication
@MapperScan("mapper 패키지 경로")
public class BoardApplication {
 
  public static void main(String[] args) {
    SpringApplication.run(BoardApplication.class, args);
  }
    
  /**
    * SqlSessionFactory 설정
    */
  @Bean
  public SqlSessionFactory sqlSessionFactory(DataSource dataSource) throws Exception{
    SqlSessionFactoryBean sessionFactory = new SqlSessionFactoryBean();
                          sessionFactory.setDataSource(dataSource);
    return sessionFactory.getObject();
  } 
}
```