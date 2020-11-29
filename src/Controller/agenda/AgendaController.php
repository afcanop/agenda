<?php


namespace App\Controller\agenda;


use App\Entity\Agenda\Evento;
use App\Form\Agenda\EventoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AgendaController extends AbstractController
{
    /**
     * @Route("/agenda")
     */
    public function index(Request $request, ValidatorInterface $validator): Response
    {
        $em = $this->getDoctrine()->getManager();
        $errors = [];
        $form = $this->createForm(EventoType::class,  new Evento());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('guardar')->isClicked()) {
                $arRegistro = $form->getData();
                $em->persist($arRegistro);
                $em->flush();
            }
        }
        $eventos = $em->getRepository(Evento::class)->lista();

        return $this->render('agenda/index.twig', [
            'form' => $form->createView(),
            'eventos' => $eventos,
            'errors' => $errors,
        ]);
    }

    private function nuevoEvento(array $datos)
    {
        $em = $this->getDoctrine()->getManager();

        if (is_array($datos)) {
            $evento = new Evento();
            $evento->setId($datos['id']);
            $evento->setNombre($datos['nombre']);
            $evento->setFechaInicio($datos['fechaInicio']);
            $evento->setFechaFin($datos['fechaFin']);
            $evento->setDescripcion($datos['']);
            $em->persist($evento);
            $flush = $em->flush();
            if ($flush == null) {
                echo "Post creado correctamente";
            } else {
                echo "El post no se ha creado";
            }

        } else {
            echo "El post no se ha creado";
        }
    }

    /**
     * @Route("/api/lista/eventos", name="api_lista_eventos")
     */
    public function apiListaEventos(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $arrEventos = $em->getRepository(Evento::class)->lista();
        $eventos = [];
        forEach($arrEventos as $arrEvento){
            $item = [
                "title"=>"{$arrEvento['id']} - {$arrEvento['nombre']}",
                "start"=>$arrEvento['fechaInicio']->format("Y-m-d"),
                "end"=>$arrEvento['fechaFin']->format("Y-m-d"),
                "description"=> $arrEvento['descripcion'],
                "extendedProps"=>[
                    "department"=> 'BioChemistry'
                ]

            ];
            $eventos[] = $item;
        }
        $response = new JsonResponse($eventos);
        return $response;
    }
}