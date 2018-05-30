<?php
  //Clase app
  class App{

    //url por defecto en caso de que no se escriba nada en la url
    protected $controller = "home";
    protected $method = "index";
    protected $params = [];

    public function __construct(){
      $url = $this->parseUrl();

      //Se comprueba si el controlador (la página) existe
      if(file_exists("../app/controllers/" . $url[0] . ".php")){
        //Se asigna como el controlador de la página actual
        $this->controller = $url[0];
        unset($url[0]);
      }

      //Se incluye el archivo que contiene la clase del controlador
      require_once "../app/controllers/" . $this->controller . ".php";

      //Se instancia un nuevo objeto del controlador
      $this->controller = new $this->controller;

      //Se verifica que se haya pasado el parámetro en la url
      if(isset($url[1])){
        //Se verifica que el método pasado sea un método del controlador
        if(method_exists($this->controller, $url[1])){
          //Se asigna como el método de la página actual
          $this->method = $url[1];
          unset($url[1]);
        }
      }

      //Se asignan los parámestros a la variable de parámestros
      $this->params = $url ? array_values($url) : [];

      //Se hace la llamada al método del controlador actual y se le pasan los parámetros
      call_user_func_array([$this->controller, $this->method], $this->params);
    }

    //Función para obtener el controlador, el método y el parámetro de la url
    public function parseUrl(){
      if(isset($_GET["url"])){
        return $url = explode("/", filter_var(rtrim($_GET["url"], "/"), FILTER_SANITIZE_URL));


      }
    }
  }
?>
