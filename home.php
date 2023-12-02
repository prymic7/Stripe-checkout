<?php
require 'vendor/autoload.php';
require 'include/dbc.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://js.stripe.com/v3/"></script>
    <title>Document</title>
</head>
<body>
    <div class="objects-to-buy">
        <div class="one-element">
            <div class="image">
                <img src="img/laptop.png" alt="">
            </div>
            <div class="price">
                <p class="price-text">
                    249$
                </p>
            </div>
            <div class="name">
                <p class="name-text">
                    Notebook Lenovo
                </p>
            </div>
            <div class="btn">
                <button class="payButton">Buy</button>
            </div>
        </div>
        <div class="one-element">
            <div class="image">
                <img src="img/mixer.png" alt="">
            </div>
            <div class="price">
                <p class="price-text">
                    69$
                </p>
            </div>
            <div class="name">
                <p class="name-text">
                    Polreichův mixer
                </p>
            </div>
            <div class="btn">
                <button class="payButton">Buy</button>
            </div>
        </div>
        <div class="one-element">
            <div class="image">
                <img src="img/phone.png" alt="">
            </div>
            <div class="price">
                <p class="price-text">
                    399$
                </p>
            </div>
            <div class="name">
                <p class="name-text">
                    Iphone
                </p>
            </div>
            <div class="btn">
                <button class="payButton">Buy</button>
            </div>
        </div>

    </div>
    
</body>
</html>

<style>
    .objects-to-buy
    {
        /* background-color: red; */
        width: 100%;
        height: 200px;
        margin-top: 100px;
        display:flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }

    img
    {
        padding: 0px 25px;
        width: 100px;
        height: 100px;
    }

    .image
    {
        background-color: blue;
    }

    .price
    {
        background-color: green;
        margin: 0px;
        display:flex; justify-content: center; align-items:center
    }

    .name 
    {
        background-color: purple;
        display:flex; justify-content: center; align-items:center
    }

    .btn 
    {
        display:flex; justify-content: center; align-items:center

    }
</style>

<script>
    let stripe = Stripe('<?php echo STRIPE_PUBLISHED_KEY ?>');
    const payBtn = document.querySelector(".payButton");

    payBtn.addEventListener("click", function() {
        createCheckoutSession();
    });


    const createCheckoutSession = function () {
    return fetch("include/payment.inc.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            data: 1,
        }),
        }).then(function (result) {
            return result.json();
        }).then(function(data){
            console.log("stripe:" + stripe);
            console.log("sessionID:" + data.sessionId);
            if (stripe && data.sessionId) {
                stripe.redirectToCheckout({
                    sessionId: data.sessionId,
                }).then(handleResult);
            } else {
                console.error('Stripe object or sessionId not available.');
            }
        })
    };





</script>