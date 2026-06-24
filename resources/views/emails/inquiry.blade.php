<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Research Hub Inquiry</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f7fb; font-family:Arial, Helvetica, sans-serif; color:#111827;">
    <table role="presentation" style="width:100%; border-collapse:collapse; background-color:#f4f7fb; padding:24px;">
        <tr>
            <td align="center">
                <table role="presentation" style="max-width:640px; width:100%; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 10px 30px rgba(15, 23, 42, 0.08); border-collapse:collapse;">
                    <tr>
                        <td style="background:linear-gradient(135deg,#0f172a 0%,#1d4ed8 100%); padding:28px 32px; color:#ffffff;">
                            <div style="font-size:12px; letter-spacing:1.5px; text-transform:uppercase; opacity:0.9;">New Research Hub Inquiry</div>
                            <h1 style="margin:8px 0 0; font-size:24px; line-height:1.3;">## New Research Hub inquiry from {{ $data['name'] }}</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:32px;">
                            <p style="margin:0 0 16px; font-size:16px; line-height:1.6; color:#374151;">
                                A new inquiry has arrived from the Research Hub contact form.
                            </p>

                            <table role="presentation" style="width:100%; border-collapse:collapse; margin:0 0 20px;">
                                <tr>
                                    <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; font-weight:bold; color:#111827; width:120px;">Name</td>
                                    <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; color:#374151;">{{ $data['name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; font-weight:bold; color:#111827;">Email</td>
                                    <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; color:#2563eb;"><a href="mailto:{{ $data['email'] }}" style="color:#2563eb; text-decoration:none;">{{ $data['email'] }}</a></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; font-weight:bold; color:#111827;">Phone</td>
                                    <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; color:#374151;">{{ $data['phone'] ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; font-weight:bold; color:#111827;">Service</td>
                                    <td style="padding:10px 0; border-bottom:1px solid #e5e7eb; color:#374151;">{{ $data['service'] }}</td>
                                </tr>
                            </table>

                            <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:16px 18px; margin-top:12px;">
                                <div style="font-weight:bold; color:#111827; margin-bottom:8px;">Message</div>
                                <div style="font-size:15px; line-height:1.7; color:#374151; white-space:pre-wrap;">{{ $data['message'] }}</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
