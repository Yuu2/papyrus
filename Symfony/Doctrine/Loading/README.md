# 로딩(Loading)
: 즉시로딩 / 지연로딩

## 1. 사용법
```php
public function findWithItems($id): ?User {
  return $this->createQueryBuilder('u')
  ->innerJoin('u.items', 'i')

  // ->addSelect('i') is Eager loading ...

  ->andWhere('u.id = :id')
  ->setParameter('id', $id)
  ->getQuery()
  ->getOneOrNullResult();
}
```

- Eager
: 엔티티를 조회 할 때 연관된 엔티티도 함께 조회한다 (즉시로딩)

- Lazy
: 엔티티를 조회 할 때 연관된 엔티티를 실제 사용할 때 조회한다 (지연로딩)
