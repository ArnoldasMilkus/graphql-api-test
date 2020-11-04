<?php

namespace App\Tests\Functional;

class ProductResourceTest extends AbstractFunctionalTest
{
    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/api/products');
        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals('/api/products', $response->toArray()["@id"]);
    }

    public function testGetGraphqlCollection(): void
    {
        $client = self::createClient();

        $response = $client->request('POST', '/api/graphql', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => '{"query":"{ products { edges { node { id, name } } } }","variables":{}}'

        ]);

        $response = json_decode($response->getContent());
        $this->assertResponseStatusCodeSame(200);
        $this->assertGreaterThanOrEqual(1, count($response->data->products->edges));
    }
}
