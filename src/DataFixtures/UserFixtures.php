<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private UserPasswordEncoderInterface $userPasswordEncoder;

    public function __construct(
        UserPasswordEncoderInterface $userPasswordEncoder
    ) {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setEmail('thibault@fidcar.com');
        $user->setFirstname('Thibault');
        $user->setLastname('Henry');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword(
            $this->userPasswordEncoder->encodePassword($user, 'VerySecretPassword'),
        );

        $manager->persist($user);

        $manager->flush();
    }
}
