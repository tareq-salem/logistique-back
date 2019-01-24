<?php

namespace App\Controller\Admin;

use App\Entity\ContractType;
use App\Form\ContractTypeType;
use App\Repository\ContractTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/contract-type")
 */
class ContractTypeController extends AbstractController
{
    /**
     * @Route("/", name="contract_type_index", methods={"GET"})
     */
    public function index(ContractTypeRepository $contractTypeRepository): Response
    {
        return $this->render('admin/contract_type/index.html.twig', [
            'contract_types' => $contractTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="contract_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contractType = new ContractType();
        $form = $this->createForm(ContractTypeType::class, $contractType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contractType);
            $entityManager->flush();

            return $this->redirectToRoute('contract_type_index');
        }

        return $this->render('admin/contract_type/new.html.twig', [
            'contract_type' => $contractType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contract_type_show", methods={"GET"})
     */
    public function show(ContractType $contractType): Response
    {
        return $this->render('admin/contract_type/show.html.twig', [
            'contract_type' => $contractType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contract_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ContractType $contractType): Response
    {
        $form = $this->createForm(ContractTypeType::class, $contractType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contract_type_index', [
                'id' => $contractType->getId(),
            ]);
        }

        return $this->render('admin/contract_type/edit.html.twig', [
            'contract_type' => $contractType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contract_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ContractType $contractType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contractType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contractType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contract_type_index');
    }
}
