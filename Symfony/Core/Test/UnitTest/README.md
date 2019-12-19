# 유닛테스트(UnitTest)

## 개요 (Summary)
- 테스트 실행
```
bin/phpunit
```
- 유닛테스트 설치
```
bin/console make:unit-test
```
- 기본 예제
```php
use PHPUnit\Framework\TestCase;

// 비지니스 로직등 국소적인 부분만을 테스트 한다.
class SampleTest extends TestCase {
    
    public function test1() {}
    public function test2() {}
    // ... 메소드 순서대로 테스트를 실행한다.
}
```

