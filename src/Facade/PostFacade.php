<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\Post;
use App\Entity\PostInterface;
use App\Entity\UserInterface;
use App\Form\Post\PostFormData;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;

class PostFacade
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(PostFormData $formData, ?UserInterface $author = null): PostInterface
    {
        $slugify = new Slugify();

        $post = new Post(
            $slugify->slugify($formData->getTitle()),
            $formData->getTitle(),
            $formData->getContent(),
            $author
        );

        $this->entityManager->persist($post);
        $this->entityManager->flush();

        return $post;
    }

    public function update(PostInterface $post, PostFormData $formData): void
    {
        $post->setTitle($formData->getTitle());
        $post->setContent($formData->getContent());

        $this->entityManager->flush();
    }

    public function delete(PostInterface $post): void
    {
        $this->entityManager->remove($post);
        $this->entityManager->flush();
    }
}
