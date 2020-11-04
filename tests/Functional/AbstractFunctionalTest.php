<?php

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractFunctionalTest extends ApiTestCase
{
    /**
     * @var Client|null
     */
    protected $client;

    /**
     * @var ORMPurger
     */
    protected $ormPurger;

    protected function setUp(): void
    {
        parent::setUp();
        $this->loadFixtures();
        $this->setupClient();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // cleans test properties to free up memory
        $refl = new \ReflectionObject($this);
        foreach ($refl->getProperties() as $prop) {
            if (!$prop->isStatic() && 0 !== strpos($prop->getDeclaringClass()->getName(), 'PHPUnit_')) {
                $prop->setAccessible(true);
                $prop->setValue($this, null);
            }
        }
    }

    protected function getSetUppedClient(): Client
    {
        if (empty($this->client) || empty($this->client->getContainer())) {
            $this->setupClient();
        }

        return $this->client;
    }

    protected function setupClient(): void
    {
        $this->client = static::createClient();
    }

    protected function getContainer(): ContainerInterface
    {
        return $this->getSetUppedClient()->getContainer();
    }

    protected function getEntityManager(): EntityManager
    {
        return $this->getContainer()->get('doctrine.orm.default_entity_manager');
    }

    protected function loadFixtures(): void
    {
        // get Alice fixture loader
        $loader = $this->getContainer()->get('fidry_alice_data_fixtures.loader.doctrine');
        // load the fixture needed and only this one
        $loader->load(['tests/fixtures/products.yaml']);
    }
}
