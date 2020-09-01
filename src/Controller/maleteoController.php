<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response; //Para usar los Response
use Symfony\Component\Routing\Annotation\Route; //Para usar las annotation @Route
use App\Entity\Demo;
use Doctrine\ORM\EntityManagerInterface; // Para usar los repositorios de las BBDD
//use App\Entity\nombre_entidad; ---------> Para usar entidades
use Symfony\Component\HttpFoundation\Request;

class maleteoController extends AbstractController {

  /**
   * @Route("");
   */
  public function login() {
    return $this->render("login.html.twig");
  }

  /**
   * @Route("/home");
   */
  public function home() {
    return $this->render("maleteo.html.twig", ['year' => date("Y")]);
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

    return new Response("Has solicitado una demo");
  }

  public function opinionsManage() {

  }
}
