# Shiva Shine - Render Deployment Guide

## 🚀 Quick Deployment Steps

### Method 1: Using render.yaml (Recommended)

Your project is now configured with a complete `render.yaml` file that includes all necessary environment variables.

1. **Commit and Push Changes**
   ```bash
   git add .
   git commit -m "Fix: Configure Render deployment with PostgreSQL credentials"
   git push origin main
   ```

2. **Deploy on Render**
   - Go to [Render Dashboard](https://dashboard.render.com)
   - If this is a new deployment:
     - Click "New +" → "Blueprint"
     - Connect your GitHub repository
     - Render will automatically detect `render.yaml` and configure everything
   - If updating existing deployment:
     - Your service will automatically redeploy when you push to GitHub
     - Or manually trigger a deploy from the Render dashboard

3. **Monitor Deployment**
   - Watch the deployment logs in Render dashboard
   - Look for these success messages:
     - ✓ Storage directories configured
     - ✓ Database credentials verified
     - ✓ Migrations completed successfully
     - ✓ Configuration cached
     - Starting Laravel Application Server

### Method 2: Manual Environment Variables (Alternative)

If you prefer not to use `render.yaml` or need to update variables manually:

1. Go to your Render service dashboard
2. Navigate to **Environment** tab
3. Add/Update these variables:

```env
# Application
APP_NAME=ShivaShine
APP_ENV=production
APP_DEBUG=false
APP_URL=https://shiva-shine-1.onrender.com

# Logging
LOG_CHANNEL=stderr
LOG_LEVEL=debug

# Database (PostgreSQL)
DB_CONNECTION=pgsql
DB_HOST=dpg-d5ohbhf5c7fs73d4ah70-a.oregon-postgres.render.com
DB_PORT=5432
DB_DATABASE=shivashinedb
DB_USERNAME=shivashinedb_user
DB_PASSWORD=Xdo2CRpb2C3kzb5yYXdh78scey9VVFI0

# Session & Cache
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=database

# Mail
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
RAZORPAY_KEY=your_razorpay_key_id
RAZORPAY_SECRET=your_razorpay_secret_key
```

4. Click **Save Changes** - Render will automatically redeploy

---

## 🔍 Verification Steps

After deployment completes:

1. **Check Application Health**
   - Visit: https://shiva-shine-1.onrender.com
   - You should see your application homepage

2. **Verify Database Connection**
   - Check deployment logs for: "✓ Migrations completed successfully"
   - Try accessing a page that queries the database

3. **Test Google OAuth**
   - Try logging in with Google
   - Ensure redirect URL matches: `https://shiva-shine-1.onrender.com/auth/google/callback`

4. **Check Email Functionality**
   - Test any email-sending features
   - Verify emails are being sent through Gmail SMTP

---

## 🐛 Troubleshooting

### Issue: "no password supplied" Error

**Cause:** Environment variables not loaded properly

**Solution:**
1. Verify all environment variables are set in Render dashboard
2. Check deployment logs for "Database credentials verified" message
3. Manually redeploy the service

### Issue: Migration Fails

**Cause:** Database connection issues or missing credentials

**Solution:**
1. Verify PostgreSQL database is running on Render
2. Check database credentials match exactly
3. Ensure database allows connections from Render's IP range
4. Check deployment logs for specific error messages

### Issue: 500 Server Error

**Cause:** Various - check logs for details

**Solution:**
1. Check Render logs: Dashboard → Your Service → Logs
2. Look for PHP errors or stack traces
3. Verify `APP_KEY` is set (should be auto-generated)
4. Ensure all required environment variables are present

### Issue: Google OAuth Not Working

**Cause:** Incorrect redirect URI or credentials

**Solution:**
1. Go to [Google Cloud Console](https://console.cloud.google.com)
2. Navigate to: APIs & Services → Credentials
3. Edit your OAuth 2.0 Client
4. Ensure authorized redirect URIs includes:
   - `https://shiva-shine-1.onrender.com/auth/google/callback`
5. Update `GOOGLE_REDIRECT` environment variable if URL changed

### Issue: Emails Not Sending

**Cause:** Gmail blocking or incorrect credentials

**Solution:**
1. Ensure you're using an App Password (not your Gmail password)
2. Generate App Password: Google Account → Security → 2-Step Verification → App Passwords
3. Update `MAIL_PASSWORD` with the generated app password
4. Verify `MAIL_USERNAME` matches the Gmail account

---

## 📝 Important Notes

### Security Considerations

⚠️ **IMPORTANT:** The `render.yaml` file contains sensitive credentials. Consider these security improvements:

1. **Use Render Environment Groups**
   - Create an environment group in Render dashboard
   - Store sensitive variables there
   - Reference them in `render.yaml` using `sync: false`

2. **Use Render Secrets**
   - For highly sensitive data (passwords, API keys)
   - Set them directly in Render dashboard
   - Remove from `render.yaml`

3. **Update .gitignore**
   - Ensure `render.yaml` is NOT committed if it contains secrets
   - Use a `render.yaml.example` template instead

### Database Backups

- Render Free tier includes automatic daily backups
- Backups retained for 7 days
- Access via: Dashboard → Database → Backups

### Performance Optimization

Current configuration uses:
- File-based sessions (suitable for single-instance deployments)
- File-based cache (fast for small applications)

For better performance at scale:
- Consider Redis for sessions and cache
- Upgrade to Render paid plan for better resources

---

## 🔄 Updating Your Application

1. Make changes to your code locally
2. Test thoroughly
3. Commit and push to GitHub:
   ```bash
   git add .
   git commit -m "Your commit message"
   git push origin main
   ```
4. Render will automatically detect the push and redeploy
5. Monitor deployment logs to ensure success

---

## 📞 Support Resources

- **Render Documentation:** https://render.com/docs
- **Laravel Documentation:** https://laravel.com/docs
- **Render Community:** https://community.render.com

---

## ✅ Deployment Checklist

- [ ] All environment variables configured in `render.yaml`
- [ ] Database credentials verified
- [ ] Google OAuth redirect URI configured
- [ ] Gmail App Password generated and configured
- [ ] Code committed and pushed to GitHub
- [ ] Deployment logs show success messages
- [ ] Application accessible at production URL
- [ ] Database migrations completed
- [ ] Google OAuth login tested
- [ ] Email functionality tested (if applicable)

---

**Last Updated:** 2026-01-22  
**Version:** 1.0
