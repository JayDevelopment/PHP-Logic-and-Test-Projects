<?php 
class Devices {
    public $conn;
    public $table_name = "testmerrill.Devices";
    public $number;
    public $search;
    public $manufacturer;
    public $article;
    //public $error_css =  (strlen($this->search) >= 3 ? "class='device_search'" : "class='red'");
    public function __construct($db){
        $this->conn = $db;
    }
    public function last_row_count() {
        return $this->conn->query("SELECT FOUND_ROWS()")->fetchColumn();
    }
    public function validate($number, $search, $stmt) {
        if(isset($number) && $number != '' && empty($search) && $stmt->rowCount() == false) {
            echo "<p class = 'error'>The device number {$number} is invalid </p>";
            die();
        } elseif(isset($search) && $search != '' && empty($number) && $stmt->rowCount() == false) {
            $this->check_string_length($this->search);
            echo "<p class = 'error'>There were no matches for the searched term </p>";
            die();
        } 
    }
    public function died(){
        if(!isset($_GET)) {
        echo "<br><p class = 'error'>Please fill in either the device number OR device search field</p>";
        die();
        }
    }
    public function check_string_length ($string) {
        if(strlen($string) < 4) {
            $error_css = 'error';
            echo "<p class ='error'>Not enough characters</p>";
            die();
        }
    }
  public function read() {

      if(isset($this->number) && $this->number != '' && empty($this->search)) {
          $sql = "SELECT device_id, device_name, device_manufacturer
          FROM {$this->table_name}
          WHERE device_id = :number LIMIT 1";
          $stmt = $this->conn->prepare($sql);
          $this->number=htmlspecialchars(strip_tags($this->number));
          $stmt->bindParam(':number', $this->number);
      }  elseif (isset($this->search) && $this->search != '' && empty($this->number)) {
          $sql = "SELECT device_id, device_name, device_manufacturer
          FROM {$this->table_name}
          WHERE device_name LIKE :search LIMIT 50";
          $stmt = $this->conn->prepare($sql);
          $this->search=htmlspecialchars(strip_tags($this->search))."%";
          $this->check_string_length($this->search);
          $stmt->bindParam(':search', $this->search);
      } else {
          $this->died();
      }
          $stmt->execute();
          $this->validate($this->number, $this->search, $stmt);
          return $stmt;
  }
  public function create($device_name, $device_manufacturer, $articles) {
      if(isset($device_name) && isset($device_manufacturer) && isset($articles)) {
          
          $sql_update1 = "INSERT INTO {$this->table_name} (device_name, device_manufacturer) 
                          VALUES (:name, :manufacturer)";
          $stmt = $this->conn->prepare($sql_update1);
          $this->name=htmlspecialchars(strip_tags($device_name));
          $this->manufacturer=htmlspecialchars(strip_tags($device_manufacturer));
          $stmt->bindParam(":name", $this->name);
          $stmt->bindParam(":manufacturer", $this->manufacturer);
          $stmt->execute();
          $last_id = $this->conn->lastInsertId();
          
          $sql_update2 = "INSERT INTO testmerrill.Device_Article_Connection (device_id, article_id)
              VALUES (:last_id,:article)";
          $stmt = $this->conn->prepare($sql_update2);
         // $this->article=htmlspecialchars(strip_tags($article));
          $stmt->bindParam(":last_id", $last_id);
          $stmt->bindParam(":article", $article);
          
          foreach ($articles as $article) {
              $stmt->execute();
          } 
          echo "<p class = 'error'>Device Created</p>";
      } else {
          echo "<p class = 'error'>*Please fill out the entire form</p>";
      } 
}
  
}
?>