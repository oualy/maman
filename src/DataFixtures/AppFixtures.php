<?php

namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\User;
use App\Entity\Admin;
use App\Entity\Roles;
use App\Entity\Electeur;
use App\Entity\Candidats;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
   private $passwordEncoder;

  public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
      $this->passwordEncoder = $passwordEncoder;
   }


  public function load(ObjectManager $manager)
  {
     

    $faker = Factory::create(locale:'fr_FR');

    $candidat = [];

    for ($i = 0; $i < 7; $i++) {
      $candidat = new Candidats;
      $candidat 
      ->setPrenomCandidat($faker->FirstName())
      ->setNomCandidat($faker->Name())
      ->setNomParti($faker->Text())
      ->setClasse($faker->Name())
      ->setPhoto($faker->imageUrl());

      $manager->persist($candidat);

    }
    $manager->flush();  


     $admin = new Admin();
      $admin->setNomAdmin('oualy');
      $admin->setPrenomAdmin('ansou');
      $admin->setCode(2536);
      $manager->persist($admin);
    $manager->flush();

   
   

    for ($j=0; $j < 30; $j++) { 

      $electeur = new Electeur();
      
      $electeur->setNomElecteur($faker->Name())
               ->setPrenomElecteur($faker->FirstName())
               ->setCode(6587)
               ->setClasse($faker->CompanySuffix());
               
               $manager->persist($electeur);
    }
                 
        $manager->flush();     
               
    
   
        
    $role = new Roles();
    $role->setNomrole( "Admin");
    $manager->persist($role);

    $role1 = new Roles();
    $role1->setNomrole( "Candidat");
    $manager->persist($role1);

    $role2 = new Roles();
    $role2->setNomrole( "electeur");
    $manager->persist($role2);


    $manager->flush();



/*
 
     $user = new User();

     $user->setUsername("SupAdmin")
   
   ->setRoles(["ROLE_".$role->getNomrole()])
   ->setPassword($this->passwordEncoder->encodePassword($user,'super'))
   ->setIsActive(true)
   ->setElecteur(NULL)
   ->setCandidats(NULL)
   ->setAdmins($admin)
   ->SetRole($role);
    $manager->persist($user);


    $manager->flush();

 */


  }
 


 

  
}
