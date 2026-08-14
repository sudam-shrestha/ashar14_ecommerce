<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokan Registration Notification</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #F8F6FA;
            color: #4B5563;
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #FFFFFF;
            border-radius: 16px;
            border: 1px solid #E5E7EB;
            box-shadow: 0 8px 20px rgba(100, 38, 113, 0.12);
            overflow: hidden;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #642671 0%, #54205F 100%);
            padding: 30px 40px;
            text-align: center;
            border-bottom: 4px solid #0F766E;
        }

        .header h1 {
            color: #FFFFFF;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin: 0;
        }

        .header .subtitle {
            color: rgba(255, 255, 255, 0.85);
            font-size: 16px;
            margin-top: 6px;
            font-weight: 300;
        }

        .header .badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            color: #FFFFFF;
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Content */
        .content {
            padding: 40px;
        }

        .greeting {
            font-size: 20px;
            font-weight: 600;
            color: #1F2937;
            margin-bottom: 8px;
        }

        .intro-text {
            color: #4B5563;
            margin-bottom: 24px;
            font-size: 15px;
        }

        /* Info Card */
        .info-card {
            background-color: #F8F6FA;
            border: 1px solid #E5E7EB;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .info-card .card-title {
            font-size: 14px;
            font-weight: 700;
            color: #1F2937;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-card .card-title i {
            color: #642671;
        }

        .info-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #E5E7EB;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #1F2937;
            width: 120px;
            flex-shrink: 0;
            font-size: 14px;
        }

        .info-value {
            color: #4B5563;
            font-size: 14px;
            word-break: break-word;
        }

        .info-value .highlight {
            color: #642671;
            font-weight: 600;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            background: #FEF3C7;
            color: #D97706;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Divider */
        .divider {
            border: none;
            border-top: 1px solid #E5E7EB;
            margin: 24px 0;
        }

        /* Action Buttons */
        .actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin: 24px 0 16px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #642671;
            color: #FFFFFF;
            box-shadow: 0 4px 12px rgba(100, 38, 113, 0.25);
        }

        .btn-primary:hover {
            background-color: #54205F;
            box-shadow: 0 6px 16px rgba(100, 38, 113, 0.35);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: transparent;
            color: #642671;
            border: 2px solid #642671;
        }

        .btn-secondary:hover {
            background-color: #642671;
            color: #FFFFFF;
        }

        .btn-outline {
            background-color: transparent;
            color: #0F766E;
            border: 2px solid #0F766E;
        }

        .btn-outline:hover {
            background-color: #0F766E;
            color: #FFFFFF;
        }

        .btn-group {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-group .btn {
            flex: 1;
            min-width: 140px;
        }

        /* Footer Notes */
        .footer-notes {
            background-color: #F8F6FA;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #E5E7EB;
            margin-top: 24px;
        }

        .footer-notes h4 {
            color: #1F2937;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-notes ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-notes ul li {
            padding: 4px 0;
            font-size: 14px;
            color: #4B5563;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .footer-notes ul li::before {
            content: "•";
            color: #0F766E;
            font-weight: 700;
            font-size: 18px;
            line-height: 1.2;
        }

        /* Footer */
        .footer {
            background-color: #F8F6FA;
            padding: 24px 40px;
            text-align: center;
            border-top: 1px solid #E5E7EB;
        }

        .footer p {
            font-size: 13px;
            color: #6B7280;
            margin: 4px 0;
        }

        .footer .brand {
            color: #642671;
            font-weight: 600;
        }

        .footer .social-links {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin: 12px 0 8px;
        }

        .footer .social-links a {
            color: #6B7280;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .footer .social-links a:hover {
            color: #642671;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .header {
                padding: 20px 24px;
            }

            .header h1 {
                font-size: 22px;
            }

            .content {
                padding: 24px;
            }

            .info-row {
                flex-direction: column;
                padding: 8px 0;
            }

            .info-label {
                width: 100%;
                margin-bottom: 2px;
            }

            .btn-group {
                flex-direction: column;
            }

            .btn-group .btn {
                flex: none;
                width: 100%;
            }

            .footer {
                padding: 20px 24px;
            }
        }

        /* Icons using Unicode/Emoji as fallback */
        .icon-email::before {
            content: "📧 ";
        }

        .icon-user::before {
            content: "👤 ";
        }

        .icon-store::before {
            content: "🏪 ";
        }

        .icon-phone::before {
            content: "📞 ";
        }

        .icon-pan::before {
            content: "📋 ";
        }

        .icon-clock::before {
            content: "⏰ ";
        }

        .icon-check::before {
            content: "✅ ";
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🏪 New Dokan Registration</h1>
            <p class="subtitle">A vendor has requested to join CodeIT Dokan</p>
            <span class="badge">🔔 Pending Review</span>
        </div>

        <!-- Content -->
        <div class="content">
            <p class="greeting">Hello Admin,</p>
            <p class="intro-text">
                A new vendor has submitted a registration request for <strong>CodeIT Dokan</strong>.
                Please review their details below and take appropriate action.
            </p>

            <!-- Vendor Information -->
            <div class="info-card">
                <div class="card-title">
                    <span>📋 Vendor Information</span>
                </div>

                <div class="info-row">
                    <span class="info-label">👤 Full Name</span>
                    <span class="info-value"><strong>{{ $dokan->name }}</strong></span>
                </div>

                <div class="info-row">
                    <span class="info-label">📧 Email</span>
                    <span class="info-value">
                        <a href="mailto:{{ $dokan->email }}" style="color: #642671; text-decoration: none;">
                            {{ $dokan->email }}
                        </a>
                    </span>
                </div>

                <div class="info-row">
                    <span class="info-label">📞 Contact</span>
                    <span class="info-value">{{ $dokan->contact }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">🏪 Dokan Name</span>
                    <span class="info-value"><span class="highlight">{{ $dokan->dokan_name }}</span></span>
                </div>

                <div class="info-row">
                    <span class="info-label">📋 PAN Number</span>
                    <span class="info-value">{{ $dokan->pan_no }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">📊 Status</span>
                    <span class="info-value">
                        <span class="status-badge">⏳ Pending</span>
                    </span>
                </div>

                <div class="info-row">
                    <span class="info-label">📅 Registered</span>
                    <span class="info-value">{{ $dokan->created_at->format('F j, Y \a\t g:i A') }}</span>
                </div>
            </div>

            <!-- Quick Actions -->
            <div style="margin-bottom: 8px;">
                <p style="font-weight: 600; color: #1F2937; font-size: 15px; margin-bottom: 12px;">
                    ⚡ Quick Actions
                </p>
                <div class="btn-group">
                    <a href="{{url("/admin/dokans/$dokan->id/edit")}}" class="btn btn-outline">🔍 View Details</a>
                </div>
            </div>

            <hr class="divider">

            <!-- Admin Notes -->
            <div class="footer-notes">
                <h4>📌 What to do next?</h4>
                <ul>
                    <li>Review the vendor's PAN number and contact details</li>
                    <li>Verify the vendor's identity and business legitimacy</li>
                    <li>Approve or reject the registration request</li>
                    <li>Send a welcome email to the vendor upon approval</li>
                </ul>
            </div>

            <!-- Additional Info -->
            <div
                style="margin-top: 16px; font-size: 13px; color: #6B7280; background: #FEF3C7; padding: 12px 16px; border-radius: 8px; border-left: 4px solid #D97706;">
                <strong>⏰ Reminder:</strong> The vendor is waiting for your response. Please take action within 24
                hours.
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="social-links">
                <a href="#" title="Facebook">📘</a>
                <a href="#" title="Twitter">🐦</a>
                <a href="#" title="Instagram">📸</a>
                <a href="#" title="YouTube">▶️</a>
            </div>
            <p>
                <span class="brand">CodeIT Dokan</span> · Multi-Vendor E-commerce Platform
            </p>
            <p style="font-size: 12px; color: #9CA3AF;">
                This is an automated notification. Please do not reply to this email.
                <br>
                &copy; {{ date('Y') }} CodeIT Dokan. All rights reserved.
            </p>
            <p style="font-size: 11px; color: #9CA3AF; margin-top: 6px;">
                {{ config('app.url') }}
            </p>
        </div>
    </div>
</body>

</html>
