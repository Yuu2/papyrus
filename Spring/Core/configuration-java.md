# Java 코드기반 설정
자바 클래스로 스프링 설정하는 법.
```
@Configuration
@ComponentScan(상위패키지)
public class Config {

    /**
     * ItemFactory -> 인터페이스
     * Item1 -> 주입 할 객체
     */
    @Bean
    public ItemFactory item1() {
        return new Item1();
    }
}
```
```java
public class SpringMvcApplication {
    
    public static void main(String[] args) {
        
        ApplicationConfigApplicationContext context = new ApplicationConfigApplicationContext(Config.class);
        
        // 주입한 객체를 호출
        context.getBean("item1", Item1.class);
    }
}
```

- @Bean : 주입할 객체 대상
- @ComponentScan : Bean 주입의 대상이 되는 패키지 경로를 설정하게 된다.
- @PropertySouce : 프로퍼티 파일을 주입 할 수 있다.
```
@PropertySource("classpath:logger.properties")
```