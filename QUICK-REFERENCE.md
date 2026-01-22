# 🚀 Quick Deployment Reference

## Pre-Deployment Checklist

```bash
# 1. Verify all files are ready
bash verify-deployment.sh

# 2. Ensure all changes are committed
git status
git add .
git commit -m "Ready for deployment"

# 3. Push to GitHub (triggers auto-deploy on Render)
git push origin main
```

## Common Git Commands

```bash
# Check status
git status

# Stage all changes
git add .

# Commit changes
git commit -m "Your commit message"

# Push to GitHub
git push origin main

# View commit history
git log --oneline -10

# Undo last commit (keep changes)
git reset --soft HEAD~1
```

## Render Dashboard Quick Links

- **Dashboard:** https://dashboard.render.com
- **Your Service:** https://dashboard.render.com/web/shiva-shine-1
- **Logs:** Dashboard → Your Service → Logs
- **Environment:** Dashboard → Your Service → Environment
- **Manual Deploy:** Dashboard → Your Service → Manual Deploy

## Environment Variables (Render Dashboard)

To update environment variables:
1. Go to Dashboard → Your Service → Environment
2. Add/Edit variables
3. Click "Save Changes"
4. Service will auto-redeploy

## Monitoring Deployment

```bash
# Watch deployment in real-time
# Go to: Dashboard → Your Service → Logs
# Look for these success indicators:
# ✓ Storage directories configured
# ✓ Database credentials verified
# ✓ Migrations completed successfully
# ✓ Configuration cached
# Starting Laravel Application Server
```

## Troubleshooting Commands

### If deployment fails:

1. **Check Logs**
   - Render Dashboard → Logs
   - Look for error messages

2. **Verify Environment Variables**
   - Render Dashboard → Environment
   - Ensure all required vars are set

3. **Manual Redeploy**
   - Render Dashboard → Manual Deploy → Deploy latest commit

4. **Clear Render Build Cache**
   - Render Dashboard → Settings → Clear build cache

### Local Testing

```bash
# Test Docker build locally
docker build -t shiva-shine .

# Run container locally
docker run -p 10000:10000 \
  -e DB_CONNECTION=pgsql \
  -e DB_HOST=your-host \
  -e DB_DATABASE=your-db \
  -e DB_USERNAME=your-user \
  -e DB_PASSWORD=your-pass \
  shiva-shine

# Test entrypoint script
bash docker-entrypoint.sh
```

## Database Management

### Run migrations on Render:
```bash
# Via Render Shell (Dashboard → Shell)
php artisan migrate --force

# Rollback last migration
php artisan migrate:rollback --step=1 --force

# Fresh migration (⚠️ DELETES ALL DATA)
php artisan migrate:fresh --force
```

### Database backup:
- Render Dashboard → Database → Backups
- Download latest backup
- Backups retained for 7 days (free tier)

## Cache Management

```bash
# Via Render Shell
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Rebuild cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Application URLs

- **Production:** https://shiva-shine-1.onrender.com
- **Health Check:** https://shiva-shine-1.onrender.com/
- **Admin Panel:** https://shiva-shine-1.onrender.com/admin
- **Google OAuth Callback:** https://shiva-shine-1.onrender.com/auth/google/callback

## Important Files

| File | Purpose |
|------|---------|
| `render.yaml` | Render deployment configuration |
| `Dockerfile` | Docker container configuration |
| `docker-entrypoint.sh` | Startup script for deployment |
| `.env.example` | Environment variables template |
| `DEPLOYMENT.md` | Full deployment guide |
| `verify-deployment.sh` | Pre-deployment verification |

## Emergency Rollback

```bash
# 1. Find previous working commit
git log --oneline

# 2. Revert to that commit
git revert <commit-hash>

# 3. Push to trigger redeploy
git push origin main

# OR force push previous commit (⚠️ USE WITH CAUTION)
git reset --hard <commit-hash>
git push --force origin main
```

## Performance Optimization

### Enable caching (production):
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Optimize Composer autoload:
```bash
composer install --optimize-autoloader --no-dev
```

### Build assets for production:
```bash
npm run build
```

## Security Reminders

- ✅ Never commit `.env` file
- ✅ Use App Passwords for Gmail (not account password)
- ✅ Rotate credentials regularly
- ✅ Keep `render.yaml` secure (contains credentials)
- ✅ Use HTTPS only in production
- ✅ Enable 2FA on all service accounts

## Support Resources

- **Render Docs:** https://render.com/docs
- **Laravel Docs:** https://laravel.com/docs
- **Render Community:** https://community.render.com
- **Render Status:** https://status.render.com

## Quick Fixes

### "No password supplied" error:
```bash
# Verify DB_PASSWORD is set in Render Environment
# Redeploy service
```

### "500 Server Error":
```bash
# Check Render logs for specific error
# Verify APP_KEY is set
# Clear all caches
```

### "Migration failed":
```bash
# Verify database credentials
# Check database is accessible
# Run: php artisan db:show
```

### Google OAuth not working:
```bash
# Verify redirect URI in Google Console
# Check GOOGLE_CLIENT_ID and GOOGLE_CLIENT_SECRET
# Ensure GOOGLE_REDIRECT matches exactly
```

---

**💡 Tip:** Bookmark this page for quick reference during deployments!

**Last Updated:** 2026-01-22
