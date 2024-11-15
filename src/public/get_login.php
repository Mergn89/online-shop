<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма регистрации</title>

</head>
<body>
<div class="form">
    <div class="header-form">
        <span>LOGIN TO ACCOUNT</span>
    </div>
    <form action="handle_login.php" method="post">


        <label for="email">Email:<span1>*</span1></label>
        <input type="text" placeholder="Enter email" name="email" id="email" required>

        <label for="psw">Password:<span1>*</span1></label>
        <input type="password" placeholder="Enter password" name="psw" id="psw" required>


        <div class="btn">
            <button class="btn">login</button>
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