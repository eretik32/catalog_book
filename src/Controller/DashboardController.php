<?php

namespace App\Controller;

use App\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{

    /**
     * @Route("/dashboard", name="dashboard", methods={"GET"})
     */

    public function indexAction()
    {
        $reviews = $this->getDoctrine()->getRepository(Review::class)->findAll();
        return $this->render('admin/dashboard/index.html.twig', array(
            'reviews' => $reviews,
        ));
    }
}
