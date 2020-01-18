# 페이징 (Paging)
updated 2020.01.16
```
composer require knplabs/knp-paginator-bundle
```

```yaml
# config/packages/paginator.yaml

knp_paginator
    page_range: 5
    default_options:
      page_name: page
      sort_field_name: sort
      sort_direction_name: direction
      distinct: true
      filter_field_name: filterField
      filter_value_name: filterValue
    template:
      pagination: '@KnpPaginator/Pagination/sliding.html.twig'
      sortable: '@KnpPaginator/Pagination/sortable_link.html.twig'
      filtration: '@KnpPaginator/Pagination/filtration.html.twig'
```
페이징 버튼 템플릿을 바꾸고 싶다면 **knp_paginator.template.pagination** 의 값을 바꾸면 된다.
<br><br>
- @KnpPaginator/Pagination/sliding.html.twig (default)
- @KnpPaginator/Pagination/twitter_bootstrap_v4_pagination_html.twig
- @KnpPaginator/Pagination/twitter_bootstrap_v3_pagination_html.twig
- @KnpPaginator/Pagination/twitter_bootstrap_pagination_html.twig
- @KnpPaginator/Pagination/foundation_v5_pagination.html.twig
...

## 1. 컨트롤러 처리
```
// Controller
/**
 * @Route("/{page}", defaults={"page", "1"}, name="pagination")
 */
public function index(int $page) {
    ...
    $this->getDoctrine()->getRepository(엔티티::클래스)->커스텀메소드($page)
}
```
페이징을 하기 위해서는 **page**파라미터가 필요하다. 기본값은 1로 설정한다.
그리고 리포지토리의 find 메소드를 만들어야 한다.
## 2. 커스텀메소드 작성
```php
<?php

namespace App\Repository;

use App\Entity\엔티티;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\Registry\RegistryInterface;
// [1] 임포트
use Knp\Component\Pager\PaginatorInterface;
## 리포지토리
...

class 리포지토리 extends ServiceEntityRepository {
    
    // [2] 생성자 필드 주입
    public function __construct(RegistryInterface $registry, PaginatorInterface $paginator) {
        parent::__construct($registry, 엔티티::class);
        $this->paginator = $paginator
    }
    
    // [3] 커스텀 메소드 작성
    public function 커스텀메소드($page) {
        $dbQuery = $this->createQueryBuilder('v')
            ->getQuery();
            
        /**
         * 세번째 매개변수 5는 웹페이지에 보낼 아이템의 기본 갯수다.
         */
        return $this->paginator->paginate($dbQuery, $page, 5);       
    }
}
```
## 3. 페이지네이션 렌더링
리포지토리를 작성했으면 템플릿에 페이징 버튼을 추가해야한다.
```
{{ knp_pagination_render(페이징오브젝트) }}
```
마지막으로 캐시 클리어 해주자.
```
bin/console cache:clear
```
## 참고 (Reference)
https://github.com/KnpLabs/knpPaginatorBundle
