<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Demo;
use App\Entity\Opiniones;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class maleteoController extends AbstractController {

  /**
   * @Route("/maleteo", name="maleteo-home");
   */
  public function home(EntityManagerInterface $doctrine) {
    $repo = $doctrine->getRepository(Opiniones::class);
    $opiniones = $repo->findAll();
    return $this->render("maleteo.html.twig", ['opiniones' => $opiniones]);
  }

  /**
   * @Route("/maleteo/solicitudes", name="showDemos");
   */
  public function showDemos(EntityManagerInterface $doctrine) {
    $repo = $doctrine->getRepository(Demo::class);
    $demos = $repo->findAll();
    return $this->render("demos.html.twig", ['demos' => $demos]);
  }

  /**
   * @Route("/maleteo/opiniones", name="showOpiniones");
   */
  public function sendOpiniones(EntityManagerInterface $doctrine) {
    $repo = $doctrine->getRepository(Opiniones::class);
    $opiniones = $repo->findAll();
    return $this->render("opinions.html.twig", ['opiniones' => $opiniones]);
  }

  /**
   * @Route("/opiniones", name="makeOpiniones");
   */
  public function showOpiniones(Request $request, EntityManagerInterface $doctrine) {
    $opinion = new Opiniones();
    $opinion->setComentario($request->get("comentario"));
    $opinion->setAutor($request->get("autor"));
    $opinion->setCiudad($request->get("ciudad"));

    $doctrine->persist($opinion);
    $doctrine->flush();

    return $this->redirectToRoute('showOpiniones');
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

    $repo = $doctrine->getRepository(Opiniones::class);
    $opiniones = $repo->findAll();
    return $this->render("maleteo.html.twig", ['opiniones' => $opiniones]);
  }


  /**
   * @Route("/maleteo/register", name="register");
   */
  public function register() {
    return $this->render('register.html.twig');
  }

}