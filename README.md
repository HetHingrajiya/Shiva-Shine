# 💎 Shiva Shine - Jewelry E-Commerce Platform

A modern, elegant jewelry e-commerce platform built with Laravel, featuring Google OAuth authentication, Razorpay payment integration, and a beautiful responsive design.

## 🌟 Features

- **User Authentication**
  - Google OAuth integration
  - Traditional email/password authentication
  - User profile management

- **Product Management**
  - Browse products by category
  - Product search and filtering
  - Detailed product views
  - Wishlist functionality

- **Shopping Experience**
  - Shopping cart
  - Secure checkout process
  - Razorpay payment gateway integration
  - Order tracking

- **Admin Panel**
  - Product management (CRUD)
  - Category management
  - Order management
  - Dashboard with analytics

## 🚀 Quick Start

### Local Development

1. **Clone the repository**
   ```bash
   git clone <your-repo-url>
   cd Shiva-Shine
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Set up database**
   - Update `.env` with your database credentials
   - Run migrations and seed admin account:
   ```bash
   php artisan migrate
   php artisan db:seed --class=AdminSeeder
   ```
   
   **Admin credentials:**
   - Email: `admin@shivashine.com`
   - Password: `shivashine@108`

5. **Build assets**
   ```bash
   npm run dev
   ```

6. **Start development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to see your application.

## 🌐 Production Deployment (Render)

This application is configured for easy deployment on Render.

### Prerequisites
- GitHub repository with your code
- Render account
- PostgreSQL database on Render

### Deployment Steps

1. **Verify configuration**
   ```bash
   bash verify-deployment.sh
   ```

2. **Update render.yaml**
   - Copy `render.yaml.example` to `render.yaml`
   - Update with your actual credentials
   - **Important:** Keep `render.yaml` out of version control if it contains secrets

3. **Deploy to Render**
   - Push your code to GitHub
   - In Render dashboard: New → Blueprint
   - Connect your repository
   - Render will auto-deploy using `render.yaml`

4. **Verify deployment**
   - Check deployment logs
   - Visit your production URL
   - Test database connectivity
   - Verify Google OAuth and email functionality

📖 **For detailed deployment instructions, see [DEPLOYMENT.md](./DEPLOYMENT.md)**

## 📁 Project Structure

```
Shiva-Shine/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin panel controllers
│   │   │   ├── Product/        # Product management
│   │   │   ├── Category/       # Category management
│   │   │   ├── Cart/           # Shopping cart
│   │   │   ├── Checkout/       # Checkout process
│   │   │   ├── Payment/        # Razorpay integration
│   │   │   └── User/           # User & wishlist
│   │   └── Middleware/
│   └── Models/
│
├── resources/
│   └── views/
│       ├── layouts/
│       ├── components/
│       ├── pages/
│       ├── product/
│       ├── cart/
│       ├── checkout/
│       └── admin/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── routes/
│   ├── web.php
│   └── admin.php
│
├── public/
│   ├── images/
│   ├── css/
│   └── js/
│
├── Dockerfile                   # Docker configuration
├── docker-entrypoint.sh        # Deployment startup script
├── render.yaml                 # Render deployment config
└── DEPLOYMENT.md               # Deployment guide
```

## 🔧 Configuration

### Environment Variables

Key environment variables (see `.env.example` for complete list):

```env
# Application
APP_NAME=ShivaShine
APP_ENV=production
APP_URL=https://your-domain.com

# Database
DB_CONNECTION=pgsql
DB_HOST=your-database-host
DB_DATABASE=your-database-name
DB_USERNAME=your-username
DB_PASSWORD=your-password

# Google OAuth
GOOGLE_CLIENT_ID=your-client-id
GOOGLE_CLIENT_SECRET=your-client-secret
GOOGLE_REDIRECT=https://your-domain.com/auth/google/callback

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password

# Razorpay
RAZORPAY_KEY=your-razorpay-key
RAZORPAY_SECRET=your-razorpay-secret
```

### Google OAuth Setup

1. Go to [Google Cloud Console](https://console.cloud.google.com)
2. Create a new project or select existing
3. Enable Google+ API
4. Create OAuth 2.0 credentials
5. Add authorized redirect URIs:
   - `http://localhost:8000/auth/google/callback` (development)
   - `https://your-domain.com/auth/google/callback` (production)

### Gmail SMTP Setup

1. Enable 2-Step Verification on your Google Account
2. Generate an App Password:
   - Google Account → Security → 2-Step Verification → App Passwords
3. Use the generated password in `MAIL_PASSWORD`

### Razorpay Setup

1. Sign up at [Razorpay](https://razorpay.com)
2. Get your API keys from Dashboard → Settings → API Keys
3. Add keys to environment variables

## 🛠️ Development

### Running Tests
```bash
php artisan test
```

### Code Style
```bash
./vendor/bin/pint
```

### Database Seeding
```bash
php artisan db:seed
```

### Clear Caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## 📦 Tech Stack

- **Backend:** Laravel 11.x
- **Frontend:** Blade Templates, Tailwind CSS
- **Database:** PostgreSQL (Production), MySQL (Local)
- **Authentication:** Laravel Socialite (Google OAuth)
- **Payment:** Razorpay
- **Deployment:** Docker, Render
- **Email:** Gmail SMTP

## 🔒 Security

- All sensitive credentials should be stored in environment variables
- `.env` file is excluded from version control
- CSRF protection enabled on all forms
- SQL injection protection via Eloquent ORM
- XSS protection via Blade templating

## 📝 Documentation

- [Deployment Guide](./DEPLOYMENT.md) - Complete deployment instructions
- [Changelog](./CHANGELOG.md) - Version history and changes

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is proprietary software. All rights reserved.

## 👥 Support

For issues and questions:
- Check [DEPLOYMENT.md](./DEPLOYMENT.md) for deployment help
- Review [Render Documentation](https://render.com/docs)
- Check [Laravel Documentation](https://laravel.com/docs)

## 🎯 Roadmap

- [ ] Add product reviews and ratings
- [ ] Implement advanced search with filters
- [ ] Add email notifications for orders
- [ ] Create mobile app version
- [ ] Add multi-language support
- [ ] Implement inventory management
- [ ] Add promotional codes/discounts

---

**Built with ❤️ for jewelry enthusiasts**

**Version:** 1.0.0  
**Last Updated:** 2026-01-22
