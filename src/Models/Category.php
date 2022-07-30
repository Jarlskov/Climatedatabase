<?php

declare(strict_types=1);

namespace Jarlskov\Climatedatabase\Models;

class Category
{
    public function __construct(private string $name, private string $danishName)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDanishName(): string
    {
        return $this->danishName;
    }
}
