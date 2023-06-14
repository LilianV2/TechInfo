<?php

namespace App\Model\Entity;

class ArticlePc
{
    private int $id;
    private string $name;
    private float $price;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ArticlePc
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ArticlePc
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param int $price
     * @return ArticlePc
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

}