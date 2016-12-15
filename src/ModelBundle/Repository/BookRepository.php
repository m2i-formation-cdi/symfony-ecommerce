<?php

namespace ModelBundle\Repository;

/**
 * BookRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BookRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllPaginated($maxPerPage = 5, $page=1){
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->setMaxResults($maxPerPage)
            ->setFirstResult(($page-1)* $maxPerPage);

        return $qb->getQuery()->getResult();
    }

    public function getTotalNumberOfBooks(){
        $qb = $this->createQueryBuilder('b')
            ->select("COUNT(b)");
        return $qb->getQuery()->getSingleScalarResult();
    }

    public function findByAuthorPaginated($authorName,$maxPerPage, $page=1){
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->join('b.author', 'a')
            ->andWhere('a.name=:authorName')
            ->setMaxResults($maxPerPage)
            ->setFirstResult(($page-1)* $maxPerPage)
            ->setParameter('authorName', $authorName);

        return $qb->getQuery()->getResult();
    }

    public function getTotalNumberOfBooksByAuthor($authorName){
        $qb = $this->createQueryBuilder('b')
            ->select("COUNT(b)")
            ->join('b.author', 'a')
            ->andWhere('a.name=:authorName')
            ->setParameter('authorName', $authorName);

        return $qb->getQuery()->getSingleScalarResult();
    }

}
