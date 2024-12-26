<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="container">
    <div class="check-icon">
        <i class="fas fa-check-circle"></i>
    </div>
    <h1>Thank you for your order!</h1>
    <p>Your order has been dispatched and will arrive just as fast as the pony can get there!</p>
    <a href="index.php" class="back-button">Back Home</a>
</div>

</body>
<style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .check-icon {
            font-size: 50px;
            color: #F06292;
        }
        h1 {
            margin: 10px 0;
            font-weight: bold;
        }
        p {
            margin: 10px 0;
            color: #555;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #F06292;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .back-button:hover {
            background-color: #F06292;
        }
    </style>
</html>