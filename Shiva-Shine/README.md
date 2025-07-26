jewelry-website/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   ├── CategoryController.php
│   │   │   │   └── OrderController.php
│   │   │   ├── Product/
│   │   │   │   └── ProductController.php
│   │   │   ├── Category/
│   │   │   │   └── CategoryController.php
│   │   │   ├── Cart/
│   │   │   │   └── CartController.php
│   │   │   ├── Checkout/
│   │   │   │   └── CheckoutController.php
│   │   │   ├── Payment/
│   │   │   │   └── RazorpayController.php
│   │   │   ├── User/
│   │   │   │   ├── UserController.php
│   │   │   │   └── WishlistController.php
│   │   │   └── PageController.php              # Home, Contact, About, Launch
│   │   └── Middleware/
│   ├── Models/
│   │   ├── Product/Product.php
│   │   ├── Category/Category.php
│   │   ├── Order/Order.php
│   │   ├── Cart/Cart.php
│   │   ├── Wishlist/Wishlist.php
│   │   └── User/User.php
│
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   └── launch.blade.php               # For launch page
│   │   ├── components/
│   │   │   ├── navbar.blade.php
│   │   │   ├── footer.blade.php
│   │   │   ├── product-card.blade.php
│   │   │   ├── category-menu.blade.php
│   │   │   └── razorpay-checkout.blade.php
│   │   ├── pages/
│   │   │   ├── home.blade.php
│   │   │   ├── contact.blade.php
│   │   │   ├── about.blade.php
│   │   │   ├── not-found.blade.php
│   │   │   └── launch.blade.php
│   │   ├── product/
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   ├── category/
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   ├── cart/
│   │   │   └── index.blade.php
│   │   ├── checkout/
│   │   │   └── index.blade.php
│   │   ├── wishlist/
│   │   │   └── index.blade.php
│   │   ├── user/
│   │   │   ├── login.blade.php
│   │   │   ├── register.blade.php
│   │   │   └── profile.blade.php
│   │   └── admin/
│   │       ├── dashboard.blade.php
│   │       ├── products.blade.php
│   │       ├── categories.blade.php
│   │       └── orders.blade.php
│
├── public/
│   ├── images/
│   │   ├── products/
│   │   └── categories/
│   ├── css/
│   └── js/
│
├── routes/
│   ├── web.php                    # All main and user routes
│   └── admin.php                  # Admin-only routes (optional)
│
├── database/
│   ├── migrations/
│   │   ├── product/create_products_table.php
│   │   ├── category/create_categories_table.php
│   │   ├── user/create_users_table.php
│   │   ├── cart/create_carts_table.php
│   │   ├── wishlist/create_wishlists_table.php
│   │   └── orders/create_orders_table.php
│   ├── seeders/
│   │   ├── ProductSeeder.php
│   │   ├── CategorySeeder.php
│   │   └── UserSeeder.php
│
├── tailwind.config.js
├── postcss.config.js
├── webpack.mix.js
├── package.json
├── composer.json
├── .env
└── README.md
