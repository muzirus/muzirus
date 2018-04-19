<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Able\Timestampable;

interface PostRevisionInterface extends Timestampable
{
    public function getId(): string;

    public function getContent(): string;
}
