<?php

declare(strict_types=1);

namespace App\Repositories;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function findAllOrderByName()
    {
        return $this->findBy([], ['name' => 'ASC']);
    }
}
