<?php

namespace App\Factory;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<User>
 */
final class UserFactory extends PersistentProxyObjectFactory{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public static function class(): string
    {
        return User::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'email' => self::faker()->unique()->email(),
            'firstname' => self::faker()->firstName(),
            'lastname' => self::faker()->lastName(),
            'password' => $this->hasher->hashPassword(new User(), 'azertyuiop1234'),
            'roles' => [self::faker()->randomElement(['ROLE_AJOUT_DE_LIVRE', 'ROLE_EDITION_DE_LIVRE', 'ROLE_ADMIN'])],
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(User $user): void {})
        ;
    }
}
