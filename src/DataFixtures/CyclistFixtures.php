<?php

namespace App\DataFixtures;

use App\Entity\Cyclist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CyclistFixtures extends Fixture
{
    const CYCLISTS = [
        [
            'Juju', 'ju@mail.com', 'password', 'France', 'Chazay d\'Azergues', '1995-02-23',
            'https://scontent-cdt1-1.xx.fbcdn.net/v/t1.6435-9/87282260_10220221680281872_512251867401551872_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=Bk6hismqBWQAX_Jlk-I&_nc_ht=scontent-cdt1-1.xx&oh=00_AT8sojiG7HOan7yZnBb7QnsWva-SLGk69ZzSJ0uMxIqNOA&oe=62FCAB37'
        ],
        [
            'Val', 'val@mail.com', 'password', 'Belgique', 'Tournai', '1990-06-22',
            'https://scontent-cdt1-1.xx.fbcdn.net/v/t1.6435-9/87282260_10220221680281872_512251867401551872_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=Bk6hismqBWQAX_Jlk-I&_nc_ht=scontent-cdt1-1.xx&oh=00_AT8sojiG7HOan7yZnBb7QnsWva-SLGk69ZzSJ0uMxIqNOA&oe=62FCAB37'
        ],
        [
            'Francesco', 'francesco@mail.com', 'password', 'Italie', 'Venise', '1986-11-28',
            'https://scontent-cdt1-1.xx.fbcdn.net/v/t1.6435-9/87282260_10220221680281872_512251867401551872_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=Bk6hismqBWQAX_Jlk-I&_nc_ht=scontent-cdt1-1.xx&oh=00_AT8sojiG7HOan7yZnBb7QnsWva-SLGk69ZzSJ0uMxIqNOA&oe=62FCAB37'
        ]
    ];

    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::CYCLISTS as $cyclistItem) {
            $cyclist = new Cyclist();
            $cyclist->setUsername($cyclistItem[0]);
            $cyclist->setEmail($cyclistItem[1]);
            $cyclist->setRoles(['ROLE_CONTRIBUTOR']);
            $hashedPassword = $this->passwordHasher->hashPassword(
                $cyclist,
                $cyclistItem[2]
            );
            $cyclist->setPassword($hashedPassword);
            $cyclist->setCountry($cyclistItem[3]);
            $cyclist->setCity($cyclistItem[4]);
            $birthdate = new \DateTime($cyclistItem[5]);
            $cyclist->setBirthdate($birthdate);
            $cyclist->setPicture($cyclistItem[6]);
            $manager->persist($cyclist);
            $this->addReference('cyclist_' . $cyclistItem[0], $cyclist);
        }

        $manager->flush();
    }
}
