<?php
  //Nodelo Alumnos
  class HomeModel{
    private $trans;

    //Constructor del modelo
    public function __construct(){
      $this->trans = new Connection();
    }

    //Método para iniciar sesión
    function validarLogin($data){
      $this->trans->query("SELECT * FROM usuarios WHERE nombre=:nombre AND password=:clave"); //Consulta
      $data["clave"] = md5($data["clave"]);

      //Preparación y ejecución de la consulta
      $this->trans->bind(":nombre", $data["nombre"]);
      $this->trans->bind(":clave", $data["clave"]);
      $res = $this->trans->execute();

      //Se crea la sesión y se guarda la info del usuario
      if($usuario = $res->fetch(PDO::FETCH_ASSOC)){
          session_start();
          $_SESSION["usuario"] = $usuario["nombre"];

          return true;
      }
      else{
        return false;
      }
    }

    //Método para obtener todas las alumnas
    public function getAlumnas(){
      $this->trans->query("SELECT a.id, CONCAT(a.nombre, ' ', a.apellido), a.fecha_nacimiento, g.nombre FROM alumnas a INNER JOIN grupos g ON a.grupo=g.id");
      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener todas las grupos
    public function getGrupos(){
      $this->trans->query("SELECT * FROM grupos");
      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para agregar una alumna
    public function agregarPago($data){
      $this->trans->query("INSERT INTO pagos VALUES(null, :grupo, :alumna, :nombre_mama, :apellido_mama, :fecha_pago, :fecha_envio, :folio, :folio_img)");

      $fecha_envio = date("d-m-Y H:i:s"); //Se obtiene la fecha actual
      $destino_img = substr(RUTA_APP, 0, -4) . "/public/img/" . $data["nombre_img"]; //Se crea el destino de la imagen
      copy($data["ruta_img"], $destino_img); //Se copia la imagen al servidor

      $this->trans->bind(":grupo", $data["grupo"]);
      $this->trans->bind(":alumna", $data["alumna"]);
      $this->trans->bind(":nombre_mama", $data["nombre_mama"]);
      $this->trans->bind(":apellido_mama", $data["apellido_mama"]);
      $this->trans->bind(":fecha_pago", $data["fecha_pago"]);
      $this->trans->bind(":fecha_envio", $fecha_envio);
      $this->trans->bind(":folio", $data["folio"]);
      $this->trans->bind(":folio_img", $destino_img);

      $res = $this->trans->execute();
    }

    //Método para obtener todos los pagos
    public function getPagos(){
      $this->trans->query("SELECT p.id, g.nombre, CONCAT(a.nombre, ' ', a.apellido), CONCAT(p.nombre_mama, ' ', p.apellido_mama), p.fecha_pago, p.fecha_envio, p.folio, p.imagen_folio FROM pagos p INNER JOIN grupos g ON p.grupo=g.id INNER JOIN alumnas a ON p.alumna=a.id ORDER BY p.id");
      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener todas las alumnas de un grupo
    public function getAlumnasGrupo($grupo){
      $this->trans->query("SELECT id, CONCAT(nombre, ' ', apellido) FROM alumnas WHERE grupo=:grupo");
      $this->trans->bind(":grupo", $grupo);
      $res = $this->trans->execute();

      return $res->fetchAll();
    }



  }
?>
