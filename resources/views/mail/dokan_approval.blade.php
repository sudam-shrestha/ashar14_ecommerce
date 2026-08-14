<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokan Approval Notification</title>
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
            background: linear-gradient(135deg, #0F766E 0%, #0D6B63 100%);
            padding: 30px 40px;
            text-align: center;
            border-bottom: 4px solid #642671;
        }

        .header .icon {
            font-size: 48px;
            margin-bottom: 8px;
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

        .greeting .highlight {
            color: #0F766E;
        }

        .intro-text {
            color: #4B5563;
            margin-bottom: 24px;
            font-size: 15px;
        }

        /* Success Animation Card */
        .success-card {
            background: linear-gradient(135deg, #F0FDF4 0%, #DCFCE7 100%);
            border: 2px solid #86EFAC;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            text-align: center;
        }

        .success-card .check-icon {
            font-size: 48px;
            margin-bottom: 8px;
        }

        .success-card h3 {
            color: #166534;
            font-size: 18px;
            font-weight: 700;
        }

        .success-card p {
            color: #166534;
            font-size: 14px;
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
            color: #0F766E;
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
            color: #0F766E;
            font-weight: 600;
        }

        /* Credentials Box */
        .credentials-box {
            background-color: #FEF3C7;
            border: 1px solid #FDE68A;
            border-radius: 12px;
            padding: 20px 24px;
            margin-bottom: 24px;
        }

        .credentials-box h4 {
            color: #92400E;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .credential-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .credential-row:last-child {
            margin-bottom: 0;
        }

        .credential-label {
            font-weight: 600;
            color: #92400E;
            font-size: 13px;
        }

        .credential-value {
            font-family: 'Courier New', monospace;
            font-size: 14px;
            color: #1F2937;
            font-weight: 600;
            word-break: break-all;
        }

        .credential-value .password-value {
            background: #FFFFFF;
            padding: 2px 12px;
            border-radius: 4px;
            border: 1px solid #FDE68A;
        }

        .copy-btn {
            background: #FFFFFF;
            border: 1px solid #D1D5DB;
            border-radius: 4px;
            padding: 2px 10px;
            font-size: 11px;
            color: #4B5563;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .copy-btn:hover {
            background: #F3F4F6;
            border-color: #9CA3AF;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            background: #D1FAE5;
            color: #065F46;
            padding: 4px 16px;
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
            background-color: #0F766E;
            color: #FFFFFF;
            box-shadow: 0 4px 12px rgba(15, 118, 110, 0.25);
        }

        .btn-primary:hover {
            background-color: #0D6B63;
            box-shadow: 0 6px 16px rgba(15, 118, 110, 0.35);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: transparent;
            color: #0F766E;
            border: 2px solid #0F766E;
        }

        .btn-secondary:hover {
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
            color: #0F766E;
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
            color: #0F766E;
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

            .credential-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }

            .credential-value {
                width: 100%;
                word-break: break-all;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="icon">🎉</div>
            <h1>Welcome to CodeIT Dokan!</h1>
            <p class="subtitle">Your vendor application has been approved</p>
            <span class="badge">✅ Approved</span>
        </div>

        <!-- Content -->
        <div class="content">
            <p class="greeting">Dear <span class="highlight">{{ $dokan->name }}</span>,</p>
            <p class="intro-text">
                We are delighted to inform you that your vendor registration request for
                <strong>CodeIT Dokan</strong> has been <strong style="color: #0F766E;">approved</strong>!
                Your store is now ready to start selling.
            </p>

            <!-- Success Card -->
            <div class="success-card">
                <div class="check-icon">✅</div>
                <h3>Your Dokan is Now Active!</h3>
                <p>You can now start listing products and managing your store.</p>
            </div>

            <!-- Store Information -->
            <div class="info-card">
                <div class="card-title">
                    <span>🏪 Your Store Details</span>
                </div>

                <div class="info-row">
                    <span class="info-label">👤 Vendor Name</span>
                    <span class="info-value"><strong>{{ $dokan->name }}</strong></span>
                </div>

                <div class="info-row">
                    <span class="info-label">📧 Email</span>
                    <span class="info-value">{{ $dokan->email }}</span>
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
                        <span class="status-badge">✅ Active</span>
                    </span>
                </div>
            </div>

            <!-- Login Credentials -->
            <div class="credentials-box">
                <h4>🔑 Your Login Credentials</h4>
                <p style="font-size: 13px; color: #92400E; margin-bottom: 12px;">
                    Use these credentials to access your vendor dashboard.
                    <strong>Please change your password after your first login.</strong>
                </p>

                <div class="credential-row">
                    <span class="credential-label">📧 Email:</span>
                    <span class="credential-value">{{ $dokan->email }}</span>
                </div>

                <div class="credential-row">
                    <span class="credential-label">🔒 Password:</span>
                    <span class="credential-value">
                        <span class="password-value">{{ $password }}</span>
                    </span>
                </div>

                <div
                    style="margin-top: 12px; font-size: 12px; color: #92400E; background: rgba(255,255,255,0.5); padding: 8px 12px; border-radius: 6px;">
                    ⚠️ Please keep your credentials secure and do not share them with anyone.
                </div>
            </div>

            <!-- Quick Actions -->
            <div style="margin-bottom: 8px;">
                <p style="font-weight: 600; color: #1F2937; font-size: 15px; margin-bottom: 12px;">
                    🚀 Get Started
                </p>
                <div class="btn-group">
                    <a href="{{ url('/dokan') }}" class="btn btn-primary">📦 Go to Dashboard</a>
                    <a href="{{ url('/dokan/products') }}" class="btn btn-secondary">➕ Add Products</a>
                </div>
            </div>

            <hr class="divider">

            <!-- Vendor Resources -->
            <div class="footer-notes">
                <h4>📌 Getting Started Guide</h4>
                <ul>
                    <li>Set up your store profile and payment details</li>
                    <li>List your first product and set competitive prices</li>
                    <li>Configure shipping options and delivery zones</li>
                    <li>Explore the vendor dashboard to track orders and analytics</li>
                    <li>Contact support if you need any assistance</li>
                </ul>
            </div>

            <!-- Support Card -->
            <div
                style="margin-top: 16px; background: #EFF6FF; padding: 16px 20px; border-radius: 12px; border-left: 4px solid #0F766E;">
                <p style="font-size: 14px; color: #1F2937; display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 20px;">💬</span>
                    <span>
                        <strong>Need help?</strong> Our support team is available 24/7 to assist you.
                        Contact us at <a href="mailto:support@codeitdokan.com"
                            style="color: #0F766E; text-decoration: none; font-weight: 600;">support@codeitdokan.com</a>
                    </span>
                </p>
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
