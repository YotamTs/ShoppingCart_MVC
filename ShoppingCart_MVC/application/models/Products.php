<?php

class Product {
     public function __construct($name, $ref, $price, $img) {
         $this->name = $name;
         $this->ref = $ref;
         $this->price = $price;
         $this->img = $img;
    }
}

class Products extends CI_Model {
    
    Public function __construct() { 
        parent::__construct(); 
        $this->load->database();
    } 
      
    function getProducts($str) {       
        $sql = "SELECT * FROM products WHERE name LIKE '" 
               .$this->db->escape_like_str($str)."%' ESCAPE '!'";
        $query  = $this->db->query($sql);
        
        $result = array();
        foreach ($query->result_array() as $row) {
            array_push($result, new Product($row["name"], $row["ref"], $row["price"], $row["image_url"]));
        }   
        return $result;
    }
    
    function getProductByID($id) {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM products WHERE ref = $id";
        $query  = $this->db->query($sql);
        
         foreach ($query->result_array() as $row) {
            return new Product($row["name"], $row["ref"], $row["price"], $row["image_url"]);
        } 
    } 
}