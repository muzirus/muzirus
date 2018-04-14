<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Able\Timestampable;

interface MessageInterface extends Timestampable
{
    public function getId(): string;

    public function getEmail(): string;

    public function getContent(): string;
}
