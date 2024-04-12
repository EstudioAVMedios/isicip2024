<?php

require_once './vendor/autoload.php';
session_start();
\Stripe\Stripe::setApiKey('sk_test_51J4LWkBMZGjmfmnh8ysQYAJfT5aQTb3JgbL04haPKG4alA5xnInHUzV24OtM62XFUJRTsbvxJJsuCMrGeUWu4gOR00o6IAH8pL');
header('Content-Type: application/json');
$precio=$_POST['amount'];
$descripcion=$_POST['product_name'];
$des=$_POST['descripcion'];
$pedido=$_POST['pedido'];
$_SESSION['PEDIDO']=$pedido;
$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [[    
    'price_data' => [
      'currency' => 'eur',
      'product_data' => [
        'name' => $descripcion,
        "description"=>$des ,        
      ],      
      'unit_amount' => $precio * 100,
    ],    
    'quantity' => 1,
  ]], 
  'mode' => 'payment',
  'success_url' => 'https://'.$_SERVER['HTTP_HOST'].'/dashboard/stripe/success.php',
  'cancel_url' => 'https://'.$_SERVER['HTTP_HOST'].'/dashboard/stripe/cancel.html',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);