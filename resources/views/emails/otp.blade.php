<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Checkout OTP</title>
</head>
<body style="margin:0; padding:0; background:#f4f7fb; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#f4f7fb; padding:40px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" style="background:#ffffff; border-radius:12px; box-shadow:0px 4px 12px rgba(0,0,0,0.08); overflow:hidden;">

                    <!-- Header -->
                    <tr>
                        <td align="center" style="background: linear-gradient(90deg, #4f46e5, #6366f1); padding:20px;">
                            <h1 style="margin:0; color:#ffffff; font-size:22px;">🔐 OTP Verification</h1>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:30px 40px; color:#333333; font-size:16px; line-height:1.6;">
                            <p style="margin:0 0 15px;">Hello,</p>
                            <p style="margin:0 0 20px;">We received a request to verify your checkout. Please use the OTP below to complete your order securely:</p>

                            <div style="text-align:center; margin:30px 0;">
                                <span style="display:inline-block; font-size:28px; font-weight:bold; color:#4f46e5; background:#f3f4ff; padding:15px 40px; border-radius:10px; letter-spacing:4px;">
                                    {{ $otp }}
                                </span>
                            </div>

                            <p style="margin:0 0 15px; text-align:center;">⚠️ This OTP is valid for <strong>5 minutes</strong>.</p>
                            <p style="margin:0 0 15px; text-align:center;">Do not share this code with anyone for your security.</p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f9fafb; text-align:center; padding:20px; font-size:14px; color:#555;">
                            <p style="margin:0;">Thanks for shopping with <strong>Shiva Shine</strong> 🛒</p>
                            <p style="margin:5px 0 0; font-size:12px; color:#999;">If you did not request this OTP, please ignore this email.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
