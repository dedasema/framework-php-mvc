<?php

namespace App\Models;

use mysqli;

class Model
{
    protected $dbhost = DB_HOST;
    protected $dbuser = DB_USER;
    protected $dbpass = DB_PASS;
    protected $dbname = DB_NAME;
    protected $conection;
    protected $query;
    protected $table;
    protected $orderBy;
    protected $where;
    protected $values = [];
    protected $select = '*';

    public function __construct()
    {
        $this->conection();
    }


    public function conection()
    {
        $this->conection = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        if ($this->conection->connect_error) {
            die("Conexión fallida: " . $this->conection->connect_error);
        }
    }

    public function query($sql, $data = [], $params = null)
    {
        if ($data) {
            if ($params == null) {
                $params = str_repeat('s', count($data));
            }
            $queryPrepa = $this->conection->prepare($sql);
            $queryPrepa->bind_param($params, ...$data);
            $queryPrepa->execute();
            $this->query = $queryPrepa->get_result();
        } else {
            $this->query = $this->conection->query($sql);
        }
        return $this;
    }

    public function select(...$columns)
    {
        $this->select = implode(',', $columns);
        return $this;
    }

    public function where($column, $operator, $value = null)
    {
        if ($value == null) {
            $value = $operator;
            $operator = '=';
        }

        if($this->where){
            $this->where .= " AND {$column} {$operator} ?";
        }else{
            $this->where = "{$column} {$operator} ?";
        }

        $this->values[] = $value;

        return $this;
    }

    public function orderBy($column, $order = 'ASC')
    {
        if($this->orderBy){
            $this->orderBy .= ", {$column} {$order}";
        }else{
            $this->orderBy .= "{$column} {$order}";
        }
        return $this;
    }

    public function first()
    {
        if (empty($this->query)) {
            $sql = "SELECT {$this->select} FROM {$this->table} ";
            if($this->where){
                $sql .= " WHERE {$this->where}";
            }
            if($this->orderBy){
                $sql .= " ORDER BY {$this->orderBy}";
            }
            $this->query($sql, $this->values);
        }
        return $this->query->fetch_assoc();
    }

    public function get()
    {

        if (empty($this->query)) {
            $sql = "SELECT {$this->select} FROM {$this->table} ";
            if($this->where){
                $sql .= " WHERE {$this->where}";
            }
            if($this->orderBy){
                $sql .= " ORDER BY {$this->orderBy}";
            }
            $this->query($sql, $this->values);
        }

        return $this->query->fetch_all(MYSQLI_ASSOC);
    }

    public function paginate($cant = 10)
    {
        $page = $_GET['page'] ?? 1;

        if(empty($this->query)){
            $sql = "SELECT {$this->select} FROM {$this->table} ";
            if($this->where){
                $sql .= " WHERE {$this->where}";
            }
            if($this->orderBy){
                $sql .= " ORDER BY {$this->orderBy}";
            }

            $sql .= " LIMIT " . ($page - 1) * $cant . ", {$cant}";

            $data = $this->query($sql, $this->values)->get();
        }

        $total = $this->query("SELECT FOUND_ROWS() AS total")->first()['total'];

        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');

        if (strpos($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }

        $lastPage = ceil($total / $cant);

        return [
            'total' => $total,
            'from' => ($page - 1) * $cant + 1,
            'to' => ($page - 1) * $cant + count($data),
            'current_page' => $page,
            'last_page' => $lastPage,
            'next_page_url' => $page < $lastPage ? '/' . $uri . '?page=' . $page + 1 : null,
            'prev_page_url' => $page > 1 ? '/' . $uri . '?page=' . $page - 1 : null,
            'data' => $data
        ];
    }

    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql)->get();
    }

    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return $this->query($sql, [$id], 'i')->first();
    }

    

    public function create($data)
    {
        $columns = array_keys($data);
        $columns = implode(',', $columns);
        $values = array_values($data);
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES (" . str_repeat('?,', count($values) - 1) . "?)";
        $this->query($sql, $values);
        $insert_id = $this->conection->insert_id;
        return $this->find($insert_id);
    }

    public function update($id, $data)
    {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "{$key} = ?";
        }
        $fields = implode(', ', $fields);
        $sql = "UPDATE {$this->table} SET {$fields} WHERE id = ?";
        $values = array_values($data);
        $values[] = $id;
        $this->query($sql, $values);
        return $this->find($id);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        return $this->query($sql, [$id], 'i');
    }
}
