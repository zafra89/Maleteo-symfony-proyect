<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response; //Para usar los Response
use Symfony\Component\Routing\Annotation\Route; //Para usar las annotation @Route
use App\Entity\Demo;
use App\Entity\Opiniones;
use Doctrine\ORM\EntityManagerInterface; // Para usar los repositorios de las BBDD
use Symfony\Component\HttpFoundation\Request;

class maleteoController extends AbstractController {

  /**
   * @Route("/maleteo", name="maleteo-home");
   */
  public function home(Opiniones $opiniones) {
    return $this->render("maleteo.html.twig", ['opiniones' => $opiniones]);
  }
  /**
   * @Route("/demo", name="newDemo");
   */
  public function insertDemo(Request $request, EntityManagerInterface $doctrine) {
    $demo = new Demo();
    $demo->setNombre($request->get("nombre"));
    $demo->setEmail($request->get("email"));
    $demo->setCiudad($request->get("ciudad"));

    $doctrine->persist($demo);
    $doctrine->flush();

    return $this->render("maleteo.html.twig");
  }

  public function showDemos() {

  }
  /**
   * @Route("/opinion", name="newOpinion");
   */
  public function insertOpinion(EntityManagerInterface $doctrine) {
    $opinion1 = new Opiniones();
    $opinion1->setComentario("Muy contento con el servicio. Repetiré.");
    $opinion1->setAutor("Alicia");
    $opinion1->setCiudad("Lugo");
    $doctrine->persist($opinion1);

    $opinion2 = new Opiniones();
    $opinion2->setComentario("Deja mucho que desear la forma en la que gestionan todo.");
    $opinion2->setAutor("Mario");
    $opinion2->setCiudad("Valencia");
    $doctrine->persist($opinion2);

    $opinion3 = new Opiniones();
    $opinion3->setComentario("Muy recomendable para ganar un extra.");
    $opinion3->setAutor("Marina");
    $opinion3->setCiudad("Huelva");
    $doctrine->persist($opinion3);

    $doctrine->flush();
  }
}