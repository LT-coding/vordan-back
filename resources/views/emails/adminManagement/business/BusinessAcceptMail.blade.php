<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Business Verification Accepted</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            .email-container {
                background-color: #ffffff;
                margin: 40px auto;
                padding: 20px;
                border: 1px solid #dddddd;
                border-radius: 8px;
                max-width: 600px;
            }
            .header {
                background-color: #4CAF50;
                color: white;
                padding: 10px;
                text-align: center;
                border-radius: 8px 8px 0 0;
            }
            .content {
                padding: 20px;
            }
            .footer {
                margin-top: 20px;
                text-align: center;
                font-size: 12px;
                color: #888888;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                margin: 20px 0;
                background-color: #4CAF50;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <div class="email-container">
            <div class="header">
                <h1>Business Verification Accepted</h1>
            </div>
            <div class="content">
                <p>Dear {{$name}},</p>
                <p>We are pleased to inform you that your business verification has been successfully accepted. You can now access all the features available to verified businesses on our platform.</p>
                <p>To get started, please click the button below:</p>
                <p><a href="{{$url}}" class="button">Access Your Dashboard</a></p>
                <p>If you have any questions or need assistance, please do not hesitate to contact us.</p>
                <p>Best regards,</p>
                <p>The Vordan Team</p>
            </div>
            <div class="footer">
                <p>&copy; {{$year}} Vordan. All rights reserved.</p>
            </div>
        </div>
    </body>
</html>
