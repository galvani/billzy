<?php

namespace App\DataFixtures;

use App\Config\UserRoleEnum;
use App\Document\Contact;
use App\Document\User;
#use App\Models\UserRole; // @TODO Implement
use Doctrine\Bundle\MongoDBBundle\Fixture\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const ADMIN_USER_REFERENCE = 'admin-user';

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager)
    {
        $contact = new Contact();
        $contact
            ->setName('Jan Kozák')
            ->setCity('Praha 1')
            ->setCountry('CZ') //Countries::getCountryCodes());
            ->setCity('Praha 1')
            ->setEmail('galvani78@gmail.com');


        $admin = new User();
        $admin
            ->setEmail('galvani78@gmail.com')
            ->setRoles([UserRoleEnum::ROLE_SUPER_ADMIN])
            ->setPassword($this->passwordHasher->hashPassword($admin, 'changeMe'))
            ->setContact($contact);
        ;

        $manager->persist($admin);
        $manager->flush();
        $this->addReference(self::ADMIN_USER_REFERENCE, $admin);
    }
}
