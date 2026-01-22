# 🔧 SOLUTION: "could not find driver" Error

## Problem Identified

Your local `.env` file is configured for **production (PostgreSQL)**, but your XAMPP installation doesn't have the PostgreSQL PHP extension.

**Error:**
```
could not find driver (Connection: pgsql...)
```

---

## ✅ QUICK FIX: Use MySQL Locally

The easiest solution is to use MySQL for local development and PostgreSQL for production.

### **Step 1: Update `.env` for Local Development**

Edit your `.env` file and change the database settings:

**Change FROM (PostgreSQL - Production):**
```env
DB_CONNECTION=pgsql
DB_HOST=dpg-d5ohbhf5c7fs73d4ah70-a.oregon-postgres.render.com
DB_PORT=5432
DB_DATABASE=shivashinedb
DB_USERNAME=shivashinedb_user
DB_PASSWORD=Xdo2CRpb2C3kzb5yYXdh78scey9VVFI0
```

**Change TO (MySQL - Local):**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shiva_shine
DB_USERNAME=root
DB_PASSWORD=
```

### **Step 2: Create Local Database**

1. Open **phpMyAdmin**: http://localhost/phpmyadmin
2. Click **"New"** in the left sidebar
3. Database name: `shiva_shine`
4. Collation: `utf8mb4_unicode_ci`
5. Click **"Create"**

### **Step 3: Run Migrations**

```bash
php artisan migrate
```

### **Step 4: Seed Admin Account**

```bash
php artisan db:seed --class=AdminSeeder
```

### **Step 5: Clear Cache**

```bash
php artisan config:clear
php artisan cache:clear
```

### **Step 6: Start Server**

```bash
php artisan serve
```

### **Step 7: Test Login**

Visit: http://localhost:8000/admin/login

```
Email: admin@shivashine.com
Password: shivashine@108
```

**Should work now!** ✅

---

## 🎯 Alternative: Install PostgreSQL Extension (Advanced)

If you want to use PostgreSQL locally:

### **For XAMPP on Windows:**

1. **Open `php.ini`:**
   - Location: `C:\xampp\php\php.ini`

2. **Find and uncomment these lines** (remove the `;`):
   ```ini
   ;extension=pdo_pgsql
   ;extension=pgsql
   ```
   
   Change to:
   ```ini
   extension=pdo_pgsql
   extension=pgsql
   ```

3. **Restart Apache** in XAMPP Control Panel

4. **Install PostgreSQL:**
   - Download from: https://www.postgresql.org/download/windows/
   - Install and set up a local database

5. **Update `.env`** with local PostgreSQL credentials

---

## 📋 Recommended Setup

**For Local Development:**
- Use MySQL (already included in XAMPP)
- Database: `shiva_shine`
- User: `root`
- Password: (empty)

**For Production (Render):**
- Use PostgreSQL (configured in `render.yaml`)
- Credentials: Already set in `render.yaml`

This way you don't need to install PostgreSQL locally!

---

## 🔄 Complete Local Setup Commands

```bash
# 1. Make sure .env uses MySQL (see Step 1 above)

# 2. Create database in phpMyAdmin

# 3. Run migrations
php artisan migrate

# 4. Seed admin
php artisan db:seed --class=AdminSeeder

# 5. Clear cache
php artisan config:clear
php artisan cache:clear

# 6. Start server
php artisan serve

# 7. Visit: http://localhost:8000/admin/login
```

---

## ✅ Verification

After changing to MySQL, you should see:

```
Migration table created successfully.
Migrating: [timestamp]_create_admins_table
Migrated:  [timestamp]_create_admins_table

Database seeding completed successfully.
```

Then login will work! 🎉

---

**Last Updated:** 2026-01-23  
**Issue:** PostgreSQL driver not found  
**Solution:** Use MySQL for local development
