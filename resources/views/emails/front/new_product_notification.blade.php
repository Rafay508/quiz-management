<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Product Alert!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .email-container {
            background-color: #ffffff;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
        }
        .header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .content {
            margin: 20px 0;
            font-size: 16px;
            color: #555;
        }
        .product-details {
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
        .product-details p {
            margin: 5px 0;
        }
        .cta {
            text-align: center;
            margin: 20px 0;
        }
        .cta a {
            background-color: #4caf50;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">New Product Alert!</div>
        <div class="content">
            Hello,
            <br><br>
            We are excited to announce a new product just for you:
            <div class="product-details">
                <p><strong>Product Name:</strong> {{ $data['product_name'] }}</p>
                <p><strong>Price:</strong> Rs. {{ $data['product_price'] }}</p>
            </div>
            <div class="cta">
                <a href="{{ $data['product_url'] }}" target="_blank">View Product</a>
            </div>
            Thank you for staying with us!
        </div>
    </div>
</body>
</html>
