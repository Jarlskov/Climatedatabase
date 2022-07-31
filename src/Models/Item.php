<?php

declare(strict_types=1);

namespace Jarlskov\Climatedatabase\Models;

class Item
{
    /**
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        private Category $category,
        private string $name,
        private string $danishName,
        private string $unit,
        private float $co2e,
        private float $agriculture,
        private float $iluc,
        private float $processing,
        private float $packaging,
        private float $transport,
        private float $retail,
        private float $energy,
        private float $fat,
        private float $carbohydrate,
        private float $protein
    ) {
    }

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

    public function getUnit(): string
    {
        return $this->unit;
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

    public function getEnergy(): float
    {
        return $this->energy;
    }

    public function getFat(): float
    {
        return $this->fat;
    }

    public function getCarbohydrate(): float
    {
        return $this->carbohydrate;
    }

    public function getProtein(): float
    {
        return $this->protein;
    }
}
