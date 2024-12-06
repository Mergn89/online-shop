
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>add product</title>

</head>
<body>
<div class="form">
    <div class="header-form">
        <span>ADD PRODUCT</span>
    </div>
    <form action="/add-product" method="post">


        <label for="product-id">ProductId: <br><label style="color: darkred">
                <?php echo $errors['product_id'] ?? ''; ?>
                <?php echo $add ?? ''; ?></label>

            <input type="text" placeholder="Enter product-id" name="product_id" required>

            <label for="amount">Amount:<span1> <br><label style="color: darkred">
                        <?php echo $errors['amount'] ?? ''; ?>
                    </label></span1></span1></label>
            <input type="text" placeholder="Enter amount" name="amount" required>


            <div class="btn">
                <button class="btn">add</button>
            </div>
    </form>
</div>
</body>
</html>

<style>
    body {font-family: Arial,sans-serif;
        background-color: #e4f0f0;
        padding-top: 100px;
        margin: auto;}
    .form{padding: 0px 30px 0px 30px;
        display: block;
        background-color: darkseagreen;
        margin: auto;
        width: 320px;

        border: 1px solid sandybrown;}
    label{font-size: 12px;
        font-weight: 700;
        color: black}
    input{outline: none;

        margin-top: 15px;
        padding: 10px 130px 10px 11px;
        margin-bottom: 20px;}
    span{color: white;
        background-color: sandybrown;
        padding: 10px 8px;}
    .header-form{margin-bottom: 34px;}
    button{margin-top:20px;
        margin-bottom:30px;
        text-transform: uppercase;
        border: 1px solid transparent;
        outline: none;
        width: 96%;
        color: #fff;
        font-weight: 700;
        padding: 16px 95px 16px 65px;
        border-radius: 5px;
        font-size: 16px;
        background-color: sandybrown;}
    button:hover{border: 1px solid sandybrown;}
    span1{color: #01b3b3;}

</style>