#!/bin/bash

# Render Environment Variables - Copy/Paste Helper
# Use this if you need to manually add environment variables to Render Dashboard

echo "=========================================="
echo "  Render Environment Variables Helper    "
echo "=========================================="
echo ""
echo "Copy the variables below and paste them into Render Dashboard:"
echo "Dashboard → Your Service → Environment → Add Environment Variable"
echo ""
echo "=========================================="
echo ""

cat << 'EOF'
# Application Configuration
APP_NAME=ShivaShine
APP_ENV=production
APP_DEBUG=false
APP_URL=https://shiva-shine-1.onrender.com
APP_KEY=base64:FPr4GnTMMdmaDjX8B1XL3wWYCamQirxwZlG3uj8oztI=

# Logging
LOG_CHANNEL=stderr
LOG_LEVEL=debug

# Session & Cache
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=database

# Database (PostgreSQL)
DB_CONNECTION=pgsql
DB_HOST=dpg-d5ohbhf5c7fs73d4ah70-a.oregon-postgres.render.com
DB_PORT=5432
DB_DATABASE=shivashinedb
DB_USERNAME=shivashinedb_user
DB_PASSWORD=Xdo2CRpb2C3kzb5yYXdh78scey9VVFI0

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=hemanglakhadiya49@gmail.com
MAIL_PASSWORD=tstxtowtggisbvle
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=hemanglakhadiya49@gmail.com
MAIL_FROM_NAME=Shiva Shine

# Google OAuth
GOOGLE_CLIENT_ID=951055380094-mp2scurmk4ehu9pb5e9p6tohorpqbsuk.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=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
GOOGLE_REDIRECT=https://shiva-shine-1.onrender.com/auth/google/callback

# Razorpay (Optional - Add your keys when ready)
# RAZORPAY_KEY=your_razorpay_key_id
# RAZORPAY_SECRET=your_razorpay_secret_key
EOF

echo ""
echo "=========================================="
echo ""
echo "Instructions:"
echo "1. Go to: https://dashboard.render.com"
echo "2. Select your service: Shiva-Shine"
echo "3. Click 'Environment' tab"
echo "4. For each variable above:"
echo "   - Click 'Add Environment Variable'"
echo "   - Enter Key (e.g., APP_NAME)"
echo "   - Enter Value (e.g., ShivaShine)"
echo "   - Click 'Save'"
echo "5. After adding all variables, click 'Save Changes'"
echo "6. Service will automatically redeploy"
echo ""
echo "=========================================="
echo ""
echo "Alternative: Use Render Blueprint"
echo ""
echo "If your service was NOT created using Blueprint:"
echo "1. Delete current service (optional - keep as backup)"
echo "2. Click 'New +' → 'Blueprint'"
echo "3. Connect your GitHub repository"
echo "4. Render will auto-configure from render.yaml"
echo ""
echo "=========================================="
