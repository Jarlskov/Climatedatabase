<?php

declare(strict_types=1);

namespace Jarlskov\Climatedatabase\Models;

class Item
{
    public function __construct(
        private Category $category,
        private string $name,
        private string $danishName,
        private float $co2e,
        private float $agriculture,
        private float $iluc,
        private float $processing,
        private float $packaging,
        private float $transport,
        private float $retail
    ) { }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDanishName(): string
    {
        return $this->danishName;
    }

    public function getCo2e(): float
    {
        return $this->co2e;
    }

    public function getAgriculture(): float
    {
        return $this->agriculture;
    }

    public function getIlux(): float
    {
        return $this->iluc;
    }

    public function getProcessing(): float
    {
        return $this->processing;
    }

    public function getPackaging(): float
    {
        return $this->packaging;
    }

    public function getTransport(): float
    {
        return $this->transport;
    }

    public function getRetail(): float
    {
        return $this->retail;
    }
}
