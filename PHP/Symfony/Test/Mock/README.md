# Mock

## 개요 (Summary)
```php
public class TestService {
    public function getData() {}
}
: 테스트 할 대상
```
- 컨트롤러
```php

// 모크 생성
$test = $this->getMockBuilder(TestService::class)
    
  // 테스트 할 메소드 설정
  ->setMethods('getData')
    
  // 모크 호출
  ->getMock()

$test->expects($this->any())
    
    // 테스트 할 모크 메소드 지정
    ->method('getData')

    // 예상되는 반환 값.
    ->willReturn($DATA);
```

## 