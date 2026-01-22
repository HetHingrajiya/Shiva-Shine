# 🔧 Troubleshooting: "Database credentials are incomplete!" Error

## Error Message

```
❌ ERROR: Database credentials are incomplete!
   Missing environment variables:
   - DB_HOST
   - DB_DATABASE
   - DB_USERNAME
   - DB_PASSWORD
```

## Root Cause

This error occurs when Render is **not loading environment variables** from your `render.yaml` file or the Render dashboard. This can happen for several reasons.

---

## Solution 1: Verify Render.yaml is Being Used (Most Common)

### Check if you deployed using Blueprint

1. **Go to Render Dashboard:** https://dashboard.render.com
2. **Check how your service was created:**
   - If created via "New Web Service" → Environment variables from `render.yaml` are **NOT** loaded
   - If created via "New Blueprint" → Environment variables from `render.yaml` **ARE** loaded

### If NOT using Blueprint:

**Option A: Recreate using Blueprint (Recommended)**

1. Delete current service (or keep it as backup)
2. Click **"New +"** → **"Blueprint"**
3. Connect your GitHub repository
4. Render will detect `render.yaml` and configure everything automatically

**Option B: Add Environment Variables Manually**

1. Go to your service in Render Dashboard
2. Click **"Environment"** tab
3. Add each variable manually:

```
APP_NAME=ShivaShine
APP_ENV=production
APP_DEBUG=false
APP_URL=https://shiva-shine-1.onrender.com
APP_KEY=base64:FPr4GnTMMdmaDjX8B1XL3wWYCamQirxwZlG3uj8oztI=
LOG_CHANNEL=stderr
LOG_LEVEL=debug
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=database
DB_CONNECTION=pgsql
DB_HOST=dpg-d5ohbhf5c7fs73d4ah70-a.oregon-postgres.render.com
DB_PORT=5432
DB_DATABASE=shivashinedb
DB_USERNAME=shivashinedb_user
DB_PASSWORD=Xdo2CRpb2C3kzb5yYXdh78scey9VVFI0
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=hemanglakhadiya49@gmail.com
MAIL_PASSWORD=tstxtowtggisbvle
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=hemanglakhadiya49@gmail.com
MAIL_FROM_NAME=Shiva Shine
GOOGLE_CLIENT_ID=951055380094-mp2scurmk4ehu9pb5e9p6tohorpqbsuk.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=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
GOOGLE_REDIRECT=https://shiva-shine-1.onrender.com/auth/google/callback
```

4. Click **"Save Changes"**
5. Service will automatically redeploy

---

## Solution 2: Check render.yaml Syntax

### Verify YAML formatting

1. Open `render.yaml` in your editor
2. Check for:
   - Proper indentation (use spaces, not tabs)
   - No extra spaces after values
   - Quotes around special characters if needed

### Validate YAML online

1. Copy your `render.yaml` content
2. Go to: https://www.yamllint.com/
3. Paste and check for errors
4. Fix any syntax issues

---

## Solution 3: Verify Database Credentials

### Check if database exists

1. Go to Render Dashboard
2. Navigate to **"Databases"**
3. Find your PostgreSQL database
4. Verify the connection details match your `render.yaml`:
   - Host: `dpg-d5ohbhf5c7fs73d4ah70-a.oregon-postgres.render.com`
   - Database: `shivashinedb`
   - Username: `shivashinedb_user`

### Get fresh credentials

If database credentials changed:

1. In Render Dashboard → Your Database
2. Click **"Info"** tab
3. Copy the connection details:
   - **Internal Database URL** or individual fields
4. Update `render.yaml` or environment variables

---

## Solution 4: Check Deployment Logs

### View detailed error information

1. Go to Render Dashboard → Your Service
2. Click **"Logs"** tab
3. Look for the startup logs
4. The improved error message will show exactly which variables are missing:

```
Missing environment variables:
  - DB_HOST
  - DB_DATABASE
  - DB_USERNAME
  - DB_PASSWORD

Current values:
  DB_HOST=[NOT SET]
  DB_DATABASE=[NOT SET]
  DB_USERNAME=[NOT SET]
  DB_PASSWORD=[NOT SET]
```

---

## Solution 5: Force Environment Variable Reload

### Clear and redeploy

1. **Clear build cache:**
   - Render Dashboard → Your Service → Settings
   - Scroll to "Build & Deploy"
   - Click **"Clear build cache"**

2. **Manual redeploy:**
   - Render Dashboard → Your Service
   - Click **"Manual Deploy"** → **"Deploy latest commit"**

3. **Or push a new commit:**
   ```bash
   git commit --allow-empty -m "Force redeploy"
   git push origin main
   ```

---

## Solution 6: Use Environment Groups (Advanced)

### For better organization

1. **Create Environment Group:**
   - Render Dashboard → Environment Groups
   - Click **"New Environment Group"**
   - Name it: `shiva-shine-production`

2. **Add all environment variables to the group**

3. **Link to your service:**
   - Your Service → Environment
   - Click **"Add from Environment Group"**
   - Select `shiva-shine-production`

4. **Update render.yaml** to reference the group:
   ```yaml
   services:
     - type: web
       name: Shiva-Shine
       envVars:
         - fromGroup: shiva-shine-production
   ```

---

## Verification Steps

After applying any solution:

### 1. Check deployment logs for success

Look for these messages:
```
✓ Storage directories configured
✓ .env file generated
✓ Database credentials verified
✓ Caches cleared
✓ Migrations completed successfully
```

### 2. Verify environment variables are loaded

In Render Shell (Dashboard → Shell):
```bash
echo $DB_HOST
echo $DB_DATABASE
echo $DB_USERNAME
# Should print the actual values, not empty
```

### 3. Test database connection

```bash
php artisan db:show
# Should display database connection info
```

### 4. Access your application

Visit: https://shiva-shine-1.onrender.com

---

## Quick Diagnosis Checklist

- [ ] Service created using "Blueprint" (not "New Web Service")
- [ ] `render.yaml` exists in repository root
- [ ] `render.yaml` has valid YAML syntax
- [ ] Database exists and is accessible
- [ ] Database credentials in `render.yaml` match actual database
- [ ] Environment variables visible in Render Dashboard → Environment tab
- [ ] Latest code pushed to GitHub
- [ ] Service redeployed after changes

---

## Still Not Working?

### Debug mode: Add to docker-entrypoint.sh

Temporarily add this after line 6 to see all environment variables:

```bash
echo "=== ALL ENVIRONMENT VARIABLES ==="
env | grep -E "DB_|APP_|MAIL_|GOOGLE_" | sort
echo "================================="
```

This will show you exactly what Render is passing to your container.

### Contact Support

If none of the above works:

1. **Render Support:** https://render.com/support
2. **Render Community:** https://community.render.com
3. **Check Render Status:** https://status.render.com

Provide them with:
- Your service name
- Deployment logs
- `render.yaml` content (remove sensitive data)
- Screenshot of Environment tab

---

## Prevention

### Best Practices

1. **Always use Blueprint deployment** for services with `render.yaml`
2. **Test locally first** using Docker:
   ```bash
   docker build -t shiva-shine .
   docker run -p 10000:10000 --env-file .env shiva-shine
   ```
3. **Keep render.yaml.example** as a template without sensitive data
4. **Document all required environment variables** in DEPLOYMENT.md
5. **Use environment groups** for shared configurations

---

**Last Updated:** 2026-01-22  
**Related:** [DEPLOYMENT.md](./DEPLOYMENT.md), [QUICK-REFERENCE.md](./QUICK-REFERENCE.md)
