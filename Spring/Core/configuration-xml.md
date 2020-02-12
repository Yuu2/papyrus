# XML 기반 설정
updated 2020.01.20
##
#### 정적 리소스
```xml
<mvc:resources mapping="/resources/**" location="/resources/"></mvc:resource>
```

#### message 리소스
```xml
<bean id="messageSource"
    class="org.springframework.context.support.ResourceBundleMessageSource">
    
    <property name="basenames" value="resources/messages"/>

</bean>
``` 