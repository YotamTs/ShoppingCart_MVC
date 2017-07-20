
// run once the page DOM is ready.
$( document ).ready(function() {
    setCheckoutMessageAndButtons();    
});

function buyProducts() {
    removeAllProductsFromServer();
    alert('thank you');  
    $("#cart").empty();
    $("#total_price").text("Total Price: 0$");  
    setCheckoutMessageAndButtons();
}

function setCheckoutMessageAndButtons() {
    var cartProducts = $("#cart").children();
    
    if (cartProducts.length === 0) {
      $("#empty_cart_msg").show();  
      $("#buy_btn").attr("disabled", true); 
    }
    else {
      $("#empty_cart_msg").hide();  
      $("#buy_btn").attr("disabled", false); 
    }
}