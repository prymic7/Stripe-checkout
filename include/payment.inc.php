<?php
require_once '../vendor/stripe/stripe-php/init.php';
require_once 'dbc.inc.php';

$stripe = new \Stripe\StripeClient(STRIPE_SECRET_KEY); 
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $input = file_get_contents('php://input'); 
    $request = json_decode($input);     
} 
 
$checkout_session = $stripe->checkout->sessions->create([  //Nahradime daty z userinfo databaze a nakupniho kosiku
    'line_items' => [[ 
        'price_data' => [ 
            'product_data' => [ 
                'name' => 'Joe Jack', 
                'metadata' => [ 
                    'pro_id' => '34242'
                ] 
            ], 
            'unit_amount' => round(9.99 * 100), 
            'currency' => 'usd', 
        ], 
        'quantity' => 1 
    ]], 
    'mode' => 'payment', 
    'success_url' => 'https://localhost/payment/success.php?session_id={CHECKOUT_SESSION_ID}', 
    'cancel_url' => 'https://localhost/payment/home.php', 
]);

$response;
if($checkout_session)
{
    $response = array('status' => 1, 'sessionId' => $checkout_session->id);
}
else
{
    $response = array('status' => 0);
}
echo json_encode($response); 
 
?>