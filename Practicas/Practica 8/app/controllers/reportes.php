<?php
  class Reportes extends Controller{
    private $modelo; //Objeto del modelo

    //Constructor
    public function __construct(){
      $this->modelo = $this->model("ReportesModel");
    }

    //Página index
    public function index($tutor=""){
      $this->view("reportes/index", [$this->modelo->getTutorias($tutor), $this->modelo->getAlumnos($tutor)]);
    }
  }
