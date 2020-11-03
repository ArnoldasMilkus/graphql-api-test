<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ApiResource()
 * @ApiFilter(SearchFilter::class, properties={"name": "partial"})
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var \DateTimeImmutable|null
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $expirationDate;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=false, options={"default": 0})
     */
    private $quantity;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dimension;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return Product
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return Product
     */
    public function setName(?string $name): Product
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getExpirationDate(): ?\DateTimeImmutable
    {
        return $this->expirationDate;
    }

    /**
     * @param \DateTimeImmutable|null $expirationDate
     *
     * @return Product
     */
    public function setExpirationDate(?\DateTimeImmutable $expirationDate): Product
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     *
     * @return Product
     */
    public function setQuantity(float $quantity): Product
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDimension(): ?string
    {
        return $this->dimension;
    }

    /**
     * @param string|null $dimension
     *
     * @return Product
     */
    public function setDimension(?string $dimension): Product
    {
        $this->dimension = $dimension;

        return $this;
    }
}
