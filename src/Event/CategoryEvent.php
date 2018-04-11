<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\UserInterface;
use App\Entity\WordCategoryInterface;

class CategoryEvent extends AbstractEvent
{
    /** @var WordCategoryInterface */
    private $category;

    public function __construct(UserInterface $user, WordCategoryInterface $category)
    {
        parent::__construct($user);
        $this->category = $category;
    }

    public function getCategory(): WordCategoryInterface
    {
        return $this->category;
    }
}
