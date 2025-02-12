
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- google font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Product</title>
    <br>
    <br>
    <a href="/catalog"><button class="btn" type="submit">CATALOG</button> </a>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light main-menu">
    <div class="container">
        <a class="navbar-brand" href="#">
            <!--<img class="Logo-img" src="./img/doctor360_white_150.png" alt=""> -->
            <img class="Logo-img" src="<?php //echo $product->getImageLink();?>"  alt="">
        </a>
    </div>
    </div>
</nav>
<!-- BREADCRUM-PART START -->

<section class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">

                <h3 class="breadcrumb-title">Product</h3>
            </div>
        </div>
    </div>
</section>
<!-- BREADCRUM-PART END -->

<!--DOCTOR PROFILE PART START -->
<section class="doctor-profile py-3">
    <div class="container">

        <div class="row">
            <div class="col-lg-6 profile-box">
                <div class="media d-flex">

                    <img style="width: 140px; height: 140px;" class ="mr-4" src="<?php echo $product->getImageLink();?>" alt="">
                    <div class="media-body flex-grow-1">
                        <h3><?php echo $product->getTitle(); ?></h3>
                        <span>CATALOG - Computers & Components </span>

                        <div class="dent-img d-flex">

                            <p>Notebook</p>
                        </div>
                        <ul>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li> <span><i class="fa fa-star" aria-hidden="true"></i></span></li>
                            <li class="rating">(
                                <?php if(isset($averageRatings[$product->getId()])): ?>
                                <?php echo round($averageRatings[$product->getId()], 1); ?>
                                <?php endif;?>
                                )
                            </li>
                        </ul>
                        <p> <h3> Price: <?php echo '$'.$product->getPrice(); ?></h3></p>



                    </div>

                   <!-- <form action="/rev" method="post">

                        <input type="hidden" id="product_id" name="product_id" value="<?php //echo $product->getId() ?? '';?>"  required>

                        <div class="btn">
                            <span><button style="color: #710e12"  class="btn">Write Review</button></span>
                        </div>
                    </form> -->

                    <!--<a style="color: darkred" href="/review"><button class="btn" type="submit">Write review </a>-->
                </div>
            </div>
        </div>
    </div>
</section>
<!--DOCTOR PROFILE PART END -->

<section class="best-services-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="Services-item">

                    <div class="service-border">
                        <ul class="nav mb-3 text-center overview-service" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-Overview" role="tab" aria-controls="pills-home" aria-selected="true">
                                    <strong class="d-block">Descriptions</strong></a>
                            </li>
                            <!--<li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-Hospital" role="tab" aria-controls="pills-profile" aria-selected="false">
                                    <strong class="d-block">Hospital Name</strong></a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-Reviews" role="tab" aria-controls="pills-contact" aria-selected="false">
                                    <strong class="d-block">Reviews</strong></a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-Overview" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="about-sec">
                                <div class="row">

                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="Review-tab-content">
                                            <h3>About Product</h3>
                                            <p><?php echo $product->getDescription(); ?></p>
                                        </div>

                                    </div>
                                </div>
                            </div></div>



                        <div class="tab-pane fade" id="pills-Reviews" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="widget review-listing pl-3">
                                <ul class="comment-list">
                                    <li>
                                        <div class="comment mb-4">
<!--                                            <img class="avatar avatar-sm rounded-circle" src="./img/patient.9116742.jpg" alt="User Image">-->
                                            <div class="comment-body">
                                                <div class="meta-data">
                                                    <span class="comment-author"><?php if (isset($reviews)): ?>
                                                                                 <?php foreach($reviews as $review): ?></span>
                                                                                 <?php echo $review->getUser()->getName().": ".$review->getReview(). "<br>";?>
                                                                                 <?php endforeach;?>
                                                                                 <?php endif; ?>
                                                </div>
<!--                                                <p class="recommended">-->
<!--                                                    <i class="fa fa-thumbs-up" aria-hidden="true"></i> I recommend the product-->
<!--                                                </p>-->
<!--                                                <p class="recommend-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. Curabitur non nulla sit amet nisl tempus </p>-->

                                            </div>
                                        </div>

                                        <div class="comment">
<!--                                            <img class="avatar avatar-sm rounded-circle" src="./img/patient2.536fd49.jpg" alt="User Image">-->
                                            <div class="comment-body">
                                                <div class="meta-data">
<!--                                                    <span class="comment-author">Richard Wilson</span>-->
<!--                                                    <span class="comment-date">Reviewed 2 days ago</span>-->
<!--                                                    <div class="review-count-rating">-->
<!--                                                        <i class="fa fa-star filled" aria-hidden="true"></i>-->
<!--                                                        <i class="fa fa-star filled" aria-hidden="true"></i>-->
<!--                                                        <i class="fa fa-star filled" aria-hidden="true"></i>-->
<!--                                                        <i class="fa fa-star filled" aria-hidden="true"></i>-->
<!--                                                        <i class="fa fa-star filled" aria-hidden="true"></i>-->
<!--                                                    </div>-->
                                                </div>
<!--                                                <p class="recommended">-->
<!--                                                    <i class="fa fa-thumbs-up" aria-hidden="true"></i> I recommend the doctor-->
<!--                                                </p>-->
<!--                                                <p class="recommend-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. Curabitur non nulla sit amet nisl tempus </p>-->
                                                <div class="comment-reply">
<!--                                                    <a class="comment-btn" href="#">-->
<!--                                                        <i class="fa fa-reply"></i> Reply-->
<!--                                                    </a>-->
<!--                                                    <p class="recommend-btn">-->
<!--                                                        <span>Recommend?</span>-->
<!--                                                        <a class="like-btn" href="#"> <i class="fa fa-thumbs-up"></i>Yes</a>-->
<!--                                                        <a class="dislike-btn" href="#"><i class="fa fa-thumbs-down"></i>No</a>-->
<!--                                                    </p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
<!--                                <div class="feedback-btn text-center">-->
<!--                                    <button class="feedback-btn-style">show all feedback (167)</button>-->
<!--                                </div>-->

                            </div>

<!--                            <form action="/rev" method="post">-->
<!--                            <div class="review-form">-->
<!--                                <h4>Write a review for product</h4>-->
<!--                                <span>Rating</span>-->
<!---->
<!--                                <div class="pro-pop-input">-->
<!--                                    <label> </label>-->
<!---->
<!--                                    <section class="rating-widget rating">-->
<!--                                        <label>-->
<!--                                            <input type="radio" name="rating" value="1" />-->
<!--                                            <span class="icon">★</span>-->
<!--                                        </label>-->
<!--                                        <label>-->
<!--                                            <input type="radio" name="rating" value="2" />-->
<!--                                            <span class="icon">★</span>-->
<!--                                            <span class="icon">★</span>-->
<!--                                        </label>-->
<!--                                        <label>-->
<!--                                            <input type="radio" name="rating" value="3" />-->
<!--                                            <span class="icon">★</span>-->
<!--                                            <span class="icon">★</span>-->
<!--                                            <span class="icon">★</span>-->
<!--                                        </label>-->
<!--                                        <label>-->
<!--                                            <input type="radio" name="rating" value="4" />-->
<!--                                            <span class="icon">★</span>-->
<!--                                            <span class="icon">★</span>-->
<!--                                            <span class="icon">★</span>-->
<!--                                            <span class="icon">★</span>-->
<!--                                        </label>-->
<!--                                        <label>-->
<!--                                            <input type="radio" name="rating" value="5" />-->
<!--                                            <span class="icon">★</span>-->
<!--                                            <span class="icon">★</span>-->
<!--                                            <span class="icon">★</span>-->
<!--                                            <span class="icon">★</span>-->
<!--                                            <span class="icon">★</span>-->
<!--                                        </label>-->
<!--                                    </section>-->
<!--                                    <span class="star-rating-error"></span>-->
<!--                                </div>-->


                            <form action="/review" method="post" >
                                <?php echo $errors['rating'] ?? '';?>
                                <input type="hidden" name="rating" value="" id="rating">
                                <div class="pro-pop-input">
                                    <label>Rating</label>

                                    <section class="rating-widget rating">
                                        <label>
                                            <input type="radio" name="rating" value="1" />
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="rating" value="2" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="rating" value="3" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="rating" value="4" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="rating" value="5" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                    </section>
                                    <span class="star-rating-error"></span>
                                </div>
                                <div class="form-style">

                                        <label for="review">Your review</label><br>
                                    <label style="color: brown">
                                        <?php if(isset($errors['review'])): ?>
                                            <?php print_r($errors['review']);?>
                                        <?php endif?></label>


                                        <textarea placeholder="enter review" name="review" id="review"></textarea>
                                    <span class="error"></span>
                                        <p>100 caracters remaining</p> <br>

<!--                                            <input type="hidden" id="product_id" name="product_id" value="--><?php //echo $product->getId() ?? '';?><!--"  required>-->
                                    <div class="btn"><button style="color: #710e12"  class="btn">Write Review <input type="hidden" name="product_id" value="<?php echo $product->getId() ?? '';?>"></button>
                                    <?php echo $errors['product_id'] ?? '';?>
<!--                                            <div class="btn">-->
<!--                                                <span><button style="color: #710e12"  class="btn">Write Review</button></span>-->
                                            </div>

                                    </form>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</section>


<!-- Optional JavaScript -->
<!-- Popper.js first, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>

<style>

    .rating {
        display: inline-block;
        position: relative;
        height: 50px;
        line-height: 50px;
        font-size: 50px;
    }

    .rating label {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        cursor: pointer;
    }

    .rating label:last-child {
        position: static;
    }

    .rating label:nth-child(1) {
        z-index: 5;
    }

    .rating label:nth-child(2) {
        z-index: 4;
    }

    .rating label:nth-child(3) {
        z-index: 3;
    }

    .rating label:nth-child(4) {
        z-index: 2;
    }

    .rating label:nth-child(5) {
        z-index: 1;
    }

    .rating label input {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .rating label .icon {
        float: left;
        color: transparent;
    }

    .rating label:last-child .icon {
        color: #000;
    }

    .rating:not(:hover) label input:checked ~ .icon,
    .rating:hover label:hover input ~ .icon {
        color: #09f;
    }

    .rating label input:focus:not(:checked) ~ .icon:last-child {
        color: #000;
        text-shadow: 0 0 5px #09f;
    }

    .btn{
        background: #BF9860;
    }
    /* HEADER PART START */
    body,p,span,h1,h2,h3,h4,h5,h6, ul, li,a{
        font-family: 'Poppins', sans-serif;
    }
    body{
        background-color: rosybrown;
        color: #272b41;
    }

    img{
        max-width: 100%;
    }
    .main-menu {
        background: darkred;
        height: 50px;
    }
    .Logo-img {
        height: 40px;
    }
    /* HEADER PART END */

    /* DOCTOR PROFILE PART START */
    .breadcrumb-item + .breadcrumb-item::before {
        color: #fff;
        font-size: 14px;
    }

    .breadcrumb-bar{
        background-color: #15558d;
        padding: 15px 0;
        height: 78px;
    }
    .breadcrum{
        list-style: none;
    }
    .page-breadcrum ol{
        font-size: 12px;
        background: #15558d !important;
    }
    .page-breadcrum ol li {
        color: #fff !important;
        margin-top: -8px;
    }
    .page-breadcrum ol li a{
        text-decoration: none;
        color: #fff;

    }
    .breadcrumb-title {
        color: #fff;
        font-size: 20px;
        font-weight: 700;
        margin: -20px 13px ;
    }


    /* DOCTOR PROFILE PART END */

    /*DOCTOR PROFILE PART START */
    .doctor-profile{
        background-color: #f8f9fa;
    }

    .profile-box {
        padding: 19px;
        margin-bottom: 1.875rem;
        width: 63%;
        margin-right: 26px;
        background: #fff;
        border: 1px solid #f0f0f0;
    }
    .dent-img img{
        width: 19px;
        height: 19px;
        margin-right: 10px;
    }
    .dent-img p{
        font-size: 14px;
        color: #20c0f3;
        margin-bottom: 8px;
    }

    .media-body h3 {
        color: #37517e;
        font-size: 20px;
        margin-bottom: -1px;
    }
    .media-body span{
        margin-top: 8px;
        color: #606060;
        font-size: 14px;

    }
    .media-body ul{
        list-style: none;
        padding-left: 0;
        margin-bottom: 10px;
    }
    .media-body ul li{
        display: inline-block;
        color: #f4c150;
        font-size: 14px;
    }
    .media-body ul li span{
        color: #dedfe0;
    }
    .media-body ul .rating{
        color: #272b41 !important;
    }
    .media-body p{
        font-size: 14px;
    }
    .media-body h5{
        font-size: 14px;
    }

    .media-body a{
        text-decoration: none;
        color: #272b41;
        font-size: 14px;
        margin-top: -10px;
    }
    /*DOCTOR PROFILE PART END */

    /* BEST SERVICES PART START */

    .best-services-section {
        margin-top: -20px;
        margin-left: -23px;
    }
    .service-border{

        margin-bottom: 20px;
    }
    .Services-item{
        border: 1px solid #f0f0f0;
        margin-bottom: 1.875rem;
        background: #fff;
        position: relative;
    }
    .Services-item ul {
        margin-left: 120px;

    }
    .Services-item ul li {
        margin-right: 145px;


    }
    .Services-item ul li>a:hover{

        color: #20c0f3 !important;
        border-bottom: 3px;

    }
    .Service-item ul li a:hover{
        border-bottom: 3px solid #20c0f3;
        color: #20c0f3;
    }
    .Services-item ul li a{
        color: #43465a !important;
        border-bottom: 3px solid #20c0f3;


    }
    .Services-item::before {
        content: "";
        position: absolute;
        top: 41px;
        left: 53px;
        width: 90%;
        height: 1px;
        background-color: #ddd;
    }
    .Review-tab-content{
        padding-left: 20px;
    }
    .Review-tab-content h3{
        font-size: 1.125rem;
    }
    .Review-tab-content p {
        width: 73%;
        text-align: justify;
        font-size: 14px;
    }
    .Education-item{
        padding-left: 20px;
    }


    .deserve-item{}
    .Education-item h3 {
        font-size: 1.125rem;
        margin-bottom: 0;
        font-weight: 400;
        line-height: 1.4;
    }
    .Education-item .deserve-content {
        position: relative;
        padding-left: 50px;
        margin-top: 12px;
    }
    .Education-item .deserve-content::before {
        width: 1px;
        height: 89%;
        background-color: #ddd;
        content: "";
        position: absolute;
        left: 6px;
        top: 9px;

    }
    .Education-item .deserve-content ul{
        list-style: none;


    }

    .Education-item .deserve-content ul li{
        position: relative;

    }
    .Education-item .deserve-content ul li::before {
        content: "";
        position: absolute;
        left: -201px;
        top: 6px;
        width: 12px;
        height: 12px;
        background-color: #fff;
        line-height: 12px;
        text-align: center;
        border: 2px solid #11aee2;
        border-radius: 50%;


    }
    .deserve-content{
        margin-bottom: 0;
    }
    .deserve-content ul li{
        margin-bottom: 0;
    }
    .Education-item .deserve-content ul li strong {
        font-size: 14px;
        margin-left: -153px;
        font-weight: 500;
        margin-bottom: 2px;
    }
    .Education-item .deserve-content ul li p {
        margin-top: 0;
        margin-bottom: -1px;
        font-size: 13px;
    }
    .Year-text{
        color: #20c0f3;
    }
    .text-color{
        color: #272b41 !important;
        font-weight: 500;
    }

    .Education-item .deserve-content h4 {
        font-size: .9375rem
        margin-bottom: 10px;
    }
    .Education-item .deserve-content p {
        color: #606060;
        margin-left: -153px;

        font-size: .9375rem
    }

    .service-list{
        margin-bottom: 30px;
        padding-left: 20px;
    }
    .service-list h4 {
        font-size: 15px;
    }
    .service-list ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .service-list ul li {
        float: left;
        margin: 6px 0;
        padding-left: 25px;
        position: relative;
        width: 33%;
        font-size: 14px;
    }
    .service-list ul li::before {
        color: #ccc;
        content: "\f30b";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        left: 0;
        position: absolute;
    }
    /* BEST SERVICES PART END */
    /* HOSPITAL NAME PART START */
    .hospital-info{
        padding-left: 20px;
        margin-bottom: 20px;
    }
    .hospital-name {
        border: 1px solid #ddd;
        padding: 20px 20px;
    }
    .hospital-name h3{
        font-size: 17px;
    }
    .hospital-name p{
        display: block;
        font-size: 14px;
    }
    .hospital-name a {
        color: #474b5d;
        text-decoration: none;
        font-size: 14px;
    }
    .hospital-name span{
        font-size: 14px;
    }
    .hospital-name ul{
        list-style: none;
        padding-left: 0;
        margin-bottom: 10px;
        margin-left: 0;

    }
    .hospital-name ul li{

        color: #f4c150;
        display: inline-block;
        margin-right: 5px;
        margin-left: 0;
        font-size: 14px;

    }
    .hospital-name ul span{
        color: #606060;
    }

    /* HOSPITAL NAME PART END */

    /* REVIEW PART START */
    .avatar-sm {
        width: 2.5rem;
        height: 2.5rem;
        float: left;
        margin-right: 10px;
    }

    .widget {
        margin-bottom: 30px;
    }
    .recommended {
        color: #28a745;
        font-size: 15px;
        font-weight: 500;

        margin-left: 29px;
    }
    .recommend-text {
        font-size: 12px;
        margin-left: 29px;
    }
    .review-listing{
        border-bottom: 1px solid #f5f7fc;
        margin-top: 20px;
        padding-bottom: 30px;
    }
    .review-listing > ul {
        padding: 0;
        margin: 0;
        list-style: none;
    }
    .review-listing > ul li .comment .comment-body {
        margin-left: 16px;
        width: 100%;
    }
    .review-listing > ul li .comment .comment-body .meta-data {
        position: relative;
        margin-bottom: 10px;
    }
    .review-listing > ul li .comment .comment-body .meta-data span.comment-author {
        font-weight: 600;
        color: #272b41;
        text-transform: capitalize;
    }
    .review-listing > ul li .comment .comment-body .meta-data span.comment-date {
        font-size: 14px;
    }
    .review-listing > ul li .comment .comment-body .meta-data .review-count {
        display: flex;
        position: absolute;
        top: 3px;
        right: 0;
        width: auto;
    }
    .review-count-rating {
        float: right;
        color: #f4c150;
        font-size: 14px;
    }
    .review-listing > ul li .comment .comment-body .meta-data span {
        display: block;
        font-size: 16px;
        color: #757575;
    }
    .rating i.filled {
        color: #f4c150;
    }
    .fa-star::before {
        content: "\f005";
    }



    .review-listing > ul li .comment .comment-body .comment-content {
        color: #757575;
        margin-top: 15px;
        margin-bottom: 15px;
        font-size: 14px;
    }
    .review-listing > ul li .comment .comment-body .comment-reply .comment-btn {
        color: #20c0f3 !important;
        display: inline-block;
        font-weight: 500;
        font-size: 15px;
        text-decoration: none;
        border-bottom: none;
        margin-left: 27px;
    }
    .comment-btn span{
        font-size: 12px;
    }
    .like-btn i{
        color: #c2aaaa;
        margin-right: 3px;
    }
    .dislike-btn i{
        color: #c2aaaa;
        margin-right: 3px;
    }
    .recommend-btn a{
        color: #c2aaaa;
    }
    .review-listing > ul {
        list-style: none;
    }
    .fa-reply::before {
        content: "\f3e5";
    }
    .review-listing .recommend-btn {
        float: right;
        color: #757575;
        font-size: 14px;
        padding: 5px 0;
        margin-bottom: 0;
    }
    .review-listing .recommend-btn {
        color: #757575;
        font-size: 14px;
    }
    .review-listing .recommend-btn a {
        border: 1px solid rgba(128,137,150,.4);
        border-radius: 4px;
        display: inline-block;
        padding: 4px 12px;
        color: #757575;
        margin-left: 3px;
        margin-right: 3px;
        transition: all .3s;
        text-decoration: none;
        font-size: 12px;
    }
    .feedback-btn-style {
        text-align: center;
        margin-left: 315px;
        margin-top: 20px;
        background: #09e5ab;
        border-radius: 4px;
        color: #fff;
        font-size: 12px;
        padding: 4px;
    }

    .review-form {
        padding: 20px;
    }
    .review-form h4{
        font-size: 1.125rem;
        color: #272b41;
        font-weight: 500;
    }
    .review-form span {
        font-size: 14px;
        color: #707070;
    }
    .review-form .star i {
        color: #bbbbbb;
        font-size: 12px;
    }
    .form-style input {
        width: 100%;
        padding: 6px;
        font-size: 13px;
    }
    .form-style label{
        font-size: 12px;
        margin: 10px 0 5px 0;
        display: inline-block;
        margin-bottom: .5rem;
    }
    .form-style textarea {
        width: 100%;
        height: 78px;
    }
    .form-style p{
        font-size: 12px;
        color: #bbbbbb;
    }

    .form-btn {
        background: #09e5ab;
        border-radius: 6px;
        margin-top: 10px;
        color: #fff;
        padding: 7px 15px;
    }
    .custom-checkbox label{
        font-size: 15px;
    }

    /* REVIEW PART END */

</style>
