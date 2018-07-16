<?php declare(strict_types=1);

namespace App\Controller;

use App\Facade\MessageFacade;
use App\Form\Feedback\FeedbackForm;
use App\Form\Feedback\FeedbackFormData;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends AbstractController
{
    /**
     * @Route("feedback", methods={"GET", "POST"}, name="app.feedback")
     */
    public function index(Request $request, MessageFacade $messageFacade): Response
    {
        $formData = new FeedbackFormData();
        $form = $this->createForm(FeedbackForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $messageFacade->createFeedback($formData);

            $this->addFlashSuccess('Vaše připomínky jsme si uložili. Děkujeme!');

            return $this->redirectToRoute('app.feedback');
        }

        return $this->render(
            'app/feedback/index.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
