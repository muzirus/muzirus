<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\Category;
use App\Entity\User;

class CategoryCreatedEvent extends AbstractEvent
{
    /** @var Category */
    private $category;

    public function __construct(User $user, Category $category)
    {
        parent::__construct($user);
        $this->category = $category;
    }

    final public function getCategory(): Category
    {
        return $this->category;
    }
}
