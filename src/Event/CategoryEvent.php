<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\CategoryInterface;
use App\Entity\UserInterface;

class CategoryEvent extends AbstractEvent
{
    /** @var CategoryInterface */
    private $category;

    public function __construct(UserInterface $user, CategoryInterface $category)
    {
        parent::__construct($user);
        $this->category = $category;
    }

    public function getCategory(): CategoryInterface
    {
        return $this->category;
    }
}
