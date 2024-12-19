<?php


?>


<div class="title" xmlns="http://www.w3.org/1999/html">
    <h1>Catalog </h1>


<a href="/logout"><button class="btn" type="submit">LOGOUT</button> </a>

<br>
<br>
<a href="/cart"><button class="btn" type="submit">CART</button> </a>


<div class="body">
    <?php foreach ($products as $product):?>
    <div class="product_img">
        <!--<button type="button" class="btn btn-default btn-lg" v-on:click="showCheckout">
            <span class="glyphicon glyphicon-shopping-cart">{{ cartItemCount}}</span> Корзина
        </button>-->
        <img src="<?php echo $product['image_link'];?>" alt="">
    </div>
    <div class="product_info">
        <div class="seller_info">

        </div>
        <div class="product_title"><?php echo $product['name']; ?></div>

        <div class="product_price"> <?php echo '$'.$product['price']; ?>
        </div>
        <div class="product_descr"><?php echo $product['description']; ?> </div>
        <!--<div class="product_color">Color: Black</div>-->
        <div class="product_color">dns@dns.com</div>
        <!--<div class="product_color">+92 308 1234567</div>-->
        <div class="product_quantity">Quantity:<br>
            <input type="number">
        </div>

        <!--<div class="add_heart">
            <i class="fa fa-heart" aria-hidden="true"></i> like
        </div>-->

        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <title>add product</title>

        </head>
        <body>
        <div class="form">
            <div class="header-form">
                <span></span>
            </div>
            <form action="/add_product" method="post">

                    <input type="hidden" placeholder="Enter product-id" value="<?php echo $product['id'] ?? '';?>" name="product_id" required>

                    <label for="amount">Amount:<span1> <br><label style="color: darkred">
                                <?php echo $errors['amount'] ?? ''; ?>
                                <?php //echo $add ?? ''; ?>
                            </label></span1></span1></label>
                    <input type="text" placeholder="Enter amount" name="amount" required>

                    <div class="btn">
                        <button class="btn">add</button>
                    </div>
            </form>
        </div>
        </body>
        </html>




        <span> <button>Add to cart</button>  <button>Delete from cart</button> </span>
        <div class="add_to_favorites"><button>+ favorites</button> </div>
        <br>
        <br>
        <br>

    </div><?php endforeach;?>
</div>
</div>
<style>
    h1
    {
        font-size: 2.5rem;
        margin-top: 80px;
        text-align: -webkit-center;
        color: black;
    }

    body
    {
        background-color: rosybrown;
        font-family: Helvetica Neue, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .{
        button{
            width: 50%;
            padding: 12px 0;
            background-color: #BF9860;
            text-align: center;
            color: darkred;
            cursor: pointer;
        }
    }

    .body{
        width: 960px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        margin-top: 60px;

    }
    .a{

    }
    .product_img{
        width: 580px;
    }

    .product_img img{
        width: 85%;
    }


    .product_info{
        width: 260px;
        text-align: justify;
    }

    .product_title{
        font-size: 1.6em;
        color: #233F59;
        padding: 10px;
        text-align: center;
    }
    /*.product_model{
        padding: 10px;
        color: #878686;
        font-size: .8rem;

    }*/
    .product_price{
        padding: 8px;
        color: #615F5F;
        font-size: 1.4rem;
    }
    .product_descr{
        color: saddlebrown;
        padding: 10px;
    }
    .product_color{
        color: lightyellow;
        padding: 10px;
    }

    span{
       button{
           white-space: nowrap;
        width: 50%;
        padding: 3px 0;
        background-color: #BF9860;
        text-align: center;
        color: darkred;
           cursor: pointer;
    }
    }
    /*.add_to_cart:hover{
        background-color: #d8b88a;

    }*/
    .add_to_favorites{
        button{
            width: 50%;
            padding: 2px 0;
            background-color: #BF9860;
            text-align: center;
            color: darkred;
            cursor: pointer;
        }
    }

    .product_quantity {
        color: lightyellow;
        padding: 10px;}

    .product_quantity input[type="number"]{
        border: 1px solid lightgray;
        width: 80px;
        font-size: 1.8em;
        margin: 10px 0;
        padding: 5px;
        text-align:center;
        color: #878686;
        box-sizing: border-box;
    }

    @media(max-width: 960px)
    {
        body{
        //background-color: red;
        }
        .body{
            width: 100%;
        }

    }
    @media (max-width: 640px)
    {
        .product_info{
            width: 100%;
            text-align: center;
        }
    }


</style>

