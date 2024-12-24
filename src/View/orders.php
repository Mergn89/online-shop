
    <div class="col-25">

        <div class="container">
            <h2>Your order
                <?php $count = 0;?>
                <?php foreach ($products as $product): //$count++;?>
                <span class="price" style="color:black">
          <i class="fa fa-shopping-cart"></i>

                    <?php //endforeach;?>
                    <b><?php //echo $count ?>qty</b>
        </span>
            </h2>
            <?php //$totalPrice = 0;?>

                <?php //$allPrice = 2;?>
            <?php //foreach ($products as $product):?>
                <p><a href="#"><?php echo $product['title'] . "  pcs. : " .$product['order_amount'];?>
                    </a> <span class="price"><?php $allPrice = $product['order_price'] * $product['order_amount'];echo $allPrice . "$"?></span></p>
                <hr>
                <?php //$totalPrice += $allPrice?>
            <?php //endforeach;?>

            <p>Total  <span class="price" style="color:black"><b><?php  //foreach ($orders as $product): ?>
                        <?php //foreach ($orders as $order):?>
                            <?php //echo $order['total'] . "$"?>
                        <?php endforeach;?></b></span></p>
        </div>
        <br>
        <br>
        <a href="/catalog"><button class="btn" type="submit">CATALOG</button> </a>
    </div>
</div>

<style>
    .row {
        display: -ms-flexbox; /* IE10 */
        display: flex;
        -ms-flex-wrap: wrap; /* IE10 */
        flex-wrap: wrap;
        margin: 0 -16px;
    }

    .col-25 {
        -ms-flex: 25%; /* IE10 */
        flex: 25%;
    }

    .col-50 {
        -ms-flex: 50%; /* IE10 */
        flex: 50%;
    }

    .col-75 {
        -ms-flex: 75%; /* IE10 */
        flex: 75%;
    }

    .col-25,
    .col-50,
    .col-75 {
        padding: 0 16px;
    }

    .container {
        background-color: #f2f2f2;
        padding: 5px 20px 15px 20px;
        border: 1px solid lightgrey;
        border-radius: 3px;
    }

    input[type=text] {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    label {
        margin-bottom: 10px;
        display: block;
    }

    .icon-container {
        margin-bottom: 20px;
        padding: 7px 0;
        font-size: 24px;
    }

    .btn {
        background-color: #4CAF50;
        color: white;
        padding: 12px;
        margin: 10px 0;
        border: none;
        width: 100%;
        border-radius: 3px;
        cursor: pointer;
        font-size: 17px;
    }

    .btn:hover {
        background-color: #45a049;
    }

    span.price {
        float: right;
        color: grey;
    }

    /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (and change the direction - make the "cart" column go on top) */
    @media (max-width: 800px) {
        .row {
            flex-direction: column-reverse;
        }
        .col-25 {
            margin-bottom: 20px;
        }
    }
</style>
