# Recaptcha
updated 2020.01.31 <br>

v3 recaptcha 기준으로 기록한다.
들어가기에 앞서 https://www.google.com/recaptcha에 방문하여
*Admin Console*에서 공통 키와 비밀 키를 발급 받아야 한다.
```
// 패키지 설치
composer require google/recaptcha
```
컴포저 패키지 설치 완료하였다면 렌더링에 필요한 정적파일과 아래의 div태그를 선언한다.
```
// 템플릿

<script src="https://www.google.com/recaptcha/api.js" async defer></script> 
<script src="https://apis.google.com/js/platform.js" async defer></script>

<div class="g-recaptcha" data-sitekey="공통 키"></div>
```
컨트롤러에서 제공하는 기능은 기본적으로 다음과 같다.
```
use ReCaptcha\ReCaptcha;

...

$recaptcha = new ReCaptcha(비밀키);

$isSuccess = $recaptcha
    ->verify(
        // recaptcha 인증 파라미터
        $request->get('g-recaptcha-response'),
        // 유저 아이피 
        $request->getClientIp()
    )
    ->isSuccess();
// 검증 결과
return $isSuccess;
```