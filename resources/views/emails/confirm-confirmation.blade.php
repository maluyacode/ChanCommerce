<!DOCTYPE html>
<html>
    <head>
        <title>Order Confirmation</title>
    </head>
    <body>
        <h1>Please Confirm the Order before Shipping</h1>
        <p>Here are the details:</p>
        <p>Order ID: {{ $order->id }}</p>
        <p>Order Date: {{ $order->created_at }}</p>
        <p>Total: {{ $order->total }}</p>
        <a href={{route('fordelivery',['id' => $order->id])}}>
            <button>Confirm</button>
          </a>
    </body>
</html>