<?php

namespace App\Controller;

use App\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PFE;
use App\Entity\Entreprise;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\FormType;


class ExamenController extends AbstractController
{
    #[Route('/pfe', name: 'app_add_pfe')]
    public function pfeAdd(ManagerRegistry  $doc,Request $request): Response
    {


        $pfe = new PFE ();
        $form = $this->createForm(FormType::class,$pfe);

        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $manager=$doc->getManager();
            $manager->persist($pfe);
            $manager->flush();
            $this->addFlash("success","pfe aded succefully");
            return $this->render('examen/Detail.html.twig', [
                'pfe'=>$pfe
            ]);
        }

        return $this->render('examen/Form.html.twig', [
            'form'=>$form->createView()
        ]);

    }
    #[Route('/all', name: 'app_all')]
public function all(ManagerRegistry  $doc,Request $request): Response
{


    $entityManager=$doc->getRepository(Entreprise::class);
    $entreprises = $entityManager->findAll();

    $tab = ["card text-white bg-primary mb-3","card text-white bg-secondary mb-3","card text-white bg-success mb-3",
        "card text-white bg-danger mb-3", "card text-dark bg-warning mb-3" ,
        "card text-dark bg-info mb-3","card text-dark bg-light mb-3","card text-white bg-dark mb-3"];
    return $this->render('examen/all.html.twig', [
        'entreprises'=>$entreprises,"class"=>$tab
    ]);

}


}
