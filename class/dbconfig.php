<?php

class database {
  protected $table;

  private $db_host = "127.0.0.1";
  private $db_username = "root";
  private $db_password = "secret";
  private $db_name= "sakila";	//database name

  public function connectDb() {
    $conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_username, $this->db_password );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
  }

  public function query($sql) {
    return $this->connectDb()->prepare($sql);
  }

}

?>

