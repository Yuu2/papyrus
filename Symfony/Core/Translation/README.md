# 번역 (Translation)

## 개요 (Summary)
- 설치
```
composer require symfony/translation
```
- translation.yaml
```yaml
framework:

    default_locale: '%locale%'

    translator:
        #  언어 파일이 있는 디폴트 디렉토리
        default_path: '%kenel.project_dir%/translations'

        fallbacks:
            - '%locale%'
```
- services.yaml
```yaml
    parameters:
        # ...
        # 지정할 언어 
        locale: 'en'
```
## 템플릿 번역
- Twig
```twig
<html lang="{app.request.locale}">

<!-- ... -->

</html>
```
: %locale%에 해당하는 언어셋이 지정된다.

```twig
<html lang="{app.request.locale}">

{% trans %}

{% endtrans %}

</html>
```
: {% trans %} 안의 내용은 'messages.xx.yaml'의 키값으로 변환된다.

##
- messages.en.yaml
```yaml
some:
    key: Hello <b>Symfony</b>
```
- Twig
```twig
{{ some.key|trans }}
```
: 계층 키값을 사용 할 수도 있다.
## 
- Twig
```twig
{{ some.key|trans|raw }}
```
: raw를 사용한다면 html 태그를 반영해서 출력 할 수 있다.
## 컨트롤러 번역
- Controller
```php
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @Route()
 */
public function index(TranslatorInterface $translator) {

// messages.xx.yaml의 'some.key'를 번역한다.
$message = $translator->trans('some.key');

}
```
## 경로(Route) 번역
- annotations.yaml
```yaml 
prefix:
    en: '' # 기본설정
    ko: '/ko'
    jp: '/jp'

    # ...
```
: 접두사로 설정되는 경로.
- Controller
```php
/**
 * @Route(
 * "en": "/test",
 * "ko": "/test",
 * "jp": "/test"
 * }, name="test", methods={"GET", "POST"})
 */
public function index() { // ... }
```
: '/ko/test'로 접속하면 한국어로 번역이 되고, '/jp/test'로 접속하면 일본어로 번역된다.
## 복수화(Pluralization)
- Controller
```php
return $this->render(
    'count' => $number
);
```
- messages.xx.yaml
```yaml
test: "{0}A|{1}B|{2}C|{3}D|{4}E"
```
: 숫자에 해당하는 텍스트가 출력된다. 예를 들면, 'count'가 0이면 A가 출력된다.