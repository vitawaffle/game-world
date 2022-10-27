<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @template T of App\Entity\SqlEntity
 * @template-extends ServiceEntityRepository<T>
 */
class SqlRepository extends ServiceEntityRepository
{
}
