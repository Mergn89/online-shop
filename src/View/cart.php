
<br>
<br>
<a href="/logout"><button class="btn" type="submit">LOGOUT</button> </a>
<div  class="title" >
    <h1>Cart </h1>

</div>
<div style="color: limegreen" class="total">
        <h2>  <?php echo 'Total cart: ' . '$' . $allPrice;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
    <a href="/order"><button class="btn" type="submit">PLACE AN ORDER</button> </a>
</div>


<!--<form class="d-flex">
    <button class="btn btn-outline-dark" type="submit">
        <i class="bi-cart-fill me-1"></i>
        Корзина
        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
    </button>
</form>-->

<div class="body">

    <?php foreach ($userProducts as $product):?>
        <div class="product_img">
            <!--<button type="button" class="btn btn-default btn-lg" v-on:click="showCheckout">
                <span class="glyphicon glyphicon-shopping-cart">{{ cartItemCount}}</span> Корзина
            </button>-->
            <img src="<?php echo $product['product_image_link'];?>" alt="">
        </div>
        <div class="product_info">
        <div class="seller_info">

        </div>
        <div class="product_title"><?php echo $product['product_name']; ?> </div>

        <div class="product_price"> <?php echo '$'.$product['product_price']; ?>
        </div>
        <div class="product_descr"><?php echo $product['product_description']; ?> </div>
        <!--<div class="product_color">Color: Black</div>-->
        <div class="product_color">dns@dns.com</div>
        <!--<div class="product_color">+92 308 1234567</div>-->
        <div class="product_quantity">Quantity: <?php echo ' '.$product['user_products_amount'];?>
            || Total &nbsp; <?php $total = $product['user_products_amount']*$product['product_price']; echo '$'.$total; ?><br>
            <input type="number">
        </div>

        <!--<div class="add_heart">
            <i class="fa fa-heart" aria-hidden="true"></i> like
        </div>-->

        <!--<div class="add_to_cart"><button>Add to cart</button> </div>-->
        <!--<div class="add_to_favorites"><button>+ favorites</button> </div>-->

        <br>
        <br>
        <br>

        </div><?php endforeach;?>

</div>

<style>
    h1
    {
        font-size: 2.5rem;
        margin-top: 80px;
        text-align: -webkit-center;
        color: black;
    }
    .total{
        text-align: right;
    }

    body
    {
        background-color: rosybrown;
        font-family: Helvetica Neue, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .body{
        width: 960px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        margin-top: 60px;

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

    .add_to_cart{
        button{
            width: 100%;
            padding: 12px 0;
            background-color: #BF9860;
            text-align: center;
            color: darkred;
            cursor: pointer;
        }
    }
    .add_to_cart:hover{
        background-color: #d8b88a;

    }
    .add_to_favorites{
        button{
            width: 75%;
            padding: 12px 0;
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