
<br>
<br>
<a href="/logout"><button class="btn" type="submit">LOGOUT</button> </a>
<br>
<br>
<a href="/catalog"><button class="btn" type="submit">CATALOG</button> </a>
<div  class="title" >
    <h1>Cart </h1>

</div>
<div style="color: limegreen" class="total">
    <h2>  <?php if (isset($total)): ?>
        <?php echo 'Total cart: ' . '$' . $total;?>
        <?php endif;?>
        <?php //echo 'Total cart: ' . '$' . $allPrice;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
    <a href="/order"><button class="btn" type="submit">PLACE AN ORDER</button> </a>
</div>


<div class="body">
    <?php if(isset($userProducts)): ?>
     <?php foreach ($userProducts as $product):?>
        <div class="product_img">

            <img src="<?php echo $product->getImageLink();?>" alt="">
        </div>
        <div class="product_info">
        <div class="seller_info">

        </div>
        <div class="product_title"><?php echo $product->getTitle(); ?> </div>

        <div class="product_price"> <?php echo '$'.$product->getPrice(); ?>
        </div>
        <div class="product_descr"><?php echo $product->getDescription(); ?> </div>
        <!--<div class="product_color">Color: Black</div>-->
        <div class="product_color">dns@dns.com</div>
        <!--<div class="product_color">+92 308 1234567</div>-->
        <div class="product_quantity">Quantity: <?php echo ' '.$product->getAmount();?>
          | Total &nbsp; <?php //$total = $product['amount']*$product['price']; echo '$'.$total; ?><br>
            <input type="number">
        </div>
            <div class="form">
                <div class="header-form">
                    <span></span>
                </div>
                <form action="/delete-product" method="post">
                    <input type="hidden" id="product-id" name="product_id" value="<?php echo $product->getId() ?? '';?>"  required>
                    <div class="btn">
                        <span><button class="btn">delete</button></span>
                    </div>
                </form>
            </div>
        <br>
        <br>
        <br>

        </div><?php endforeach;?>  <?php  endif;?>

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