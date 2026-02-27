# ShowcaseLocal

> A platform for local micro-entrepreneurs to create a digital storefront and promote their services to nearby customers.

![Next.js](https://img.shields.io/badge/Next.js-15-black?style=flat-square&logo=next.js)
![Laravel](https://img.shields.io/badge/Laravel-11-red?style=flat-square&logo=laravel)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3-blue?style=flat-square&logo=tailwindcss)
![MySQL](https://img.shields.io/badge/MySQL-8-orange?style=flat-square&logo=mysql)

---

## About

ShowcaseLocal connects micro-entrepreneurs with their local community. Business owners can create a personalized digital storefront — with photos, services, pricing, and opening hours — while customers can easily discover and contact nearby businesses.

---

## Features

- 🏪 Business listing with profile photo and banner
- 🔍 Search by service name and city
- 🗂️ Filter by category
- 📋 Service catalog with prices and descriptions
- 🕐 Opening hours per day of the week
- 🖼️ Photo gallery
- ⭐ Customer reviews and ratings
- 💬 Direct WhatsApp contact button
- 🛠️ Admin panel for managing businesses, categories and users

---

## Tech Stack

### Frontend
| Technology | Version | Purpose |
|---|---|---|
| [Next.js](https://nextjs.org/) | 15 | React framework with SSR |
| [Tailwind CSS](https://tailwindcss.com/) | 3 | Utility-first styling |
| [shadcn/ui](https://ui.shadcn.com/) | - | UI components |
| [Lucide React](https://lucide.dev/) | - | Icons |
| [Axios](https://axios-http.com/) | - | HTTP client |

### Backend
| Technology | Version | Purpose |
|---|---|---|
| [Laravel](https://laravel.com/) | 11 | PHP framework / REST API |
| [Filament](https://filamentphp.com/) | 3 | Admin panel |
| [MySQL](https://www.mysql.com/) | 8 | Database |
| [Laravel Sanctum](https://laravel.com/docs/sanctum) | - | API authentication |

---

## Project Structure
```
showcase-local/
├── showcase-local-api/
│   ├── app/
│   │   ├── Models/
│   │   ├── Http/Controllers/Api/
│   │   └── Filament/
│   └── routes/
│       └── api.php
│
└── showcase-local-web/
    └── src/
        └── app/
            ├── page.tsx
            ├── categorias/
            └── vitrine/[slug]/
```

---

## Getting Started

### Backend (Laravel)
```bash
git clone https://github.com/your-username/showcase-local-api
cd showcase-local-api
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
```

### Frontend (Next.js)
```bash
git clone https://github.com/your-username/showcase-local-web
cd showcase-local-web
npm install
cp .env.example .env.local
npm run dev
```

---

## Environment Variables

### Frontend `.env.local`
```env
NEXT_PUBLIC_API_URL=http://vitrine-backend.test/api
```

### Backend `.env`
```env
APP_URL=http://vitrine-backend.test
DB_DATABASE=vitrine_negocio
DB_USERNAME=root
DB_PASSWORD=
```

---

## License

MIT
