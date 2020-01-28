# 폼(Form)
updated 2020.01.26
```
// 폼타입 생성
bin/console make:form
```
```php
// 기본적인 폼 빌더 사용법.
$form = $this->createForm(
    ENTITYType::class, 
    ENTITY, 
    array()
);

// Request를 바인딩함.
$form->handleRequest($request);

if($form->isSubmitted() && $form->isValid()) {
    // ...
}
```
## Novalidate
HTML5에서는 기본적인 유효성 검사를 제공하고 있다. CSS 디자인을 적용한다거나 할 때 부가옵션으로
createForm의 option 매개변수에 아래와 같은 코드를 넣으면 기본 유효성 검사를 무시한다.
```
$form = $this->createForm(
    ENTITYType::class, 
    ENTITY, 
    'attr' => array('novalidate' => 'novalidate')
);
```
