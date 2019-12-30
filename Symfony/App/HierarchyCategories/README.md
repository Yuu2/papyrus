# 계층 카테고리 만들기
Updated 2019.12.18.Wed
```php
// [1] 엔티티 클래스 작성

use Doctrine\Common\Collection\ArrayCollection;
use Doctrine\Common\Collection\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\Table(name="categories")
 */
class Category {
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=45, unique=true)
     */
    private $title
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="subcategories")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Category", mappedBy="parent")
     */
    private $subcategories;
    
    // Getter, Setter 는 생략.
}
```
```php
// [2] 유틸 또는 서비스에 위치한 추상 클래스 작성

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

abstract class CategoryTreeAbstract {
      
    protected static $conn; // DB커넥션 싱글톤패턴으로 생성하자.
    
    public $categories;

    /**
     * @access public
     * @param EntityManagerInterface $entityManager
     * @param UrlGeneratorInterface $generator
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        UrlGeneratorInterface $generator
    ) {
        $this->entityManager = $entityManager; // ORM관리자
        $this->generator     = $generator      // URL생성기
    }

    /**
     * 프론트,어드민 각기 다른 기능을 구현하기 위한 메소드
     *
     * @abstract
     * @access public
     */
    abstract public function getCategories(array $categories) {}    

    /**
     * 부모, 자식 카테고리 취득하가 위한 메소드
     *
     * @access public
     */
    public function buildTree(int $parent_id = NULL): ?array {
        
        $subCategory = [];
        
        foreach($this->categories as $category) {

            if($category['parent_id'] == $parent_id) {
                
                $children = $this->buildTree($category['id']);

                if($children) $category['children'] = $children;
            
                $subCategory[] = $category;
            }
        }
        return $subCategory;
    }
    
    /**
     * DB로부터 모든 카테고리 리스트를 취득
     *
     * @access public
     * @return array
     */
    public function getCategories(): ?array {
        if(self::$conn) {
            return self::$conn;
        } else {
            $conn = $this->entityManager->getConnection();
            $sql  = "SELECT * FROM categories";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return self::$conn = $stmt->fetchAll();
        }
    }
}
```