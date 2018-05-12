<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\PostInterface;
use App\Form\Post\PostFormDataInterface;

interface PostFacadeInterface
{
    public function createPost(PostFormDataInterface $formData): PostInterface;

    public function updatePost(PostInterface $post, PostFormDataInterface $formData): void;
}
