<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous">
</script>

<div class="title" xmlns="http://www.w3.org/1999/html">
    <h1>Catalog </h1>

    <a href="/logout"><button class="btn" type="submit">LOGOUT</button> </a>

    <br>
    <br>
    <a href="/cart"><button class="btn" type="submit">CART</button> </a>

    <a href="/reviews"> <button class="btn-rev"  type="submit">REVIEWS</button></a>
    <br>
    <br>
    <a href="/orders"><button class="btn-ord"  type="submit">ORDERS</button> </a>
    <span class="cart">
  <svg height="512pt" viewBox="0 -31 512.00026 512" width="512pt" xmlns="http://www.w3.org/2000/svg"><path d="m164.960938 300.003906h.023437c.019531 0 .039063-.003906.058594-.003906h271.957031c6.695312 0 12.582031-4.441406 14.421875-10.878906l60-210c1.292969-4.527344.386719-9.394532-2.445313-13.152344-2.835937-3.757812-7.269531-5.96875-11.976562-5.96875h-366.632812l-10.722657-48.253906c-1.527343-6.863282-7.613281-11.746094-14.644531-11.746094h-90c-8.285156 0-15 6.714844-15 15s6.714844 15 15 15h77.96875c1.898438 8.550781 51.3125 230.917969 54.15625 243.710938-15.941406 6.929687-27.125 22.824218-27.125 41.289062 0 24.8125 20.1875 45 45 45h272c8.285156 0 15-6.714844 15-15s-6.714844-15-15-15h-272c-8.269531 0-15-6.730469-15-15 0-8.257812 6.707031-14.976562 14.960938-14.996094zm312.152343-210.003906-51.429687 180h-248.652344l-40-180zm0 0"/><path d="m150 405c0 24.8125 20.1875 45 45 45s45-20.1875 45-45-20.1875-45-45-45-45 20.1875-45 45zm45-15c8.269531 0 15 6.730469 15 15s-6.730469 15-15 15-15-6.730469-15-15 6.730469-15 15-15zm0 0"/><path d="m362 405c0 24.8125 20.1875 45 45 45s45-20.1875 45-45-20.1875-45-45-45-45 20.1875-45 45zm45-15c8.269531 0 15 6.730469 15 15s-6.730469 15-15 15-15-6.730469-15-15 6.730469-15 15-15zm0 0"/></svg>
  <span class="cart_count"><?php //if (isset($) && !empty($totalAmount)): ?>
          <?php  echo $sumAmount->getTotalAmount() ?? '0' ;?>
      <?php //endif;?>
       </span>
    </span>

    <div class="body">
        <?php foreach ($products as $product):?>
            <div class="product_img">

                <img src="<?php echo $product->getImageLink();?>" alt="">
            </div>
            <div class="product_info">
            <div class="seller_info">

            </div>
            <div class="product_title"><?php echo $product->getTitle(); ?></div>

            <div class="product_price"> <?php echo '$'.$product->getPrice(); ?>
            </div>
            <div class="product_descr"><?php echo $product->getDescription(); ?> </div>
            <!--<div class="product_color">Color: Black</div>-->
            <div class="product_color">dns@dns.com</div>
            <!--<div class="product_color">+92 308 1234567</div>-->
            <div class="product_quantity">Quantity:<br>
                <input type="number">
            </div>

            <body>
            <div class="form">
                <div class="header-form">
                    <span></span>
                </div>
                <form class="add" onsubmit="return false" method="post">
                    <!--action="/add-product"-->
                    <input type="hidden" placeholder="Enter product-id" value="<?php echo $product->getId() ?? '';?>" name="product_id" required>

                    <label for="amount">Amount:<span> <br><label style="color: darkred">
                                <?php echo $errors['amount'] ?? ''; ?>
                                <?php //echo $add ?? ''; ?>
                            </label></span></label>
                    <input type="text" placeholder="Enter amount" name="amount" required>

                    <div class="btn">
                        <button class="btn">add</button>
                    </div>
                </form>

            </div>
            </body>
            </html>

            <div class="form">
                <div class="header-form">
                    <span></span>
                </div>
                <form action="/product" method="post">
                    <input type="hidden" id="product-id" name="product_id" value="<?php echo $product->getId() ?? '';?>"  required>
                    <div class="btn">
                        <span><button class="btn">details</button></span>
                    </div>
                </form>
            </div>
            <br>
            <br>
            <br>
            </div><?php endforeach;?>
    </div>
</div>
<script> $("document").ready(function () {
        $('.add').submit(function () {
            $.ajax({
                type: "POST",
                url: "/add-product",
                data: $(this).serialize(),
                dataType: "json",
                success: function (response) {
                    // Обновляем количество товаров в бейдже корзины
                    if(response.success) {
                        $('.cart_count').text(response.totalAmount);
                    } else {
                        console.error('Ошибка при добавлении товара');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Ошибка при добавлении товара:', error);
                }
            });
        });
    }); </script>
<style>

    body {
        padding: 50px;
    }

    .cart {
        position: relative;
        display: block;
        width: 30px;
        height: 30px;
    }

    .cart svg {
        width: 100%;
        height: 100%;
    }

    .cart_count {
        position: absolute;
        right: -10px;
        top: -10px;
        display: inline-block;
        padding: 2px 7px;
        color: #fff;
        background-color: crimson;
        border-radius: 100%;
    }

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
.btn-rev{
    padding-right: 10px;
    float: right;
}
.btn-ord{
    padding-right: 10px;
    float: right;
}
</style>