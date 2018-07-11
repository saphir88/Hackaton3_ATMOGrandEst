<?php

namespace App\Controller;

use App\Entity\Info;
use App\Form\InfoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/info")
 */
class InfoController extends Controller
{
    /**
     * @Route("/", name="info_index", methods="GET")
     */
    public function index(): Response
    {
        $infos = $this->getDoctrine()
            ->getRepository(Info::class)
            ->findAll();

        return $this->render('info/index.html.twig', ['infos' => $infos]);
    }

    /**
     * @Route("/new", name="info_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $info = new Info();
        $form = $this->createForm(InfoType::class, $info);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($info);
            $em->flush();

            return $this->redirectToRoute('info_index');
        }

        return $this->render('info/new.html.twig', [
            'info' => $info,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="info_show", methods="GET")
     */
    public function show(Info $info): Response
    {
        return $this->render('info/show.html.twig', ['info' => $info]);
    }

    /**
     * @Route("/{id}/edit", name="info_edit", methods="GET|POST")
     */
    public function edit(Request $request, Info $info): Response
    {
        $form = $this->createForm(InfoType::class, $info);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('info_edit', ['id' => $info->getId()]);
        }

        return $this->render('info/edit.html.twig', [
            'info' => $info,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="info_delete", methods="DELETE")
     */
    public function delete(Request $request, Info $info): Response
    {
        if ($this->isCsrfTokenValid('delete'.$info->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($info);
            $em->flush();
        }

        return $this->redirectToRoute('info_index');
    }
}
