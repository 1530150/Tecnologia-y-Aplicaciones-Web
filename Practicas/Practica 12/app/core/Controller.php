<?php
  class Controller{
    //Array con el nombre de los meses
    private $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    //Método para llamar al modelo
    public function model($model){
      require_once "../app/models/" . $model . ".php";
      return new $model();
    }

    //Método para llamar a la vista
    public function view($view, $data = []){
      if(file_exists("../app/views/" . $view . ".php")){
        require_once "../app/views/" . $view . ".php";
      }
      else{
        die("El archivo no existe");
      }
    }

    //Método para acmodoar la fecha
    public function acomodarFecha($fecha){
      $fechas=explode('-', $fecha); //Se divide la fecha y se guarda en un arreglo

      //Se guarda cada parte de la fecha en variables diferentes
      $dia = $fechas[2];
      $mes = $this->meses[intval($fechas[1])-1]; //Se toma el valor del mes del array de meses
      $anio = $fechas[0];

      return $dia . "/" . $mes . "/" . $anio; //Se devuelve una cadena con las partes de la fecha concatenadas
    }
  }
?>
