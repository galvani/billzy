<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Document\EmbeddedDocument\UserProfile;
use App\Document\User;
use Doctrine\Bundle\MongoDBBundle\Fixture\Fixture;
use Doctrine\Bundle\MongoDBBundle\Fixture\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture implements FixtureGroupInterface
{
    public const ADMIN_USER_REFERENCE = 'user-galvani';

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public static function getGroups(): array
    {
        return [];
    }

    public function load(ObjectManager $manager): void
    {
        $profile = (new UserProfile())
            ->setEmail('galvani78@gmail.com');

        $user = (new User())
            ->setProfile($profile)
            ->setUsername('galvani78@gmail.com');

        $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::ADMIN_USER_REFERENCE, $user);
    }
}
