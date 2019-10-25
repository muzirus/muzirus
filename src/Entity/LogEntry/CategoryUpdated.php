<?php declare(strict_types=1);

namespace App\Entity\LogEntry;

use App\Entity\Category;
use App\Entity\User;

class CategoryUpdated extends CategoryCreated
{
    public function toString(): string
    {
        return 'Category has been updated';
    }
}
