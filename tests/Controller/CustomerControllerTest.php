<?php


namespace App\Tests\Controller;


use App\Repository\CustomerRepository;
use App\Repository\UserRepository;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomerControllerTest extends WebTestCase
{
    public function testCustomer() {
        $client = static::createClient();

        $user = static::$container->get(UserRepository::class)->findOneByEmail('thibault@fidcar.com');

        $client->loginUser($user);

        $crawler = $client->request('GET', '/customer');

        $this->assertResponseIsSuccessful();
        $this->assertGreaterThan(0, $crawler->filter('table > tbody > tr')->count());
    }

    public function testAddCustomer() {
        $client = static::createClient();

        $counts = [
            'start' => 0,
            'end' => 0
        ];

        $counts['start'] = static::$container->get(CustomerRepository::class)->count([]);

        $user = static::$container->get(UserRepository::class)->findOneByEmail('thibault@fidcar.com');

        $client->loginUser($user);

        $crawler = $client->request('GET', '/customer/add');
        
        $submit = $crawler->selectButton('Save');
        $form = $submit->form();

        $faker = Factory::create('fr_FR');

        $client->submit($form, [
            'customer' => [
                'label' => $faker->company
            ]
        ]);

        $client->followRedirects();

        $counts['end'] = static::$container->get(CustomerRepository::class)->count([]);

        $this->assertGreaterThan($counts['start'], $counts['end']);
    }
}