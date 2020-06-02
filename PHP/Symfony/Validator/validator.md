# 유효성 검사 (Validator)
updated 2020.01.26 
```
// 패키지 설치
composer require symfony/validator doctrine/annotations
```
```
// 네임스페이스 경로
use Symfony\Component\Validator\Constraints as Assert;
```
## @Assert\Length
```php
// 길이 검사
@Assert\Length(
    min=INTEGER, 
    max=INTEGER 
    minMessage=STRING
    maxMessage=STRING
)
```

## @Assert\NotBlank
```
// 공백
@Assert\NotBlack()
```
## @Assert\Type
```
// 타입 검사
@Assert\Type("\DateTime")
```
## @Assert\Email
```
// 이메일 검사
@Assert\Email(message=STRING)￿
```