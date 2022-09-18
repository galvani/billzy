<?php

namespace App\DataFixtures;

use App\Document\Client;
use App\Document\Embedded\InvoiceItem;
use App\Document\Invoice;
use App\Document\Payment;
use Doctrine\Bundle\MongoDBBundle\Fixture\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InvoiceFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct()
    {
    }

    public function load(ObjectManager $manager)
    {
        $client = $manager->getRepository(Client::class)->findOneBy(
            ['taxId'=>'CZ7802070012']
        );

        $ownerId = (string) $this->getReference(UserFixtures::ADMIN_USER_REFERENCE)->getId();

        $invoice = new Invoice();
        $invoice
            ->setIssuedDate(new \DateTime)
            ->setDueDate(new \DateTime('+14 days'))
            ->setTotal(rand(10000,100000))
            ->setCurrency('CZK')
            ->setNumber('2020-001')
            ->setClient($client)
            ->setOwnerId($ownerId)
            ->setUpdatedAt(new \DateTime())
            ;
        $invoice->setItems($this->factorItems($invoice));

        $manager->persist($invoice);
        $manager->flush();

        $invoice = new Invoice();
        $invoice
            ->setIssuedDate(new \DateTime('-1 month'))
            ->setDueDate(new \DateTime('-14 days'))
            ->setTotal(rand(10000,100000))
            ->setCurrency('CZK')
            ->setNumber('2020-002')
            ->setClient($client)
            ->setOwnerId($ownerId)
            ->setUpdatedAt(new \DateTime('+5 seconds'))
        ;


        $payment = new Payment();
        $payment
            ->setReceiptDate(new \DateTime('-15 day'))
            ->setCurrency($invoice->getCurrency())
            ->setAmount(rand(50000,11000))
            ;

        $invoice->addPayment($payment);

        $manager->persist($invoice);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AppFixtures::class
        ];
    }

    private function factorItems(Invoice $invoice, $limit = 20) {
        $items = [];
        $limit = ceil(rand(0,$limit));
        $faker = Factory::create();

        for ($i=0; $i<$limit; $i++) {

            $item = new InvoiceItem();
            $item->setName(join(' ',$faker->words(rand(3,6))));

            $dt = $faker->dateTimeBetween(
                $invoice->getIssuedDate()->format('Y-m-d').' -30 days',
                $invoice->getIssuedDate()->format('Y-m-d')
            );

            $item->setItemDate($dt);
            $item->setAmount($faker->numberBetween(1,12));
            $item->setUnit('hr');
            $item->setUnitPrice(850);
            $item->setTotal($item->getAmount()*$item->getUnitPrice());

            $items[] = $item;
        }
        return $items;
    }


}
