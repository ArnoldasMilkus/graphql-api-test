<?php

namespace App\Resolver;

use ApiPlatform\Core\GraphQl\Resolver\QueryCollectionResolverInterface;
use App\Entity\Product;

class ProductCollectionResolver implements QueryCollectionResolverInterface
{
    /**
     * @param iterable<Product> $collection
     *
     * @return iterable<Product>
     */
    public function __invoke(iterable $collection, array $context): iterable
    {
        // Query arguments are in $context['args'].

        foreach ($collection as $product) {
            // Do something with the book.
        }

        return $collection;
    }
}
