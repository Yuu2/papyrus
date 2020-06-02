# JSTL
updated 2020.01.24

## form
- #### form
```
<form:form action="경로", modelAttribute="객체", method="메소드">

    ...

</form:form>
```
- #### input
```
<form:input path="필드" />
```
## c 태그
- #### for 
```
<c:forEach var="자식" items="부모">

    ${자식}

    ...

</c:forEach>
```
- #### url
```

/**
 * 호스트:포트/?경로 파라미터=전송데이터
 */
<c:url var="링크" value="경로">
    <c:param name="파라미터" value="전송데이터"/>
</c:url>

<a href="${링크}">Click!</a>
```

## 자주 사용하는 라이브러리 목록
```
/* 연산자 JSP 라이브러리 */
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>

/* 폼 JSP 라이브러리 */
<%@ taglib uri="http://www.springframework.org/tags/form" prefix="form" %>

/* 시큐리티 JSP 라이브러리 */
<%@ taglib prefix="sec" uri="http://www.springframework.org/security/tags" %>
```