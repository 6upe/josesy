<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
        }
        .strong {
            font-weight: bold;
            color: #555;
        }
        .message {
            margin-top: 20px;
            padding: 10px;
            background: #f9f9f9;
            border-left: 4px solid #ccc;
        }
        .send-email{
            padding: 10px;
            border-radius: 10px;
            width: 200px;
            text-decoration: none;
            background-color: #333;
            color: white;
            margin-top: 15px;
            margin-bottom: 15px;
            font-weight: bolder;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>New Booking scheduled - <?= esc($preferred_date) ?></h1>
        <p><span class="strong">Name:</span> <?= esc($name) ?></p>
        <p><span class="strong">Email:</span> <?= esc($email) ?></p>
        <p><span class="strong">Interested in:</span> <?= esc($service) ?></p>
        <div class="message">
            <p><span class="strong">Message:</span></p>
            <p><?= nl2br(esc($message)) ?></p>
        </div>
       <br>
        <a class="send-email" href="mailto:<?= esc($email) ?>">Send Email</a>
    </div>
</body>
</html>