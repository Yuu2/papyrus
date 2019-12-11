## Service
## 1. 태그
: 태그된 이벤트가 실행될 때 서비스 객체가 생성된다. 
- services.yaml
```php
App\Services\ExampleService:
    tags:
        - { name: doctrine.event_listener, event: postFlush }
        - { name: kernel.cache_clearer }
```
- 서비스
```php
class ExampleService {
    public function __construct() {
        dump('constructed');
    }
    public function postFlush() {
        dump('postFlush');
    }
    public function clear() {
        dump('clear');
    }
}
```
- 컨트롤러
```php
    /**
     * @Route("/home", name="home")
     */
    public function index() {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find(1)
        $em->persist($user);
        $em->flush(); 
    }
```
: Service의 postFlush 메소드가 실행된다.
```
bin/console cache:clear
``` 
: Service의 clear 메소드가 실행된다.
## 2. 인터페이스 구현체
: 컨트롤러에 ServiceInterface를 건내고 서비스마다 각기 다른 구현 클래스를 줄 수 있다.
##
- services.yaml
```php
App\Services\ServiceInterface: '@App\Services\ExampleService'
```

## 3. 디버그
```
bin/console debug:autowiring
```
: 서비스 컨테이너에 등록된 클래스를 열람 할 수 있다.