<?php

namespace App\DataFixtures;

use App\Document\Contact;
use App\Document\User;
use App\Models\UserRole;
use Doctrine\Bundle\MongoDBBundle\Fixture\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public const ADMIN_USER_REFERENCE = 'admin-user';

    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
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
            ->setRoles([UserRole::ROLE_SUPER_ADMIN])
            ->setPassword($this->passwordEncoder->encodePassword($admin,'changeMe'))
            ->setContact($contact);
        ;

        $manager->persist($admin);
        $manager->flush();
        $this->addReference(self::ADMIN_USER_REFERENCE, $admin);
    }

    public function getDependencies()
    {
        return [
            AppFixtures::class
        ];
    }


}
