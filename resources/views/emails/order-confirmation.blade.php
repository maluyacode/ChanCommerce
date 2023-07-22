<!DOCTYPE html>
<html>
    <head>
        <title>Order Confirmation</title>
    </head>
    <body>
        <h1>Thank you for your order!</h1>
        <p>Here are the details:</p>
        <p>Order ID: {{ $order->id }}</p>
        <p>Order Date: {{ $order->created_at }}</p>
        <p>Total: {{ $order->total }}</p>
    
    </body>
</html>