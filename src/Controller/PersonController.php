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
        $persons = $this->getDoctrine()
            ->getRepository(Person::class)
            ->findAll();

        return $this->render('person/index.html.twig', [
            'persons' => $persons
        ]);
    }

    /**
     * @Route("/person/{id}", name="person_show")
     */
    public function show($id)
    {
        $person = $this->getDoctrine()
            ->getRepository(Person::class)
            ->find($id);

        if (!$person) {
            throw $this->createNotFoundException(
                'No person found for id '.$id
            );
        }

        return new Response('Check out this person: '.$person->getName());

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
}
