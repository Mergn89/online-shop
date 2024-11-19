<?php
//try {
//    throw new Exception("Какое-нибудь сообщение об ошибке");
//} catch(Exception $e) {
//    echo $e->getMessage();
//}
if (!isset($_COOKIE['user_id'])) {
    header("location: /get_login.php");
}
?>