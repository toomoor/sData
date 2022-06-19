<?php
class CRUD {
    private $myfile,$i,$tmp,$result;

    private $host;
    private $username;
    private $password;
    private $database;

    private $con;
    private $sql,$rSql;

    function __construct(){
        $this->myfile = fopen("define.txt", "r") or die("Unable to open file!"); #define.txt opening

        $this->tmp = explode(",", fgets($this->myfile));

        $this->result = explode("=>", $this->tmp[0]);
        $this->host = $this->result[1];

        $this->result = explode("=>", $this->tmp[1]);
        $this->username = $this->result[1];

        $this->result = explode("=>", $this->tmp[2]);
        $this->password = $this->result[1];

        $this->result = explode("=>", $this->tmp[3]);
        $this->database = $this->result[1];

        fclose($this->myfile); #define.txt closing
    }

    private function database(){
        $this->con = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->con->connect_error) {
            die("Connection failed: " . $this->con->connect_error);
        }
    }

    function Create($table, $fields=''){
        $this->database();
        $this->sql = "INSERT INTO ".$table."(".implode(", ", array_keys($fields)).")VALUES('".implode("', '", array_values($fields))."')";
        $this->rSql = $this->con->query($this->sql);
        if($this->rSql){
            return true;
        }else{
            return false;
        }
        $this->con->close();
    }

    function Read($table) {
        $this->database();
        $this->sql = "SELECT * FROM ".$table."";
        $this->rSql = $this->con->query($this->sql);
        $list = array();
        while($data = $this->rSql->fetch_array()){
            $list[] = $data;
        }
        $this->con->close();
        return $list;
    }

    function ReadWhere($table, $where){
        $this->database();
        $condition = "";
        $list = array();
        foreach($where as $key => $value){
            $condition .= $key ." = '".$value."' AND "; 
        }
        $condition = substr($condition, 0, -5);
        $this->sql = "SELECT * FROM ".$table." WHERE ".$condition." ";
        $this->rSql = $this->con->query($this->sql);
        while($row = $this->rSql->fetch_array()){
            $list[] = $row;
        }
        $this->con->close();
        return $list;
    }

    function Update($table, $fields, $where){
        $this->database();
        $query = "";
        $condition = "";
        foreach($fields as $key => $value){
            $query .= $key." = '".$value."', ";
        }
        $query = substr($query, 0, -2);
        foreach($where as $key => $value){
            $condition .= $key." = '".$value."' AND ";
        }
        $condition = substr($condition, 0, -5);
        $this->sql = "UPDATE ".$table." SET ".$query." WHERE ".$condition." ";
        $this->result = $this->con->query($this->sql);
        if($this->result){
            return true;
        }else{
            return false;
        }
        $this->con->close();
    }
    function Delete($table, $where){
        $this->database();
        $condition = "";
        foreach($where as $key => $value){
            $condition .= $key." = '".$value."' AND ";
        }
        $condition = substr($condition, 0, -5);
        $this->sql = "UPDATE ".$table." SET action = '0' WHERE ".$condition." ";
        $this->rSql = $this->con->query($this->sql);
        if($this->rSql){
            return true;
        }else{
            return false;
        }
        $this->con->close();
    }
    function Search($table, $where){
        $this->database();
        $condition = "";
        $list = array();
        foreach($where as $key => $value){
            $condition .= $key ." LIKE '%".$value."%' OR "; 
        }
        $condition = substr($condition, 0, -5);
        $this->sql = "SELECT * FROM ".$table." WHERE ".$condition."' ";
        //echo $this->sql;
        //die();
        $this->rSql = $this->con->query($this->sql);
        while($row = $this->rSql->fetch_array()){
            $list[] = $row;
        }
        $this->con->close();
        return $list;
    }

    function showTables(){
        $this->database();
        $this->sql = "SHOW TABLES";
        $this->rSql = $this->con->query($this->sql);
        $list = array();
        while($data = $this->rSql->fetch_array()){
            $list[] =  $data;
        }
        $this->con->close();
        return $list;
    }
    function mergeTables($table1,$table2){
        $this->database();
        $this->sql = "";
    }
}

?>