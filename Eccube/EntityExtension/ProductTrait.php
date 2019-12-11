<?php

namespace Customize\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Annotation\EntityExtension;

/**
 * [소개]
 * trait와 @EntityExetension 어노테이션을 사용해서 Entity의 필드를 확장 할 수 있다.
 * 상속하지 않고 Proxy 클래스를 생성하기 위해서 복수의 플러그인이나 독자적인
 * 커스터마이즈로 부터 확장을 공유 할 수 있다.
 * 
 * [어노테이션]
 * @EntityExtension : 매개변수로 trait를 적용시키고 싶은 클래스를 지정
 * @FormAppend : 어노테이션을 추가하는 것만으로 폼을 자동생성 할 수 있다. 세세하게 커스터마이즈 하고 싶을 경우 auto_render=false
 *  
 */

/**
 * @EntityExtension("Eccube\Entity\Product") 
 */
trait ProductTrait {
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Eccube\FormAppend(
     *     auto_render=false,
     *     form_theme="Form/company_name_vn.twig",
     *     type="\Symfony\Component\Form\Extension\Core\Type\TextType",
     *     options={
     *          "required": true,
     *          "label": "会社名(VN)"
     *     }
     * )
     */
    public $maker_name;
}

/**
 * [trait 구현 후 해야 할 일]
 * 
 * 1. 프록시 클래스 생성
 * bin/console eccube:generate:proxies
 * 
 * 2. 데이터베이스 스키마 업데이트
 * bin/console doctrine:schema:update --dump-sql (SQL 확인)
 * bin/console doctrine:schema:update --dump-sql --force (SQL 실행)
 * 
 */