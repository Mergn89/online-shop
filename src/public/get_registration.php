<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма регистрации</title>

</head>
<body>
<div class="form">
    <div class="header-form">
        <span>CREATE AN ACCOUNT</span>
    </div>
    <form action="handle_registration.php" method="post">

        <label for="name"><b>Name</b></label> <br>
        <label style="color: brown">
            <?php if(isset($errors['name'])): ?>
                <?php print_r($errors['name']);?>
            <?php endif?> </label>
        <?php // <?php print_r($errors['name']) ?? '' ?>
        <input type="text" placeholder="Enter name" name="name" id="name" required>

        <label for="email"><b>Email</b></label> <br>
        <label style="color: brown">
            <?php if(isset($errors['email'])): ?>
                <?php print_r($errors['email']);?>
            <?php endif?></label>
        <input type="text" placeholder="Enter email" name="email" id="email" required>

        <label for="psw"><b>Password</b></label> <br>
        <label style="color: brown">
            <?php if(isset($errors['psw'])): ?>
                <?php print_r($errors['psw']);?>
            <?php endif?></label>
        <input type="password" placeholder="Enter password" name="psw" id="psw" required>

        <label for="psw-repeat"><b>Confirm Password</b></label> <br>
        <label style="color: brown">
            <?php if(isset($errors['psw-repeat'])): ?>
                <?php print_r($errors['psw-repeat']);?>
            <?php endif?></label>
        <input type="password" placeholder="Confirm password" name="psw-repeat" id="psw-repeat" required>

        <div class="btn">
            <button class="btn">register now!</button>
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
        background-color: #f9fcfc;
        margin: auto;
        width: 320px;

        border: 1px solid #cfdede;}
    label{font-size: 12px;
        font-weight: 700;
        color: #333333}
    input{outline: none;

        margin-top: 15px;
        padding: 10px 130px 10px 11px;
        margin-bottom: 20px;}
    span{color: white;
        background-color: #01b3b3;
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
        background-color: #01bdbd;}
    button:hover{border: 1px solid #0f7878;}
    span1{color: #01b3b3;}

</style>
