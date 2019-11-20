<?php 
class Articles {
    public $conn;
    public $table_name = "testmerrill.Articles";
    public $number;
    public $name;
    public $price;
    public function __construct($db){
        $this->conn = $db;
    }

  public function readAll() {
          //select all data
          $query = "SELECT
                    article_id, article_name
                FROM {$this->table_name} 
                ";
          
          $stmt = $this->conn->prepare( $query );
          $stmt->execute();
   
          return $stmt;
  }
  public function viewDeviceConnections() {
      $query = "SELECT Articles.article_id, article_name, article_price
      FROM {$this->table_name}
      INNER JOIN testmerrill.Device_Article_Connection ON Device_Article_Connection.article_id=Articles.article_id
      WHERE device_id = '{$this->number}'";
      $stmt = $this->conn->prepare( $query );
      $stmt->execute();
      return $stmt;
  }
}
?>