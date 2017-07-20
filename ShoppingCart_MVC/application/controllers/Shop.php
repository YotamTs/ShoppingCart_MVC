<?php 
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Shop extends CI_Controller {
 
    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html'));
        $this->load->model('products','',TRUE);
    }
 
    function index() {
        $this->checkLogin();    
        $this->load->view('shop_view', $this->getCartItems());
    }
 
    // sends to client json format of the wanted products
    function getProducts() {   
        $this->checkLogin();       
        $str = $this->input->post('search_box');
        echo json_encode($this->products->getProducts($str));
    }
    
    // adding product to the cart
    function addProduct() {
        $this->checkLogin();       
        $newProduct = array(
            "id"=> $this->input->post('id'),
            "quantity"=> $this->input->post('quantity'),
            "price"=> $this->input->post('price'));
        $products = $this->session->userdata('products'); 
        for($i = 0; $i < count($products); ++$i) {
           if($products[$i]['id'] == $newProduct['id']) {
               array_splice($products, $i, 1);
               break;
           }
        }       
        array_push($products, $newProduct);
        $this->session->set_userdata('products', $products);     
    }
    
    // remove product from the cart
    function removeProduct() {
        $this->checkLogin();      
        $productToRemove = $this->input->post('id');
        $products = $this->session->userdata('products'); 
        for($i = 0; $i < count($products); ++$i) {
           if($products[$i]['id'] == $productToRemove) {
               array_splice($products, $i, 1);
               break;
           }
        }       
        $this->session->set_userdata('products', $products);     
    }
    
    // remove all products from the cart
    function removeAllProducts() {
        $this->checkLogin();        
        $this->session->set_userdata('products', array()); 
    }
    
    // sends client to the checkout page
    function checkout() {
        $this->checkLogin();
        $data = $this->getCartItems();
        $data["totalPrice"] = $this->getTotalPrice();
        $this->load->view('checkout_view', $data);       
    }
    
    // return total price of all the products in the cart
    private function getTotalPrice() {
        $products = array();
        $productsData = $this->session->userdata('products');
        if (!isset($products)) {
            return 0;
        }
        $total = 0;
        foreach ($productsData as $productData) {
            $total += (int)$productData["quantity"] * (int)$productData["price"];
        } 
        return $total;    
    }
    
    // return array with cart products
    private function getCartItems() {
        $products = array();
        $productsID = $this->session->userdata('products');
      
        if (!isset($products)) {
            $data['products'] = $products;
            return $data;
        }
        
        foreach ($productsID as $productData) {
            $product = $this->products->getProductByID($productData["id"]);
            $product->quantity = $productData["quantity"];
            $product->total = (int)$productData["quantity"] * (int)$productData["price"];
            array_push($products, $product);
        } 
  
        $data['products'] = $products;
        return $data;
    }
    
    // check if the client was logged-in
    private function checkLogin() {
        if(!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }
    }
}
