<?php declare(strict_types=1);

namespace App\Entity\LogEntry;

use App\Entity\Category;
use App\Entity\User;

class CategoryCreated extends AbstractLogEntry
{
    public function __construct(User $user, Category $category)
    {
        parent::__construct($user);

        $this->category = $category;
    }

    //-------------------------------------------------------------------------

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function toString(): string
    {
        return 'Category has been created';
    }
}
