
<div class="body">
    <div class="product_img">
        <img src="https://static.wixstatic.com/media/1e47b2_3d945b9c0e9643719a8659871818e5f1.jpg/v1/fill/w_580,h_420,q_85,usm_0.66_1.00_0.01/1e47b2_3d945b9c0e9643719a8659871818e5f1.jpg" alt="">
    </div>
    <div class="product_info">
        <div class="seller_info">

        </div>
        <div class="product_title">I'm product</div>
        <div class="product_model">SKU: 21354654
        </div>
        <div class="product_price">$230.00
        </div>
        <div class="product_descr">I'm a product description. I'm a great place to add more details about your product such as sizing, material, care </div>
        <div class="product_color">Color: Black</div>
        <div class="product_color">someone@something.com</div>
        <div class="product_color">+92 308 1234567</div>
        <div class="product_quantity">Quantity:<br>
            <input type="number">
        </div>
        <div class="add_to_cart">Add to cart</div>
    </div>
</div>

<style>

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
    }
    .product_model{
        padding: 10px;
        color: #878686;
        font-size: .8rem;

    }
    .product_price{
        padding: 10px;
        color: #615F5F;
        font-size: 1.8rem;
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

