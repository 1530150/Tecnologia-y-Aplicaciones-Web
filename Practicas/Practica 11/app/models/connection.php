<?php
  //Clase conexión
  class Connection{
    //Datos de la base de datos
    private $host = DB_HOST;
    private $usuario = DB_USER;
    private $password = DB_PASS;
    private $db = DB_DBNAME;

    //Variables para la conexión
    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
      //Configurar conexión
      $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db;
      $opciones = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );

      //Realizar conexión
      try{
        $this->dbh = new PDO($dsn, $this->usuario, $this->password, $opciones);
        $this->dbh->exec("set names utf8");
      }catch(PDOException $e){
        $this->error = $e->getMessage();
      }
    }

    //Método para preparar la consulta
    public function query($sql){
      $this->stmt = $this->dbh->prepare($sql);
    }

    //Método para vincular la consulta con bind
    public function bind($parametro, $valor){
      $this->stmt->bindValue($parametro, $valor);
    }

    //Método para ejecutar la consulta
    public function execute(){
      $this->stmt->execute();

      return $this->stmt;
    }

  }

?>
