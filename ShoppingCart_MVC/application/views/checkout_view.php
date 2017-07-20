
<!DOCTYPE html>

<html>
    <head>
        <title>Shopping Cart</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- CDN  -->          
        <script src="https://code.jquery.com/jquery-3.2.1.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
          
        <!-- CSS -->
        <?php echo link_tag('assets/css/shop_style.css'); ?>
        
         <!-- Script -->
         <script type="text/javascript">
            function getSiteURL() {
                return "<?php echo site_url();?>/";
            }
        </script>
         <script type="text/javascript" src="<?php echo base_url();?>assets/scripts/shop.js" ></script>
         <script type="text/javascript" src="<?php echo base_url();?>assets/scripts/checkout.js" ></script>
    </head>
    
    
    <body>    
        <div class="container">
            
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading text-center">Yotam Tsorfi</h4>
            </div>  
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading text-center">Checkout</h4>
            </div> 
                <!-- cards container -->   
            <div class="row" id="cart">
              <?php      
                require('ProductElement.php');
                $productElement = new ProductElement();
                if (isset($products)) {
                    foreach ($products as $product) {
                        echo $productElement->getCheckoutElement($product);
                    }
                } 
              ?>
            </div>  
                <div  class="alert alert-danger text-center" role="alert" id="empty_cart_msg">Your shopping cart is empty </div>
            <div class="row"> 
              <div class="w-100 p-3 text-center col-lg-3 col-md-6 col-sm-12 col-xs-12 " id="total_price" style="background-color: #eee;">Total Price: <?php echo $totalPrice;?>$</div>
              <button class="btn btn-success col-lg-3 col-md-6 col-sm-12 col-xs-12" onclick="buyProducts()" id="buy_btn">Buy</button>
              <button class="btn btn-warning col-lg-3 col-md-6 col-sm-12 col-xs-12" onclick="location.href='<?php echo site_url();?>/shop'">Back To Shopping</button>
              <button class="btn btn-danger col-lg-3 col-md-6 col-sm-12 col-xs-12" onclick="location.href='<?php echo site_url();?>/logout'">Logout</button>
            </div>    
    </body>
</html>
