<?php

namespace App\DataFixtures;

use App\Document\Client;
use App\Document\Contact;
use App\Document\Factory\ClientContactFactory;
use App\Document\Factory\DocumentConverter;
use Doctrine\Bundle\MongoDBBundle\Fixture\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    use DocumentConverter;

    public function getDependencies(): array
    {
        return [UserFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        $contact = new Contact();
        $contact
            ->setName('Jan Kozák')
            ->setCity('Praha 1')
            ->setCountry('CZ') //Countries::getCountryCodes());
            ->setCity('Praha 1')
            ->setEmail('galvani78@gmail.com');

        $manager->persist($contact);

        $clientContact = ClientContactFactory::createFromContact($contact);

        $client = new Client();
        $client
            ->setCompany('Galvani Innovations')
            ->addContact($clientContact)
            ->setTaxId('CZ7802070012')
            ->setUnitPrice(800);

        $manager->persist($client);
        $manager->flush();
    }
}
