<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Entity\Personne;
use App\Form\VoitureType;
use App\Form\PersonneType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request ;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
        ]);

    }
//----------------------------------
    #[Route('/affiche/personnes', name: 'app_personne')]
    public function personne(ManagerRegistry $doc): Response
    {
        $repository= $doc->getRepository(Personne::class);
        $personnes = $repository->findAll();

        return $this->render('first/AfficherP.html.twig', [
            'personnes'=>$personnes
        ]);
    }
//-------------------------
    #[Route('/affiche/voitures', name: 'app_voiture')]
    public function voiture(ManagerRegistry $doc): Response
    {
        $repository= $doc->getRepository(Voiture::class);
        $voitures = $repository->findAll();

        return $this->render('first/AfficherV.html.twig', [
            'voitures'=>$voitures
        ]);
    }
    //------------------
    #[Route('/affiche/voiture/{id<\d+>}', name: 'app_voiture_d')]
public function voitureD(ManagerRegistry $doc,Voiture $v=null): Response
    {

        if ($v) {

            return $this->render("first/DetailV.html.twig", ['voiture' => $v]);

        } else {
            return $this->redirectToRoute('app_voiture');
        }
    }

    //-----------------------
    #[Route('/affiche/personne/{id}', name: 'app_personne_d')]
public function personneD(ManagerRegistry $doc,Personne $p=null): Response
{

    if ($p) {
        return $this->render( "first/DetailP.html.twig", ['personne'=> $p]);
    }
    else {
        return $this->redirectToRoute('app_personne');
    }
}
//-----------------------------------
    #[Route('/add/voiture', name: 'app_voiture_add')]
    public function voitureAdd(ManagerRegistry  $doc,Request $request): Response
    {


        $v = new Voiture();
        $form = $this->createForm(VoitureType::class,$v);

        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $manager=$doc->getManager();
            $manager->persist($v);
            $manager->flush();
            $this->addFlash("success","aded succefully");
            return $this->redirectToRoute("app_voiture");

        }

        return $this->render('first/Form.html.twig', [
            'form'=>$form->createView(),"voiture"=>$v
        ]);
    }
    //--------------------------------------

    #[Route('/add/personne' , name: 'app_personne_add')]
    public function personAdd(ManagerRegistry  $doc,Request $request): Response
    {


        $p = new Personne ();
        $form = $this->createForm(PersonneType::class,$p);

        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $manager=$doc->getManager();
            $manager->persist($p);
            $manager->flush();
            $this->addFlash("success","Person aded succefully");
            return $this->redirectToRoute("app_personne");

        }

        return $this->render('first/Form.html.twig', [
            'form'=>$form->createView(),"personne"=>$p
        ]);
    }

    #[Route('/exercice', name: 'app_first')]
    public function exercice(): Response
    {
        return $this->render('first/js.html.twig');

    }

    #[Route('/delete2/{id<\d+>}', name: 'personne.delete2')]
    public function deleteById(ManagerRegistry $doc , Personne $personne =null ): Response
    {
        if($personne)
        { $manager=$doc->getManager();
            foreach ($personne->getVoitures() as $voiture )
                {
                    $voiture->setOwner(null);
                }
            $manager->remove($personne);
            $manager->flush();
            $this->addFlash("sucess","deleted succefully");

        }
        else {            $this->addFlash("error","Id not found");        }
        return $this->redirectToRoute('app_personne') ;

    }
}
