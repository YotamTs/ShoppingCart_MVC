<?php

class ProductElement {

    private function getCardElement($product) {
        return '<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 cardHolder">
                          <div class="card" id="'.$product->ref.'" draggable="true" ondragstart="onDragStart(event)">
                            <img class="card-img-top img-fluid" src="'.$product->img.'" draggable="false">
                                <div class="card-block">
                                    <h4 class="card-title">'.$product->name.'</h4>
                                    <p class="card-text price">'.$product->price.'$'.'</p>
                                    <p class="card-text quantity">'.(isset($product->quantity) ? 'Quantity: '.$product->quantity : '').'</p>'; 
    }
    
    private function getElementCloser() {
        return '</div></div></div>'; 
    }
    
    public function getListElement($product) {
        return $this->getCardElement($product)
                .'<input class="btn btn-success btn-block" herf="#" type="button" value="Buy" onclick="addToCart($(this).closest('."'.card'".'))">'
                .$this->getElementCloser();
    }  
    
    public function getCartElement($product) {
        return $this->getCardElement($product)
                .'<input class="btn btn-danger btn-block" herf="#" type="button" value="Remove" onclick="removeFromCart($(this).closest('."'.cardHolder'".'))">'
                .$this->getElementCloser();
    }
    
    public function getCheckoutElement($product) {
        return $this->getCardElement($product)
                .'<p class="card-text total">Total: '.$product->total.'$'.'</p>'
                .$this->getElementCloser();
    }
}

