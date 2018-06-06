<?php
  //Nodelo Usuarios
  class UsuariosModel{
    private $trans;

    //Constructor del modelo
    public function __construct(){
      $this->trans = new Connection();
    }

    //Método para agregar un usuario
    public function agregarUsuario($data){
      $this->trans->query("INSERT INTO usuarios VALUES(null, :nombre, :apellido, :nombre_usuario, :password, :correo, :fecha, :destino)");

      $fecha = date("Y-m-d"); //Se obtiene la fecha actual
      $destino_img = substr(RUTA_APP, 0, -4) . "/public/dist/img/" . $data["nombre_img"]; //Se crea el destino de la imagen
      copy($data["ruta_img"], $destino_img); //Se copia la imagen al servidor
      $data["password"] = md5($data["password"]); //Se encripta la contraseña

      $this->trans->bind(":nombre", $data["nombre"]);
      $this->trans->bind(":apellido", $data["apellido"]);
      $this->trans->bind(":nombre_usuario", $data["nombre_usuario"]);
      $this->trans->bind(":password", $data["password"]);
      $this->trans->bind(":correo", $data["correo"]);
      $this->trans->bind(":fecha", $fecha);
      $this->trans->bind(":destino", $destino_img);

      $res = $this->trans->execute();
    }

    //Método para editar un usuario
    public function editarUsuario($data){
      $this->trans->query("UPDATE usuarios SET nombre=:nombre, apellido=:apellido, nombre_usuario=:nombre_usuario, password=:password, correo=:correo, ruta_img=:destino WHERE id=:id");

      $destino_img = substr(RUTA_APP, 0, -4) . "/public/dist/img/" . $data["nombre_img"]; //Se crea el destino de la imagen
      copy($data["ruta_img"], $destino_img); //Se copia la imagen al servidor

      $this->trans->bind(":id", $data["id"]);
      $this->trans->bind(":nombre", $data["nombre"]);
      $this->trans->bind(":apellido", $data["apellido"]);
      $this->trans->bind(":nombre_usuario", $data["nombre_usuario"]);
      $this->trans->bind(":password", $data["password"]);
      $this->trans->bind(":correo", $data["correo"]);
      $this->trans->bind(":destino", $destino_img);

      $res = $this->trans->execute();
    }

    //Método para eliminar un usuario
    public function eliminarUsuario($id){
      $this->trans->query("DELETE FROM usuarios WHERE id=:id");

      $this->trans->bind(":id", $id);

      $res = $this->trans->execute();
    }

    //Método para obtener todos los usuarios
    public function getUsuarios(){
      $this->trans->query("SELECT * FROM usuarios");
      $res = $this->trans->execute();

      $res = $this->trans->execute();

      return $res->fetchAll();
    }

    //Método para obtener un usuario en específico
    public function getUsuario($id){
      $this->trans->query("SELECT * FROM usuarios WHERE id=:id");
      $this->trans->bind(":id", $id);
      $res = $this->trans->execute();

      return $res->fetch(PDO::FETCH_NUM);
    }
  }
?>
