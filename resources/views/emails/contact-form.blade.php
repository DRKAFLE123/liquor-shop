<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Message</title>
</head>

<body style="margin:0;padding:0;background:#111;font-family:Arial,Helvetica,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#111;padding:40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#1a1a1a;border:1px solid #333;border-radius:8px;overflow:hidden;">

                    {{-- Header --}}
                    <tr>
                        <td
                            style="background:linear-gradient(135deg,#1a1a1a,#2a2a2a);padding:30px 40px;border-bottom:2px solid #C8A951;">
                            <h1 style="margin:0;color:#C8A951;font-size:20px;letter-spacing:2px;">
                                📩 NEW CONTACT MESSAGE
                            </h1>
                            <p style="margin:8px 0 0;color:#666;font-size:12px;letter-spacing:1px;">
                                {{ config('app.name') }} — Contact Form
                            </p>
                        </td>
                    </tr>

                    {{-- Sender Info --}}
                    <tr>
                        <td style="padding:30px 40px 10px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding:10px 0;border-bottom:1px solid #222;">
                                        <span
                                            style="color:#888;font-size:11px;text-transform:uppercase;letter-spacing:1px;">From</span><br>
                                        <span
                                            style="color:#fff;font-size:15px;font-weight:bold;">{{ $senderName }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 0;border-bottom:1px solid #222;">
                                        <span
                                            style="color:#888;font-size:11px;text-transform:uppercase;letter-spacing:1px;">Email</span><br>
                                        <a href="mailto:{{ $senderEmail }}"
                                            style="color:#C8A951;font-size:14px;text-decoration:none;">{{ $senderEmail }}</a>
                                    </td>
                                </tr>
                                @if($contactSubject)
                                    <tr>
                                        <td style="padding:10px 0;border-bottom:1px solid #222;">
                                            <span
                                                style="color:#888;font-size:11px;text-transform:uppercase;letter-spacing:1px;">Subject</span><br>
                                            <span style="color:#fff;font-size:14px;">{{ $contactSubject }}</span>
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </td>
                    </tr>

                    {{-- Message Body --}}
                    <tr>
                        <td style="padding:20px 40px 30px;">
                            <p
                                style="color:#888;font-size:11px;text-transform:uppercase;letter-spacing:1px;margin:0 0 10px;">
                                Message</p>
                            <div
                                style="background:#111;border:1px solid #333;border-radius:6px;padding:20px;color:#ccc;font-size:14px;line-height:1.7;white-space:pre-wrap;">
                                {{ $senderMessage }}
                            </div>
                        </td>
                    </tr>

                    {{-- Reply Button --}}
                    <tr>
                        <td align="center" style="padding:0 40px 30px;">
                            <a href="mailto:{{ $senderEmail }}"
                                style="display:inline-block;background:#C8A951;color:#000;font-weight:bold;font-size:13px;letter-spacing:2px;text-transform:uppercase;text-decoration:none;padding:14px 40px;border-radius:4px;">
                                REPLY TO {{ strtoupper($senderName) }}
                            </a>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background:#111;padding:20px 40px;border-top:1px solid #222;">
                            <p style="margin:0;color:#555;font-size:11px;text-align:center;">
                                This email was sent from the contact form on <strong
                                    style="color:#888;">{{ config('app.name') }}</strong><br>
                                <span style="color:#444;">{{ now()->format('F j, Y \\a\\t g:i A') }}</span>
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>