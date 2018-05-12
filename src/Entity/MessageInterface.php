<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Able\TimestampableInterface;

interface MessageInterface extends TimestampableInterface
{
    public function getId(): string;

    public function getEmail(): string;

    public function getContent(): string;
}
