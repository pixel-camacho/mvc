<?php

namespace App\Models;

use mysqli;

class Model{

    protected $db_host = DB_HOST;
    protected $db_user = DB_USER;
    protected $db_pass = DB_PASS;
    protected $db_name = DB_NAME;

    protected $connection;
    protected $query;
    protected $table;


    public function __construct()
    {
        $this->connection();
    }

    public function connection(){

       $this->connection = new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_name);

       if($this->connection->connect_error){
        die("Error de conexión: ".$this->connection->connect_error);
       }
    }

    public function query($sql, $data = [] , $params = null){

        if($data){

            if($params == null){
                $params = str_repeat('s',count($data));
            }

            $preparada = $this->connection->prepare($sql);
            $preparada->bind_param($params,...$data);
            $preparada->execute();

            $this->query = $preparada->get_result();

        }else{

            $this->query = $this->connection->query($sql);
        }
        return $this;
    }

    public function firts(){
        return $this->query->fetch_assoc();
    }

    public function get(){
        return $this->query->fetch_all(MYSQLI_ASSOC);
    }

    // Consultas

    public function all() {
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql)->get();
    }

    public function find($id) {

        $sql = "SELECT * FROM {$this->table} WHERE Id = ?";
        return $this->query($sql,[$id],'i')->firts();
    }

    public function where($column,$operator,$value = null){

        if($value == null){
            $value = $operator;            
            $operator = '=';
        }

        $sql = "SELECT * FROM {$this->table} WHERE {$column} {$operator} ?";
        $this->query($sql,[$value]);
        return $this;
    }

    public function create($data){

        $columns = array_keys($data);
        $columns = implode(', ', $columns);

        $values = array_values($data);

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES (".str_repeat('?,',count($values) - 1)."?)";
        $this->query($sql,$values);
       
        $insert_id = $this->connection->insert_id;
        return $this->find($insert_id);
    }

    public function update($id,$data){

        foreach($data as $key => $value){

            $fields[] = "{$key} = ?"; 
        }

        $fields = implode(', ',$fields);
        $sql = "UPDATE {$this->table} SET {$fields} WHERE Id = ?";
        $values = array_values($data);
        $values[] = $id;

        $this->query($sql,$values);
        return $this->find($id);
    }

    public function delete($id){

        $sql = "DELETE FROM {$this->table} WHERE Id = ?";
        $this->query($sql,[$id],'i');
    }
}