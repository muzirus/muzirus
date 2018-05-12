<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constant\Flashes;
use App\Controller\AbstractController;
use App\Entity\Post;
use App\Facade\PostFacade;
use App\Form\Post\PostForm;
use App\Form\Post\PostFormData;
use App\Repository\PostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/post")
 */
class PostController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="admin.post")
     */
    public function index(PostRepository $postRepository): Response
    {
        return $this->render(
            'admin/post/index.html.twig',
            [
                'posts' => $postRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/add", methods={"GET", "POST"}, name="admin.post.add")
     */
    public function add(Request $request, PostFacade $postFacade): Response
    {
        $formData = new PostFormData();

        $form = $this->createForm(PostForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $postFacade->createPost($formData);

            $this->addFlashSuccess(Flashes::POST_CREATED);

            return $this->redirectToRoute(
                'admin.post.edit',
                [
                    'id' => $post->getId(),
                ]
            );
        }

        return $this->render(
            'admin/post/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/edit", requirements={"id": "\d+"}, methods={"GET", "POST"}, name="admin.post.edit")
     */
    public function edit(Request $request, Post $post, PostFacade $postFacade): Response
    {
        $formData = PostFormData::fromPost($post);

        $form = $this->createForm(PostForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postFacade->updatePost($post, $formData);

            $this->addFlashSuccess(Flashes::POST_UPDATED);

            return $this->redirectToRoute(
                'admin.post.edit',
                [
                    'id' => $post->getId(),
                ]
            );
        }

        return $this->render(
            'admin/post/edit.html.twig',
            [
                'post' => $post,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", requirements={"id": "\d+"}, methods={"GET"}, name="admin.post.view")
     */
    public function view(Post $post): Response
    {
        return $this->render(
            'admin/post/view.html.twig',
            [
                'post' => $post,
            ]
        );
    }
}
