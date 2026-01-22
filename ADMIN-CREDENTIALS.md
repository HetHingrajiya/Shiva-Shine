# 🔐 Admin Credentials

## Default Admin Account

The admin account is automatically created during deployment via the `AdminSeeder`.

### **Login Credentials:**

```
Email:    admin@shivashine.com
Password: shivashine@108
```

---

## 🌐 Admin Login URLs

### **Production (Render):**
```
https://shiva-shine-1.onrender.com/admin/login
```

**Shortcut:**
```
https://shiva-shine-1.onrender.com/het@shivashine
```

### **Local Development:**
```
http://localhost:8000/admin/login
```

**Shortcut:**
```
http://localhost:8000/het@shivashine
```

---

## 📋 Admin Features

After logging in, you'll have access to:

- **Dashboard** - Analytics and overview
- **Products** - Manage jewelry products
- **Categories** - Manage product categories
- **Orders** - View and manage customer orders
- **Customers** - View customer information
- **Settings** - System configuration

---

## 🔄 How Admin Account is Created

### **Automatic (Recommended):**

The admin account is automatically created during deployment:

1. **Migrations run** - Creates `admins` table
2. **Seeder runs** - Inserts admin user
3. **Credentials displayed** in deployment logs

### **Manual (If Needed):**

If you need to manually create the admin account:

```bash
php artisan db:seed --class=AdminSeeder
```

Or seed all:
```bash
php artisan db:seed
```

---

## 🔒 Change Admin Password

### **Option 1: Update Seeder (for fresh installations)**

Edit `database/seeders/AdminSeeder.php`:

```php
'password' => Hash::make('your_new_password'),
```

Then run:
```bash
php artisan migrate:fresh --seed
```

⚠️ **Warning:** This will delete all data!

### **Option 2: Update via Tinker**

```bash
php artisan tinker
```

Then in tinker:
```php
$admin = App\Models\Admin::where('email', 'admin@shivashine.com')->first();
$admin->password = Hash::make('your_new_password');
$admin->save();
```

### **Option 3: Direct Database Update**

Generate password hash:
```bash
php artisan tinker
```

```php
Hash::make('your_new_password');
// Copy the output
```

Update in database:
```sql
UPDATE admins 
SET password = 'paste_hash_here' 
WHERE email = 'admin@shivashine.com';
```

---

## 🧪 Testing Admin Login

### **Test Locally:**

1. Start server: `php artisan serve`
2. Visit: http://localhost:8000/admin/login
3. Enter credentials
4. Should redirect to dashboard

### **Test on Production:**

1. Visit: https://shiva-shine-1.onrender.com/admin/login
2. Enter credentials
3. Should redirect to dashboard

---

## 🐛 Troubleshooting

### **"Invalid email or password"**

**Possible causes:**
- Wrong credentials
- Admin not seeded
- Database connection issue

**Solution:**
```bash
# Check if admin exists
php artisan tinker
App\Models\Admin::where('email', 'admin@shivashine.com')->first();

# If null, run seeder
php artisan db:seed --class=AdminSeeder
```

### **"Session expired" or keeps logging out**

**Possible causes:**
- Session driver issue
- APP_KEY not set

**Solution:**
1. Check `.env` has `SESSION_DRIVER=file`
2. Verify `APP_KEY` is set
3. Clear cache: `php artisan cache:clear`

### **Can't access admin routes**

**Possible causes:**
- Routes not cached
- Middleware issue

**Solution:**
```bash
php artisan route:clear
php artisan route:cache
```

---

## 📝 Admin Model Location

```
app/Models/Admin.php
```

## 🗄️ Database Table

```
Table: admins
Columns:
- id (primary key)
- name
- email (unique)
- password (hashed)
- created_at
- updated_at
```

---

## 🔐 Security Best Practices

1. **Change default password** after first login
2. **Use strong passwords** (min 12 characters)
3. **Enable 2FA** (if implemented)
4. **Regular password rotation** (every 90 days)
5. **Monitor login attempts**
6. **Use HTTPS only** in production
7. **Keep credentials secure** - don't share

---

## 📞 Support

If you can't access the admin panel:

1. Check deployment logs for seeder output
2. Verify database connection
3. Test credentials locally first
4. Check `admins` table in database

---

**Last Updated:** 2026-01-22  
**Default Password:** shivashine@108  
**Security Level:** Change after first login
