# 폼 (Form)


## 1. 개요
- 설치
```
bin/console make:form
```
- 사용법
```php
$form = $this->createForm(ENTITY_FormType::class, ENTITY);
$form->handleRequest($request);

if($form->isSubmitted() && $form->isValid()) {
    // ...
}
```

## 2. 유효성 검사(Validation)
- 컴포넌트 설치
```
composer require symfony/validator doctrine/annotations
```
#### B. 사용법
```php
// 길이
@Assert\Length(
    min=INTEGER, 
    max=INTEGER 
    minMessage=STRING
    maxMessage=STRING
)
// 공백
@Assert\NotBlack()
// 타입
@Assert\Type("\DateTime")
// 이메일
@Assert\Email(message=STRING)
￿
```
#### c. 옵션
```php
mapped => false
```
데이터 베이스에 없는 컬럼을 추가 할 때에 지정한다.

## 3. 테마 설치
- twig.yaml
```
 twig:
    form_themes: ['bootstrap_4_layout.html.twig']
```
- 템플릿
```
{% form_theme form 'form_table_layout.html.twig' %}
```
## 5. 파일 업로드 하기
- 엔티티
```php
 /**
  * @ORM\Column(type="string", length=255)
  * @Assert\File(
  *     maxSize = "1024k"
  *     mimeTypes = {"video/mp4", "application/pdf", "application/x-pdf"},
  *     mimeTypesMessage = "Please upload a valid video"
  * )
  */
  private $file;
```
- 폼타입
```php
->add('file', FileType::class, array());
```
- 컨트롤러
```php
$file = $form->get('file')->getData();

$filName = sha1(random_bytes(14).'.'.$file->guessExtension());

$file->move($DIRECTORY));

// 이 후 데이터베이스에 파일명 보존하기
```
