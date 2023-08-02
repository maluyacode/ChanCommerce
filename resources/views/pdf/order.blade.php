<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
</head>

<body>
    <h1>Order Confirmation</h1>
    <p>Order ID: {{ $order->id }}</p>
    <p>Order Date: {{ $order->created_at }}</p>
    @php $total = 0 @endphp
    @foreach ($order->items as $orderItems)
        @php $total +=  $orderItems->sellprice * $orderItems->pivot->quantity @endphp
    @endforeach
    <p>Total: {{ $total }}</p>

    <hr>
    <table style="color:red; justify-content:left; border:1px solid black; padding: 10px; width: 80%; text-align:center">
        <thead>
            <tr>

                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->pivot->quantity }}</td>
                    <td>{{ $item->sellprice }}</td>
                    <td>{{ $item->sellprice * $item->pivot->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>Total: {{ $total }}</p>
</body>
<style>
    .table {
        width: 7cm;
        height: 15cm;
        border: 1px solid;
        page-break-after: always;
        margin: 6cm auto;
    }
</style>

</html>
