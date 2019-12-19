# 다대다 관계(ManyToMany)
: N:N 관계
## 1. 예제
- 엔티티 A
```php
/**
 * @ORM\ManyToMany(targetEntity="App\Entity\A", inversedBy="e")
 */
private $d;

/**
 * @ORM\ManyToMany(targetEntity="App\Entity\A", mappedBy="d")
 */
private $e;
```
: bin/console make:entity A
```
Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > d

 Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > A

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > ManyToMany

 Do you want to add a new property to User so that you can access/update User objects from it - e.g. $user->getUsers()? (yes/no) [yes]:
 > 

 A new property will also be added to the User class so that you can access the related User objects from it.

 New field name inside A [a]:
 > e

```