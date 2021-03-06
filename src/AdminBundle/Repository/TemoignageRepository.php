<?php

namespace AdminBundle\Repository;

/**
 * TemoignageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TemoignageRepository extends \Doctrine\ORM\EntityRepository
{
	//recupérer tout les témoignages et les classée par ordre décroissant
	public function findAllTemoignage()
	{
	  $qb = $this->createQueryBuilder('t');
	  $qb->orderBy('t.id', 'DESC');

	  return $qb
		->getQuery()
		->getResult()
	  ;
	}
	
	//Récupérer la liste des témoignages des bénévoles
   public function findListeTemoignageBenevole()
   {
		$qb = $this->createQueryBuilder('t');
		$qb->where('t.categorie = :categorie')
			->setParameter('categorie', 'Bénévoles');
			return $qb->getQuery()
					  ->getResult();
   }
   
   //Récupérer la liste des témoignages des membres du bureau
   public function findListeTemoignageMembre()
   {
		$qb = $this->createQueryBuilder('t');
		$qb->where('t.categorie = :categorie')
			->setParameter('categorie', 'Membres');
			return $qb->getQuery()
					  ->getResult();
   }
   
    //Récupérer la liste des témoignages des parténaires
   public function findListeTemoignagePartenaire()
   {
		$qb = $this->createQueryBuilder('t');
		$qb->where('t.categorie = :categorie')
			->setParameter('categorie', 'Partenaires');
			return $qb->getQuery()
					  ->getResult();
   }
}
