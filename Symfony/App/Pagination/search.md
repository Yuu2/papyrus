# 검색 (Search)
updated 2020.01.20


## 1. 폼 전송
```
<form method="GET", action="{{ path('pagination') }}">
    <input type="text" name="search" />
    <button type="submit">SUBMIT</button>
</form>
```
## 2. 컨트롤러 처리
```
// Controller
/**
 * @Route("/pagination", name="pagination")
 */
public function index(Request $request) {
    $page = $request->get('page');
    $search = $request->get('search');
    ...
    $this->getDoctrine()->getRepository(엔티티::클래스)->커스텀메소드($page, $search);
}
```
파라미터 명칭은 자유이다만은 폼으로 부터 검색한 문자열을 받아서 리포지토리로 건내야 한다.

## 3. 동적 쿼리 작성
```php
class 리포지토리 extends ServiceEntityRepository {
    
    ...
    
    
    public function 검색($page, $search) {
        
        $query = $this->createQueryBuilder('v')

        foreach($this->가공($search) as $key => $val) {
            
            $query
            /**
             *  where 조건에 
             */ 

            ->orWhere('a.title LIKE :조건컬럼1_' . $key)
            ->orWhere('a.title LIKE :조건컬럼2_' . $key)

            ->setParameter('title_' . $key, '%' . trim($val) . '%')
            ->setParameter('content_' . $key, '%' . trim($val) . '%');
        }
        ->getQuery();
            
        /**
         * 세번째 매개변수 5는 웹페이지에 보낼 아이템의 기본 갯수다.
         */
        return $this->paginator->paginate($query, $page, 5);       
    }
    

    private function 가공(string $search): array {
        
        $searchArr = explode(' ', $search); // 띄워쓰기한 문자열을 배열로 보존
 
        $searchArr = array_unique($searchArr); // 배열 데이터의 중복을 제거한다.

        return array_filter($searchArr, function($s) { // 배열 데이터 중 문자열이 2이상인 것만 구분한다.
          return 2 <= mb_strlen($s);
        });
    }
}
```
