<?php

namespace App\Entity\Agenda;

use App\Repository\Agenda\EventoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=EventoRepository::class)
 * @UniqueEntity(
 *     fields={"id"},
 *     errorPath="id",
 *     message="El id ingresado debe ser unico"
 * ) */
class Evento
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank
     *
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string")
     */
    private $nombre;

    /**
     * @ORM\Column(type="datetime", nullable=TRUE)
     */
    private $fechaInicio;

    /**
     * @ORM\Column(type="datetime", nullable=TRUE)
     */
    private $fechaFin;

    /**
     * @ORM\Column(type="text", nullable=TRUE)
     */
    private $descripcion;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }



    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * @param mixed $fechaInicio
     */
    public function setFechaInicio($fechaInicio): void
    {
        $this->fechaInicio = $fechaInicio;
    }

    /**
     * @return mixed
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * @param mixed $fechaFin
     */
    public function setFechaFin($fechaFin): void
    {
        $this->fechaFin = $fechaFin;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }



}
