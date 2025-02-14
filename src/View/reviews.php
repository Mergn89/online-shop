
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/css/mdb.min.css">
    <link rel="stylesheet" href="./style.css">

</head>
<body class="hm-gradient">

<main>

    <!--MDB Tables-->
    <div class="container mt-4">
        <br>
        <br>
        <a href="/catalog"><button class="btn" style="background: brown" type="submit">CATALOG</button> </a>
        <div class="text-center darken-grey-text mb-4">
            <h1 class="font-bold mt-4 mb-3 h1"><b>Reviews ! </b></h1>
            <br>

        </div>

        <?php //$count = 0;?>
        <?php if (isset($reviews)): ?>
        <?php foreach ($reviews as $review): ?>

        <div class="card mb-3">
            <div class="card-body">
                <!--Table-->
                <table class="table table-hover">
                    <!--Table head-->
                    <thead class="mdb-color darken-3">
                    <tr class="text-white">
                        <th>#</th>
                        <th>Product</th>
                        <th>Pricing</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Rating</th>
                        <th>ProductId</th>

                    </tr>
                    </thead>
                    <!--Table head-->
                    <!--Table body-->
                    <tbody>

                    <tr>
                        <th scope="row"><?php //echo $orderProduct->getId();?></th>
                        <td><?php echo $review->getProduct()->getTitle();?></td>
                        <td>$<?php echo $review->getProduct()->getPrice();?></td>
                        <td><?php echo $review->getCreated();?></td>
                        <td><?php echo $review->getUser()->getName();?></td>
                        <td><?php echo $review->getRating();?></td>
                        <td><?php echo $review->getProductId();?></td>

                    </tr>
                    <?php //endforeach;?>

                    </tbody>
                    Review: <?php echo $review->getReview();?>

                    <?php endforeach;?>
                    <?php endif;?>
                    <!--Table body-->
                </table>
                <!--Table-->
            </div>
        </div>
        <hr class="my-4">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <br><br>
        <br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
    <!--MDB Tables-->

</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/js/mdb.min.js"></script>
<script src="./script.js"></script>
</body>
</html>

<style>

    .hm-gradient {
        background: #DBE6F6;
        background: -webkit-linear-gradient(to bottom, #C5796D, #DBE6F6);
        background: linear-gradient(to bottom, #C5796D, #DBE6F6);

    }
    .darken-grey-text {
        color: #2E2E2E;
    }
    .input-group.md-form.form-sm.form-2 input {
        border: 1px solid #bdbdbd;
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }
    .input-group.md-form.form-sm.form-2 input.purple-border {
        border: 1px solid #9e9e9e;
    }
    .input-group.md-form.form-sm.form-2 input[type=text]:focus:not([readonly]).purple-border {
        border: 1px solid #ba68c8;
        box-shadow: none;
    }
    .form-2 .input-group-addon {
        border: 1px solid #ba68c8;
    }
    .danger-text {
        color: #ff3547;
    }
    .success-text {
        color: #00C851;
    }
    .table-bordered.red-border, .table-bordered.red-border th, .table-bordered.red-border td {
        border: 1px solid #ff3547!important;
    }
    .table.table-bordered th {
        text-align: center;
    }

</style>
