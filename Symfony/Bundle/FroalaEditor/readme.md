# FroalaEditor
updated 2020.01.31

```
composer require kms/froala-editor-bundle
```
컴포저로 번들패키지를 설치한다.
```
// config/bundles.php
return [
    //..
    KMS\FroalaEditorBundle\KMSFroalaEditorBundle::class => ['all' => true],
];
```
그 다음 bundles.php 에 등록되어 있는지 확인 한 후 환경설정 파일을 작성한다.
```
# app/config/packages/kms_froala_editor.yaml

kms_froala_editor:
    language: '%locale%' # 언어셋은 프레임워크 변수에 따른다.
    pluginsDisabled: ["save"]
twig:
  form_themes:
    - '@KMSFroalaEditor/Form/froala_widget.html.twig'
```
그리고 정적 파일을 설치해주어야 한다.
```
bin/console froala:install
```
Docker 컨테이너로 환경구축을 했다면 리눅스 권한 문제로 고생 할 수 있다.
왠만하면 컨테이너 콘솔에서 커맨드를 실행 할 것.
```
bin/console assets:install --symlink public
```
다음으로 정적파일을 public 경로와 링크를 이어주만 하면 된다.
```
<link href="경로/froala_style.min.css" rel="stylesheet" type="text/css" />
```
템플릿에 필요한 CSS 파일을 넣어주고 마지막으로 폼타입 작성을 해주자.
```
use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;

$builder
    ->add('텍스트타입 필드', FroalaEditorType::class);
```

## 참고 (Reference)
https://github.com/froala/KMSFroalaEditorBundle 