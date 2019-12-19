# 트윅 필터 (Twig Filter)
Updated 2019.12.17.Tue
```
bin/console make:twig-extension
```
```php
class AppExtension extends AbstractExtension {
    
    // 필터 생성
    public function getFilters(): array {
        return [
            new TwigFilter('test', [$this, 'test']),
        ]
    }
    
    // 필터 커스터마이즈
    public function test() {
    
        return [];
    }
}
```