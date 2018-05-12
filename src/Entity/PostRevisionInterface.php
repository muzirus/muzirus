<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Able\TimestampableInterface;

interface PostRevisionInterface extends TimestampableInterface
{
    public function getId(): string;

    public function getContent(): string;

    public function getContentInRussian(): string;
}
