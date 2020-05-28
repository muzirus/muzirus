<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\Post;
use App\Entity\PostInterface;
use App\Entity\PostRevision;
use App\Entity\UserInterface;
use App\Form\Post\PostFormDataInterface;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;

class PostFacade implements PostFacadeInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createPost(PostFormDataInterface $formData, ?UserInterface $author = null): PostInterface
    {
        $slugify = new Slugify();

        $post = new Post(
            $slugify->slugify($formData->getSlug()),
            $formData->getTitle(),
            $formData->getTitleInRussian(),
            $author
        );
        $postRevision = new PostRevision($post, $formData->getContent(), $formData->getContentInRussian());

        $this->entityManager->persist($post);
        $this->entityManager->persist($postRevision);
        $this->entityManager->flush();

        return $post;
    }

    public function updatePost(PostInterface $post, PostFormDataInterface $formData): void
    {
        $post->setTitle($formData->getTitle());
        $post->setTitleInRussian($formData->getTitleInRussian());

        $postRevision = new PostRevision($post, $formData->getContent(), $formData->getContentInRussian());

        $this->entityManager->persist($postRevision);
        $this->entityManager->flush();
    }
}
