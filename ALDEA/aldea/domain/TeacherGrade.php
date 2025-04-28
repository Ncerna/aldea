<?php 

class TeacherGrade {
    private $idDocenteGrados;
    private $docenteId;
    private $gradoId;
    private $nivelGradoId;
    private $idSeccion;
    private $yearId;
    private $sesionId;
    private $createDate;

    // Constructor
    public function __construct(
        $idDocenteGrados = null,
        $docenteId,
        $gradoId,
        $nivelGradoId,
        $idSeccion,
        $yearId,
        $sesionId,
        $createDate = null
    ) {
        $this->idDocenteGrados = $idDocenteGrados;
        $this->docenteId = $docenteId;
        $this->gradoId = $gradoId;
        $this->nivelGradoId = $nivelGradoId;
        $this->idSeccion = $idSeccion;
        $this->yearId = $yearId;
        $this->sesionId = $sesionId;
        $this->createDate = $createDate ?? date('Y-m-d H:i:s'); // Fecha de creación por defecto
    }

    // Getters y setters
    public function getIdDocenteGrados()
    {
        return $this->idDocenteGrados;
    }

    public function setIdDocenteGrados($idDocenteGrados)
    {
        $this->idDocenteGrados = $idDocenteGrados;
    }

    public function getDocenteId()
    {
        return $this->docenteId;
    }

    public function setDocenteId($docenteId)
    {
        $this->docenteId = $docenteId;
    }

    public function getGradoId()
    {
        return $this->gradoId;
    }

    public function setGradoId($gradoId)
    {
        $this->gradoId = $gradoId;
    }

    public function getNivelGradoId()
    {
        return $this->nivelGradoId;
    }

    public function setNivelGradoId($nivelGradoId)
    {
        $this->nivelGradoId = $nivelGradoId;
    }

    public function getIdSeccion()
    {
        return $this->idSeccion;
    }

    public function setIdSeccion($idSeccion)
    {
        $this->idSeccion = $idSeccion;
    }

    public function getYearId()
    {
        return $this->yearId;
    }

    public function setYearId($yearId)
    {
        $this->yearId = $yearId;
    }

    public function getSesionId()
    {
        return $this->sesionId;
    }

    public function setSesionId($sesionId)
    {
        $this->sesionId = $sesionId;
    }

    public function getCreateDate()
    {
        return $this->createDate;
    }

    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    }
}


 ?>