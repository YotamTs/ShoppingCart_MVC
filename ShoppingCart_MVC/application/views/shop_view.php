
<!DOCTYPE html>

<html>
    <head>
        <title>Shop</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- CDN -->          
        <script src="https://code.jquery.com/jquery-3.2.1.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        
        <!-- Script -->   
        <script type="text/javascript">
            function getSiteURL() {
                return "<?php echo site_url();?>/";
            }
        </script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/scripts/shop.js" ></script>
        
        <!-- CSS -->
        <?php echo link_tag('assets/css/shop_style.css'); ?>
    </head>
    
    
    <body>    
        <?php      
            require('ProductElement.php');
            $productElement = new ProductElement();
        ?>
        <div class="container">
            
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading text-center">Yotam Tsorfi</h4>
                <h6 class="text-center">Click on the Shopping cart button to see the products. drag & drop products supported.</h6>
            </div>
            
            <!-- shopping cart button-->
            <button class="btn btn-warning btn-lg btn-block dropToCart" 
                    type="button" data-toggle="collapse" data-target="#collapse_erea" aria-expanded="false" aria-controls="collapse_erea" 
                    ondragover="allowDrop(event)" ondrop="onDrop(event)" id="cart_button">
                    <span class="fa fa-sort-down fa-fw" aria-hidden="true"></span>  
                    Shopping Cart 
                    <span class="fa fa-sort-down fa-fw" aria-hidden="true"></span>  
            </button> 
            
            <!-- collapsing shopping cart -->
            <div class="collapse dropToCart" id="collapse_erea" ondragover="allowDrop(event)" ondrop="onDrop(event)">
                <div  class="alert alert-danger text-center" role="alert"  id="empty_cart_msg">Your shopping cart is empty </div>
                <div class="row dropToCart productsContainer" id="cart"> 
                    <?php      
                        foreach ($products as $product) {
                            echo $productElement->getCartElement($product);
                        } 
                    ?>
                </div>
                
                <!-- Empty cart button -->
                <button type="button" class="btn btn-danger btn-block dropToCart" id="empty_cart_btn" data-toggle="modal" data-target="#myModal">Empty Cart</button><p>
                
                <!-- checkout button -->   
                <?php echo form_open('shop/checkout'); ?>   
                   <?php echo form_input(array('name' => 'data', 'type'=>'hidden', 'id' =>'checkout_products')); ?>               
                   <button type="submit" class="btn btn-success btn-block dropToCart" id="checkout_btn" onclick="sendCartItems()">Checkout</button>              
                </form>
                
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Empty cart</h4>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure do you want to remove all items?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="button" onclick="removeAllFromCart()" data-dismiss="modal" class="btn btn-primary">Yes Empty the cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Empty cart button end -->     
            </div>
            
            <!-- buttons bar -->
            <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Home Button --> 
                <a class="navbar-brand" href="<?php echo site_url();?>/shop">Home</a> 
                <a class="navbar-brand" href="<?php echo site_url();?>/logout">Logout</a> 
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <!-- sort by title --> 
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Sort By: <span class="sr-only">(current)</span></a>
                        </li>
                        <!-- sort by price --> 
                        <li class="nav-item">
                            <a class="nav-link" id="price_order" href="#" onclick="sortByPrice()" data-toggle="tooltip" data-placement="bottom" title="Sort By Price">Price: increasing</a>
                        </li>
                        <!-- sort by name --> 
                        <li class="nav-item">
                            <a class="nav-link" onclick="sortByName()" id="name_order" href="#" data-toggle="tooltip" data-placement="bottom" title="Sort By Name">Name: A-Z</a>
                        </li>
                        
                    </ul>
                    <form class="form-inline my-2 my-lg-0" id="form">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search" id="search_box" name="search_box">
                        <button class="btn btn-outline-success my-2 my-sm-0" value="Search" type="submit">Search</button>
                    </form>
                </div>
            </nav>
            <!-- buttons bar end -->
            
            <!-- error message -->
            <h3 class="bg-danger text-white text-center"  id="error_msg">Error</h3>
            
            <p>
                
                <!-- cards container -->   
            <div class="row dropToList productsContainer" ondragover="allowDrop(event)" ondrop="onDrop(event)" id='productsList'>
               <?php      
                $productsList = $this->products->getProducts("");
                foreach ($productsList as $product) {
                    echo $productElement->getListElement($product);
                } 
               ?>
            </div>  
        </div>
        
    </body>
</html>
