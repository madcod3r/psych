<?php

namespace App\Controller;

use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonController extends AbstractController
{
    /**
     * @Route("/person", name="person")
     */
    public function index()
    {
        return $this->render('person/index.html.twig');
    }

    /**
     * @Route("/person/{id}", name="people_show")
     */
    public function show($id)
    {
        $product = $this->getDoctrine()
            ->getRepository(Person::class)
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No people found for id '.$id
            );
        }

        return new Response('Check out this great product: '.$product->getName());

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
}
