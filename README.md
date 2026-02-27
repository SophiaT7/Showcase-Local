# ShowcaseLocal

> A platform for local micro-entrepreneurs to create a digital storefront and promote their services to nearby customers.

![Next.js](https://img.shields.io/badge/Next.js-16-black?style=flat-square&logo=next.js)
![Laravel](https://img.shields.io/badge/Laravel-11-red?style=flat-square&logo=laravel)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4-blue?style=flat-square&logo=tailwindcss)
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

### Frontend (`/frontend`)
| Technology | Version | Purpose |
|---|---|---|
| [Next.js](https://nextjs.org/) | 16.1.6 | React framework with SSR |
| [React](https://react.dev/) | 19 | UI library |
| [Tailwind CSS](https://tailwindcss.com/) | 4 | Utility-first styling |
| [shadcn/ui](https://ui.shadcn.com/) | 3 | UI components |
| [Lucide React](https://lucide.dev/) | 0.575 | Icons |
| [Axios](https://axios-http.com/) | 1.13 | HTTP client |
| [TanStack Query](https://tanstack.com/query) | 5 | Data fetching & caching |
| [Zustand](https://zustand-demo.pmnd.rs/) | 5 | State management |
| [React Hook Form](https://react-hook-form.com/) | 7 | Form handling |
| [Zod](https://zod.dev/) | 4 | Schema validation |

### Backend (`/`)
| Technology | Version | Purpose |
|---|---|---|
| [Laravel](https://laravel.com/) | 11 | PHP framework / REST API |
| [Filament](https://filamentphp.com/) | 3 | Admin panel |
| [MySQL](https://www.mysql.com/) | 8 | Database |
| [Vite](https://vitejs.dev/) | 6 | Asset bundler |
| [Tailwind CSS](https://tailwindcss.com/) | 3 | Admin styling |

---

## Project Structure
```
Showcase-Local/
├── frontend/                   # Next.js frontend
│   └── src/
│       └── app/
│           ├── page.tsx            # Home / search
│           ├── categorias/         # Categories listing
│           └── vitrine/[slug]/     # Business storefront page
│
├── app/                        # Laravel — Models, Controllers, Filament
│   ├── Models/
│   ├── Http/Controllers/Api/
│   └── Filament/
├── routes/
│   └── api.php                 # API routes
├── database/
│   └── migrations/             # Database migrations
└── ...                         # Laravel backend (root)
```

---

## Getting Started

### Backend (Laravel — root)
```bash
git clone https://github.com/SophiaT7/Showcase-Local.git
cd Showcase-Local

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
```

### Frontend (Next.js — /frontend)
```bash
cd frontend

npm install
cp .env.example .env.local
# Set NEXT_PUBLIC_API_URL in .env.local
npm run dev
```

---

## Environment Variables

### Frontend `frontend/.env.local`
```env
NEXT_PUBLIC_API_URL=http://your-backend-url/api
```

### Backend `.env`
```env
APP_URL=http://your-backend-url
DB_DATABASE=vitrine_negocio
DB_USERNAME=root
DB_PASSWORD=
```

---

## License

MIT
