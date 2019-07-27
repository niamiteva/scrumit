<?php

require_once (DB . 'connection.php');

///////////////////////////////////////////////////////////////////////////////////////////////
//WHAT'S INSIDE THE CLASS
///////////////////////////////////////////////////////////////////////////////////////////////
//main DB request, used for all entities:
////gets connection to the DB
////gets all data for the certain entity
////gets all data for certain entity by foreign key from other (parent) entity 
////gets data by id for the certain entity
////gets data by given column and column value for the certain entity
////delete data by id for the certain entity
////inserts data for the certain entity
////update data for the certain entity
///////////////////////////////////////////////////////////////////////////////////////////////

class BaseModel
{
    protected $conn; //database connection object
    protected $table; //table name
    protected $fields = array();  //fields list

    ///////////////////////////////////////////////
    //gets connection
    //initialise the table
    ///////////////////////////////////////////////
    public function __construct($table){
        $c = new Connection();
        $this->conn = $c->getConnection();
        $this->table = $table;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getAllByFK($obj, $fk) {
        $query = "SELECT * FROM `{$this->table}` WHERE `{$obj}` = '{$fk}'" ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getById($obj, $id) {
        $query = "SELECT * FROM `{$this->table}` WHERE `{$obj}` = '{$id}'" ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getByColumn($obj,$column, $value){
        $query = "SELECT `{$obj}` FROM `{$this->table}` WHERE `{$column}` = '{$value}'" ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    //TODO
    public function deleteById($obj,$id) {
        $query = "DELETE FROM `{$this->table}` WHERE `{$obj}` = '{$id}'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function insert($list){
        $field_list = '';  //field list string
        $value_list = '';  //value list string
        foreach ($list as $k => $v) {  
            if(strpos("'" . $k . "'", '_id') !== false){
                $field_list .= "`".$k."`" . ',';
                $value_list .= 'UUID(),';
            }
            else{
                $field_list .= "`".$k."`" . ',';
                $value_list .= "'".$v."'" . ',';
            } 
        }
        // Trim the comma on the right
        $field_list = rtrim($field_list,',');
        $value_list = rtrim($value_list,',');
        // Construct sql statement
        $query = "INSERT INTO `{$this->table}` ({$field_list}) VALUES ($value_list)";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            return true;
        }
        else {
            return false;
        }
    }

    public function update($obj,$list, $id){
        $field_list = '';
        $where = 0; 
        foreach ($list as $k => $v) {
            if ($k == $obj) {
                $where = "`".$k."`='".$v."'";
            } else {
                $field_list .= "`".$k."`='".$v."'" . ',';
            }
        }
        $field_list = rtrim($field_list,',');
        $query = "UPDATE `{$this->table}` SET {$field_list} WHERE {$where}";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            return true;
        }
        else {
            return false;
        }
    }
  
}

?>