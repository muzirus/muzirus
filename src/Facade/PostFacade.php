<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\Post;
use App\Entity\PostInterface;
use App\Entity\PostRevision;
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

        $post = new Post($slugify->slugify($formData->getSlug()), $formData->getTitle(), $author);
        $postRevision = new PostRevision($post, $formData->getContent());

        $this->entityManager->persist($post);
        $this->entityManager->persist($postRevision);
        $this->entityManager->flush();

        return $post;
    }

    public function update(PostInterface $post, PostFormData $formData): void
    {
        $post->setTitle($formData->getTitle());

        $postRevision = new PostRevision($post, $formData->getContent());

        $this->entityManager->persist($postRevision);
        $this->entityManager->flush();
    }
}
