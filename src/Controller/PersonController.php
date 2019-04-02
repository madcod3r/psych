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
     * @Route(
     *     "/person/{id}",
     *     name="person_show",
     *     requirements={"id"="\d+"}
     *     )
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

    /**
     * @Route("/person/add", name="person_add")
     */
    public function add()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $person = new Person;

        $person->setFirstName('Oleg');
        $person->setLastName('Voloshyn');
        $person->setBirthDay(new \DateTime('now'));

        $entityManager->persist($person);
        $entityManager->flush();


        $this->addFlash(
            'success',
            'Added new person "' . $person->getName() . '"!'
        );

        return $this->redirectToRoute('person', [
            'id' => $person->getId()
        ]);
    }

    /**
     * @Route("/person/edit/{id}", name="person_edit", requirements={"id"="\d+"})
     */
    public function update($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $person = $entityManager->getRepository(Person::class)->find($id);

        if (!$person) {
            throw $this->createNotFoundException(
                'No person found for id ' . $id
            );
        }

        $person->setFirstName('Oleg');
        $entityManager->flush();

        $this->addFlash(
            'success',
            'Changed person "' . $person->getName() . '"!'
        );

        return $this->redirectToRoute('person', [
            'id' => $person->getId()
        ]);
    }

    /**
     * @Route("/person/delete/{id}", name="person_delete", requirements={"id"="\d+"})
     */
    public function delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $person = $entityManager->getRepository(Person::class)->find($id);

        if (!$person) {
            throw $this->createNotFoundException(
                'No person found for id '.$id
            );
        }

        $entityManager->remove($person);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Removed person "' . $person->getName() . '"!'
        );

        return $this->redirectToRoute('person');
    }
}
