<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Order Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.4;
            color: #333;
        }

        h1 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
            text-transform: uppercase;
        }

        p {
            margin-bottom: 20px;
        }

        p strong {
            display: inline-block;
            width: 180px;
            font-weight: bold;
        }

        table {
            border-collapse: collapse;
            margin-bottom: 20px;
            width: 100%;
        }

        th {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            font-weight: bold;
            padding: 10px;
            text-align: left;
        }

        td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        tbody tr:hover {
            background-color: #eaeaea;
        }

        tfoot td {
            background-color: #f5f5f5;
            font-weight: bold;
            padding: 10px;
            text-align: right;
        }

        tfoot td:first-child {
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Order Invoice</h1>
    <p>
        <strong>Store Name:</strong> {{ config('app.name') }}<br>
        <strong>Date of Order Creation:</strong> {{ $order->created_at->format('Y-m-d') }}<br>
        <strong>Invoice Number:</strong> {{ $order->uuid }}<br>
        <strong>Customer Details:</strong><br>
        <strong>Name:</strong> {{ $order->user->name }}<br>
        <strong>Email:</strong> {{ $order->user->email }}<br>
        <strong>Billing Details:</strong><br>
        <strong>Address:</strong> {{ $order->address['billing'] }}<br>
        <strong>Shipping Details:</strong><br>
        <strong>Address:</strong> {{ $order->address['shipping'] }}<br>
        <strong>Payment Details:</strong><br>
        <strong>Type:</strong> {{ $order->payment->type }}<br>
    </p>

    <table>
        <thead>
            <tr>
                <th>UUID</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->getProductsWithQuantityAttribute() as $product)
            <tr>
                <td>{{ $product->uuid }}</td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{config('constants.money.symbol')}}{{ $product->price }}</td>
                <td>{{config('constants.money.symbol')}}{{ $product->price * $product->quantity }}</td>
            </tr>
            @endforeach

            <tr>
                <td colspan="4">Subtotal:</td>
                <td> {{config('constants.money.symbol')}}{{ $order->amount }}</td>
            </tr>
            <tr>
                <td colspan="4">Delivery Fee:</td>
                <td> {{config('constants.money.symbol')}}{{ $order->delivery_fee }}</td>
            </tr>
            <tr>
                <td colspan="4">Total:</td>
                <td> <strong>{{config('constants.money.symbol')}}{{ $order->total }}</strong> </td>
            </tr>
        </tbody>
    </table>

</body>

</html>