
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: /login.php");
}

$pdo = new PDO("pgsql:host=postgres; port=5432; dbname=mydb", 'user', 'pass');
$stmt = $pdo->query("SELECT * FROM products");

$products = $stmt->fetchAll();

?>




<div class="title">
    <h1>Catalog </h1>
</div>
<div class="body">

    <div class="product_img">
        <img src="https://c.dns-shop.ru/thumb/st1/fit/500/500/53b59a22a6b67baba9aa87f0003daaa4/2e500f9d78b98f9a80d9e0d6db6142ca82821d99cf73dd7d1a3b771f4e079e2f.jpg.webp" alt="">
    </div>
    <div class="product_info">
        <div class="seller_info">

        </div>
        <div class="product_title">LENOVO</div>

        <div class="product_price"> $230.00
        </div>
        <div class="product_descr">1920x1080, IPS, Intel Celeron N4020, ядра: 2 х 1.1 ГГц, RAM 4 ГБ, SSD 128 ГБ, Intel UHD Graphics 600, Windows 11 Home Single Language </div>
        <!--<div class="product_color">Color: Black</div>-->
        <div class="product_color">dns@dns.com</div>
        <!--<div class="product_color">+92 308 1234567</div>-->
        <div class="product_quantity">Quantity:<br>
            <input type="number">
        </div>
        <div class="add_to_cart">Add to cart</div>
    </div>
</div>

<style>
    h1 {
        font-size: 2.2rem;
        margin-top: 80px;
        text-align: center;
    }
    body
    {
        background-color: #fff;
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
        width: 100%;
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
        color: #615F5F;
        padding: 10px;
    }
    .product_color{
        color: #878686;
        padding: 10px;
    }

    .add_to_cart{
        width: 100%;
        padding: 12px 0;
        background-color: #BF9860;
        text-align: center;
        color: white;
        cursor: pointer;
    }
    .add_to_cart:hover{
        background-color: #d8b88a;

    }
    .product_quantity {
        color: #878686;
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

