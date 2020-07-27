# CollectionType

Updated 2019.12.19.thu

## 1. 기본적인 사용법 (Basic Usage)
: 이 타입은 폼애서 컬렉션 비스무리한 걸 다루고 싶을 때 사용한다. <br>
예를 들면, 이메일 주소 배열에 부합하는 이메일 필드가 있다고 가정 할 때, 폼에서는 각각의 메일주소를 자체
input text 상자로 표현하는 경우

```php
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

$builder->add('emails', CollectionType::class, [)
    'entry_type' => EmailType::class,
    'entry_options' => [
        'attr' => ['class' => 'email-box'],
    ]
]);

```
간단하게 렌더링 하자면 ...
```twig
{{ form_row(form.emails) }}
```
이렇게 간단한 예제는 여전히 기존에 존재하는 주소들에 어드레스를 추가하거나 삭제하는 것이 불가능하다.
새로운 주소를 추가할 때에는 `allow_add` 옵션 (그리고 부가적으로 `prototype` 옵션)이 가능하고
삭제할 때에는 `allow_delete`이 가능하다.

## 2. 아아템 추가 및 삭제(Adding and Removing Items)

## 3. 필드 옵션 (Field Options)
### allow_add
    
--

### prototype
Type: `boolean`, default `true` <br><br>
이 옵션은 `allow_add`를 사용 할 때 유용하다. 만약 `true`일 때 새로운 요소와 같은 템플릿을 렌더링 할 수 있는
특수한 "prototype" 속성이 사용가능해진다. 그리고 `name` 속성이 주어진다. 이것은 `__name__`이다.
이는 프로토타입을 읽고 '__name__'을 어떤 독특한 이름이나 숫자로 대체하고 그것을 폼 안에 렌더링하는 자바스크립트를 통해
`add another` 버튼과 같은 것을 추가하는것이 가능해진다. submit하면 allow_add 옵션으로 인해 기본 배열에 추가 된다.
