<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/dashboard")
 */
class ReviewController extends AbstractController
{
    /**
     * @Route("/review", name="review")
     */
    public function indexAction(): Response
    {
        return $this->redirectToRoute('dashboard');
    }

    /**
     * @Route("/review/create", name="create_review")
     * @param Request $request
     */
    public function createAction(Request $request)
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $review = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($review);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard');
        }
        return $this->render('admin/review/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/review/{id}", name="remove_review")
     * @param $id
     */
    public function removeReviewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $review = $em->getRepository(Review::class)->find($id);
        $em->remove($review);
        $em->flush();

        return $this->redirectToRoute('dashboard');
    }
}
