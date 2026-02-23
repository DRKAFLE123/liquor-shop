# 🔱 LiquorShop — Premium Liquor Store Web Application

A full-featured, premium online liquor shop built with **Laravel**, **Filament Admin**, **Alpine.js**, and **Tailwind CSS**. Designed with a dark, cinematic aesthetic for an upscale customer experience.

---

## ✨ Features

### 🛍️ Frontend
- **Cinematic Hero Section** — Full-screen video/image slider with dynamic overlays
- **Product Catalogue** — Filterable product grid by category, with search and pagination
- **Product Detail Pages** — Rich product information with images
- **Responsive Design** — Fully mobile-optimized with a premium look on all screen sizes
- **Mobile Navigation** — Left-side slide-in drawer triggered by a hamburger toggle
- **Transparent Header** — Glass-morphism effect that becomes opaque on scroll
- **Heritage Section** — Editable "Our Story" content managed from the admin panel
- **Contact Page** — Dynamic contact info pulled from admin settings
- **Footer** — Social links, navigation, and contact details

### 🔧 Admin Panel (Filament)
- **Shop Settings** — Manage shop name, logo, address, phone, social media links
- **Product Management** — Add/edit/delete products with images, pricing, sizes, categories
- **Category Management** — CRUD for product categories with slugs
- **Hero Media Management** — Upload images, GIFs, or videos for the hero slider
- **Heritage Section** — Edit "About Us" content with rich text and images
- **User Management** — Admin user accounts

### ⚡ Tech Stack
| Layer | Technology |
|---|---|
| Backend | Laravel 11 |
| Admin Panel | Filament 3 |
| Frontend JS | Alpine.js 3 |
| CSS | Tailwind CSS 3 |
| Bundler | Vite |
| Database | MySQL |
| Media Storage | Laravel Storage (local) |

---

## 🚀 Getting Started

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js >= 18 & npm
- MySQL

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/YOUR_USERNAME/liquor-shop.git
cd liquor-shop

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies
npm install

# 4. Copy environment file and configure
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Configure your database in .env
# DB_DATABASE=liquor_shop
# DB_USERNAME=root
# DB_PASSWORD=your_password

# 7. Run migrations and seed the database
php artisan migrate --seed

# 8. Link storage
php artisan storage:link

# 9. Build frontend assets
npm run build

# 10. Start the development server
php artisan serve
```

Open [http://localhost:8000](http://localhost:8000) in your browser.

### Admin Access
Visit `/admin` and create an admin user via:
```bash
php artisan make:filament-user
```

---

## 📁 Project Structure

```
├── app/
│   ├── Filament/           # Admin panel resources
│   ├── Http/Controllers/   # Application controllers
│   ├── Models/             # Eloquent models
│   └── Providers/          # Service providers
├── database/
│   ├── migrations/         # Database schema
│   └── seeders/            # Sample data
├── public/
│   └── build/              # Compiled frontend assets
├── resources/
│   ├── css/                # Tailwind CSS source
│   ├── js/                 # Alpine.js components
│   └── views/              # Blade templates
│       ├── layouts/        # Base layout (app.blade.php)
│       ├── catalogue/      # Product listings
│       ├── home/           # Homepage
│       └── ...
├── routes/
│   └── web.php             # Web routes
└── storage/                # Uploaded media files
```

---

## 🎨 Design System

- **Primary Color:** `#C8A951` (Liquor Gold)
- **Background:** `#0A0A0A` (Deep Black)
- **Font:** Poppins (Google Fonts)
- **Breakpoints:** Standard Tailwind (`sm`, `md`, `lg`, `xl`)

---

## 📷 Screenshots

> Add screenshots of your homepage, catalogue, and admin panel here.

---

## 🔒 Environment Variables

Key variables in your `.env` file:

| Variable | Description |
|---|---|
| `APP_NAME` | Application name |
| `APP_URL` | Base URL of the application |
| `DB_*` | Database connection settings |
| `FILESYSTEM_DISK` | Storage driver (default: `local`) |

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 👤 Author

Built with ❤️ using Laravel + Filament.
