<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\Post;
use App\Facade\PostFacade;
use App\Form\Post\PostForm;
use App\Form\Post\PostFormData;
use App\Repository\PostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/post")
 */
class PostController extends AbstractController
{
    /**
     * @Route("", name="admin.post")
     * @Method("GET")
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
     * @Route("/add", name="admin.post.add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request, PostFacade $postFacade): Response
    {
        $formData = new PostFormData();

        $form = $this->createForm(PostForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $postFacade->create($formData);

            $this->addFlashSuccess('admin.post.created');

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
     * @Route("/{id}/edit", name="admin.post.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, Post $post, PostFacade $postFacade): Response
    {
        $formData = PostFormData::fromPost($post);

        $form = $this->createForm(PostForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postFacade->update($post, $formData);

            $this->addFlashSuccess('admin.post.updated');

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
     * @Route("/{id}/remove", name="admin.post.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(Post $post, PostFacade $postFacade): RedirectResponse
    {
        $postFacade->delete($post);

        $this->addFlashSuccess('admin.post.deleted');

        return $this->redirectToRoute('admin.post');
    }
}
