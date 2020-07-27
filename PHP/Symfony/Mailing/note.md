# 메일링(Mailing)
updated 2019.12.31
```
# swiftmailer.yaml

swiftmailer:
    url: '%env(MAILER_URL)%'
    spool: { type: 'memory' }
```
- 컨트롤러
```php
public function mailing(\Swift_Mailer $mailer) {

    $message = (new \Swift_Message('HELLO SWIFTMAILER'))
    
    // [1] 보내는 이
        ->setFrom('send@example.com')
    // [2] 받는 이
        ->setTo('to@example.com')
    // [3] 메일 내용
        ->setBody(
            $this->>renderView(
            'email/registraion.html.twig',
            array('name' => 'YU'),
            'text/html'
        ));
    
    // [4] 메일송신
    $mailer->send($message);
}
```
## 2. 스풀링(Spooling)
- swiftmailer.yaml
```php
spool:
    type: file
    path: '%kernel.project_dir%/var/spool'
```

