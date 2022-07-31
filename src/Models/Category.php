<?php

declare(strict_types=1);

namespace Jarlskov\Climatedatabase\Models;

class Category
{
    /**
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        private string $name,
        private string $danishName,
        private string $gpcCategory,
        private string $danishGpcCategory,
        private int $gpcBrickLevel1,
        private string $gpcBrickLevel1Name,
        private int $gpcBrickLevel2,
        private string $gpcBrickLevel2Name,
        private int $gpcBrickLevel3,
        private string $gpcBrickLevel3Name
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDanishName(): string
    {
        return $this->danishName;
    }

    public function getGpcCategory(): string
    {
        return $this->gpcCategory;
    }

    public function getDanishGpcCategory(): string
    {
        return $this->danishGpcCategory;
    }

    public function getGpcBrickLevel1(): int
    {
        return $this->gpcBrickLevel1;
    }

    public function getGpcBrickLevel1Name(): string
    {
        return $this->gpcBrickLevel1Name;
    }

    public function getGpcBrickLevel2(): int
    {
        return $this->gpcBrickLevel2;
    }

    public function getGpcBrickLevel2Name(): string
    {
        return $this->gpcBrickLevel2Name;
    }

    public function getGpcBrickLevel3(): int
    {
        return $this->gpcBrickLevel3;
    }

    public function getGpcBrickLevel3Name(): string
    {
        return $this->gpcBrickLevel3Name;
    }
}
