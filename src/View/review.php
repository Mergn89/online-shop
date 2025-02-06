
<div class="products-form-popup">
    <h3>Write Review</h3>
    <h3><?php echo $product->getTitle() ?? ''; ?></h3>
    <p>We love to hear from our customers.
        <br>Share your success story with us.</p>
    <form action="/review" method="post" >
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
        <!--<div class="pro-pop-input">
            <label>Review Title</label>
            <input type="text" name="review-title">
            <span class="error"></span>
        </div>-->
        <div class="pro-pop-input">
            <label for="review"> <b>Review</b></label><br>
            <label style="color: brown">
                <?php if(isset($errors['review'])): ?>
                    <?php print_r($errors['review']);?>
                <?php endif?></label>
            <textarea placeholder="enter review" name="review" id="review"></textarea>
            <span class="error"></span>
        </div>

        <!--<label for="email"><b>Email</b></label> <br>
        <label style="color: brown">
            <?php //if(isset($errors['email'])): ?>
                <?php //print_r($errors['email']);?>
            <?php //endif?></label>
        <input type="text" placeholder="Enter email" name="email" id="email" required>-->
        <!--<div class="pro-pop-input">
            <label>Your Name</label>
            <input type="text" name="user_name">
            <span class="error"></span>
        </div>
        <div class="pro-pop-input">
            <label>Product-Id</label>
            <input type="radio" name="product_id" value="<?php //echo $product->getId() ?? '';?>">
            <span class="error"></span>
        </div>-->
        <div id="buttons">
            <div class="pro-pop-input pro-pop-checkout">
                <input type="checkbox" name="real" value="yes"><span>Are you a real person? Check box to confirm.</span>
                <span class="real-error"></span>
            </div>
            <div class="pro-pop-btn">

                <!--<input type="hidden" id="product_id" name="product_id" value="" required>-->
                <?php echo $errors['product_id'] ?? '';?>
                <button><input type="submit" name="product_id" value="<?php echo $product->getId() ?? '';?>"></button>
                <a href="javascript:void(0);" class="no-thanks">No Thanks</a>
            </div>
        </div>
    </form>
</div>

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
    /*  */
    .products-form-popup {
        max-width: 670px;
        margin: 0 auto;
        display: block;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        background-color: #f5f5f5;
    }

    .products-form-popup h3 {
        font-family: 'MyriadProBold', sans-serif;
        font-size: 36px;
        text-align: center;
        padding: 12px 0px 6px;
        background-color: #a6151a;
        width: 100%;
        display: block;
        border-bottom: 1px solid #acacac;
        color: #fff;
        text-transform: uppercase;
        margin: 0;
        line-height: 1.5;
    }

    .products-form-popup p {
        text-align: center;
        font-family: 'MyriadProRegular', sans-serif;
        color: #363636;
        line-height: 1.2;
        padding: 10px 0;
        margin: 0;
        font-size: 22px;
    }

    .products-form-popup form {
        padding: 0 35px 20px;
    }

    .pro-pop-input {
        margin: 0 0 12px 0;
    }

    .pro-pop-input label {
        font-family: 'MyriadProBold', sans-serif;
        font-size: 18px;
        color: #000;
        line-height: 1.5;
        display: block;
    }

    .pro-pop-checkout span {
        font-family: 'MyriadProBold', sans-serif;
        font-size: 18px;
        color: #000;
        line-height: 1.2;
    }

    .pro-pop-input input:not([type="checkbox"]):not([type="radio"]):not([type="submit"]) {
        font-family: 'MyriadProRegular', sans-serif;
        background-color: #fff;
        border: 1px solid #a7a7a7;
        height: 42px;
        width: 100%;
        font-size: 18px;
        text-indent: 10px;
        color: #000;
    }

    .pro-pop-input textarea {
        font-family: 'MyriadProRegular', sans-serif;
        background-color: #fff;
        border: 1px solid #a7a7a7;
        height: 165px;
        width: 100%;
        font-size: 18px;
        text-indent: 10px;
        color: #000;
        max-width: 100%;
        padding: 10px;
    }

    .pro-pop-btn input[type="submit"],
    .pro-pop-btn input[type="button"] {
        font-family: 'MyriadProBold', sans-serif;
        font-size: 24px;
        color: #fff;
        background: #f0000f;
        background: -moz-linear-gradient(top, #f0000f 0%, #710e12 100%);
        background: -webkit-linear-gradient(top, #f0000f 0%, #710e12 100%);
        background: linear-gradient(to bottom, #f0000f 0%, #710e12 100%);
        filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#f0000f', endColorstr='#710e12', GradientType=0);
        border: none;
        padding: 10px 20px;
        border-radius: 12px;
        cursor: pointer;
    }

    .pro-pop-btn input[type="submit"]:hover,
    .pro-pop-btn input[type="button"]:hover {
        background: #710e12;
        background: -moz-linear-gradient(top, #710e12 0%, #f0000f 100%);
        background: -webkit-linear-gradient(top, #710e12 0%, #f0000f 100%);
        background: linear-gradient(to bottom, #710e12 0%, #f0000f 100%);
        filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#710e12', endColorstr='#f0000f', GradientType=0);
    }

    .pro-pop-btn a.no-thanks {
        font-family: 'MyriadProSemibold', sans-serif;
        font-size: 22px;
        color: #555555;
        padding: 12px 23px;
        line-height: 1.5;
        border: 1px solid #c2c2c2;
        border-radius: 12px;
        margin: 0 0 0 5px;
    }

    .pro-pop-btn a.no-thanks:hover,
    .pro-pop-btn a.no-thanks:active,
    .pro-pop-btn a.no-thanks:focus {
        color: #000;
    }

    .pro-pop-btn {
        margin: 30px 0px 0px 0px;
    }

    .products-form-popup>a {
        color: #666;
        font-size: 20px;
        position: absolute;
        right: 10px;
    }

    .products-form-popup {
        position: relative;
    }

</style>