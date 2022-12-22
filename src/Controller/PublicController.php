<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PublicController extends AbstractController
{

    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/', name: 'public')]
    public function public(): Response
    {

        return $this->render('public/index.html.twig', [
        ]);
    }

    #[Route('/formulaire', name: 'formulaire')]
    public function formulaire(Request $request): Response
    {

        //Variables
        $linkBackForm = $this->generateUrl('public', array(), true );

        //On va créer le formulaire pour les categories
        $avis = new Avis();

        $form = $this->createForm(AvisType::class, $avis, ['linkback' => $linkBackForm]);

        $message = "Votre avis a été enregistrée !";
        
        $form->handleRequest($request);

        //Si le formulaire Adress est envoyer et valide
        if ($form->isSubmitted() && $form->isValid()) {

            // //On recuperer les données
            // $avisData = $form->get('avis')->getData();

            // //On recuperer l'image
            // $img = $avisData->getImage();

            // //Si le l'image' existe
            // if ($img) {

            //     //On recupere le nom de l'image
            //     $originalFilename = pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME);
            //     $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);

            //     //On créer un nouveau nom de l'image
            //     $newFilename = $safeFilename . '-' . uniqid() . '.' . $img->guessExtension();

            //     //On deplace le fichier
            //     $img->move(
            //         $this->getParameter('Img'),
            //         $newFilename
            //     );

            //     //On sauvegarde le nouveau nom de l'image
            //     $avisData->setPicture($newFilename);
            // }

            //On écrit dans la BDD et on sauvegarder
            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($avis);
            $entityManager->flush();

            $this->addFlash('success', $message);

            return $this->redirectToRoute('public');
        }

        return $this->render('public/formulaire.html.twig', [
            'form'      => $form->createView()
        ]);
    }

    #[Route('/mentions-legales', name: 'ml')]
    public function ml(Request $request):Response {

        return $this->render('public/ml.html.twig', [
        ]);
    }
}
