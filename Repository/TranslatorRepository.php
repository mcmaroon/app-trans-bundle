<?php
namespace App\TransBundle\Repository;

use App\AppBundle\Helper\AbstractRepository;

class TranslatorRepository extends AbstractRepository
{

    public function setSelect($queryBuilder)
    {
        
        $this->addWhereFilter('like', 'strId', 'r.strId');
        
        $queryBuilder->select(array(
            'id' => 'r.id AS id',
            'strId' => 'r.strId AS strId',
            'obj' => 'r AS obj',
        ));

        $this->addTranslationFilter($queryBuilder, 'name');

        $queryBuilder->groupBy('r.id');
        return $queryBuilder;
    }
}
