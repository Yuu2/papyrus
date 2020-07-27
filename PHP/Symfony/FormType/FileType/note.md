# FileType
updated 2020.01.26

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
```php
// 폼타입 컬럼 추가
->add('file', FileType::class, array());
```
```php
// 컨트롤러 메소드

$file = $form->get('file')->getData();

$filName = sha1(random_bytes(14).'.'.$file->guessExtension());

$file->move($DIRECTORY));

// 이 후 데이터베이스에 파일명 보존하기
```