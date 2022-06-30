<?php
class CRUD {
    private $myfile,$i,$tmp,$result;

    private $host, $username, $password, $database;

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

    function getColumnsName($table){
        $this->database();
        $this->sql = "SHOW COLUMNS FROM ".$table;
        $this->rSql = $this->con->query($this->sql);
        $list = array();
        while($data = $this->rSql->fetch_array()){
            $list[] = $data;
        }
        return $list;
    }

    function MergeTable($table1,$table2){
        $this->database();
        $cTable1 = "";
        $cTable2 = "";
        $columnsTable1 = $this->getColumnsName($table1);
        for ($i=1; $i<count($columnsTable1); $i++){
            $cTable1 .= $columnsTable1[$i]['Field']. ", ";
        }
        $cTable1 = substr($cTable1, 0, -2);
        $columnsTable2 = $this->getColumnsName($table2);
        for ($i=1; $i<count($columnsTable2); $i++){
            $cTable2 .= $columnsTable2[$i]['Field']. ", ";
        }
        $cTable2 = substr($cTable2, 0, -2);

        $mergeName = "m_".rand(1000,9999);
        $this->sql = "CREATE TABLE IF NOT EXISTS ".$mergeName.
            "(".$mergeName."_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY)".
            " AS SELECT $cTable1 FROM $table1 UNION ALL SELECT $cTable2 FROM $table2"; 
        if($this->con->query($this->sql) === FALSE){
            if(strlen($cTable2) > strlen($cTable1)){
                $cTable1 = "";
                $cTable2 = "";
                $this->sql = "CREATE TABLE IF NOT EXISTS ".$mergeName.
                    " LIKE ".$table2;
                $this->con->query($this->sql);
                $less = count($columnsTable2) - count($columnsTable1);
                for($i=1; $i <= $less; $i++){
                    $cTable2 .= $columnsTable2[$i]['Field']. ", ";
                }
                $cTable2 = substr($cTable2, 0, -2);
                for($i=1; $i<count($columnsTable1); $i++){
                    $cTable1 .= $columnsTable1[$i]['Field']. ", ";
                }
                $cTable1 = substr($cTable1, 0, -2);
                $this->sql = "INSERT INTO ".$mergeName.
                    "(".$cTable2.") SELECT ".$cTable1." FROM ".$table1;
                $this->con->query($this->sql);
                $cTable2 = "";
                for($i=1; $i<count($columnsTable2); $i++){
                    $cTable2 .= $columnsTable2[$i]['Field']. ", ";
                }
                $cTable2 = substr($cTable2, 0, -2);
                $this->sql = "INSERT INTO ".$mergeName.
                    "(".$cTable2.") SELECT ".$cTable2." FROM ".$table2;
                $this->con->query($this->sql);
            }else{
                $cTable1 = "";
                $cTable2 = "";
                $this->sql = "CREATE TABLE IF NOT EXISTS ".$mergeName.
                    " LIKE ".$table1;
                $this->con->query($this->sql);
                $less = count($columnsTable1) - count($columnsTable2);
                for($i=1; $i <= $less; $i++){
                    $cTable1 .= $columnsTable1[$i]['Field']. ", ";
                }
                $cTable1 = substr($cTable1, 0, -2);
                for($i=1; $i<count($columnsTable2); $i++){
                    $cTable2 .= $columnsTable2[$i]['Field']. ", ";
                }
                $cTable2 = substr($cTable2, 0, -2);
                $this->sql = "INSERT INTO ".$mergeName.
                    "(".$cTable1.") SELECT ".$cTable2." FROM ".$table2;
                $this->con->query($this->sql);
                $cTable1 = "";
                for($i=1; $i<count($columnsTable1); $i++){
                    $cTable1 .= $columnsTable1[$i]['Field']. ", ";
                }
                $cTable1 = substr($cTable1, 0, -2);
                $this->sql = "INSERT INTO ".$mergeName.
                    "(".$cTable1.") SELECT ".$cTable1." FROM ".$table1;
                $this->con->query($this->sql);
            }
        }        
        $this->con->close();
        return $mergeName;
    }
    
    function DropDuplicate($table){
        $cCTable = "";
        $this->database();
        $this->sql = "CREATE TABLE t_".$table." LIKE ".$table;
        $this->con->query($this->sql);
        $cTable = $this->getColumnsName($table);
        for ($i=1; $i<count($cTable); $i++){
            $cCTable .= $cTable[$i]['Field']. ", ";
        }
        $cCTable = substr($cCTable, 0, -2);
        $this->sql = "ALTER TABLE t_".$table." ADD UNIQUE(".$cCTable.")";
        $this->con->query($this->sql);
        $this->sql = "INSERT IGNORE INTO t_".$table." SELECT * FROM ".$table;
        $this->con->query($this->sql);
        $this->sql = "RENAME TABLE ".$table." TO old_".$table.
            ", t_".$table." TO ".$table;
        $this->con->query($this->sql);
        $this->sql = "DROP TABLE old_".$table;
        $this->con->query($this->sql);
        $this->con->close();
    }
    
}

?>