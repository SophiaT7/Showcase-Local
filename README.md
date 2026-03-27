# ShowcaseLocal

> A platform for local micro-entrepreneurs to create a digital storefront and promote their services to nearby customers.

![Next.js](https://img.shields.io/badge/Next.js-16-black?style=flat-square&logo=next.js)
![Laravel](https://img.shields.io/badge/Laravel-11-red?style=flat-square&logo=laravel)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4-blue?style=flat-square&logo=tailwindcss)
![MySQL](https://img.shields.io/badge/MySQL-8-orange?style=flat-square&logo=mysql)

🌐 [Leia em Portugues](README.pt-BR.md)

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

## Prerequisites

Before starting, make sure you have the following installed on your machine:

- [PHP](https://www.php.net/) >= 8.2
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) >= 18
- [npm](https://www.npmjs.com/) (comes with Node.js)
- [MySQL](https://www.mysql.com/) >= 8.0

---

## Getting Started

### 1. Clone the repository

```bash
git clone https://github.com/SophiaT7/Showcase-Local.git
cd Showcase-Local
```

### 2. Backend Setup (Laravel)

```bash
# Install PHP dependencies
composer install

# Create environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### Configure the database

Open the `.env` file and set your MySQL credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vitrine_negocio
DB_USERNAME=root
DB_PASSWORD=
```

> Make sure the database `vitrine_negocio` exists in MySQL before running migrations.
> You can create it with: `mysql -u root -e "CREATE DATABASE vitrine_negocio;"`

```bash
# Run migrations
php artisan migrate

# (Optional) Seed the database with sample data
php artisan db:seed

# Create the storage symlink for uploaded files
php artisan storage:link
```

#### Start the backend server

**Option A — Using `php artisan serve`:**

```bash
php artisan serve
```

The API will be available at **http://localhost:8000/api**

**Option B — Using XAMPP:**

If you use [XAMPP](https://www.apachefriends.org/), place the project inside `C:\xampp\htdocs\` and access it via:

```
http://localhost/Showcase-Local/public
```

> If using XAMPP, update `NEXT_PUBLIC_API_URL` in `frontend/.env.local` accordingly:
> ```env
> NEXT_PUBLIC_API_URL=http://localhost/Showcase-Local/public/api
> ```

---

### 3. Frontend Setup (Next.js)

Open a **new terminal** and run:

```bash
cd frontend

# Install dependencies
npm install

# Create environment file
cp .env.example .env.local
```

The default `.env.local` already points to the local backend:

```env
NEXT_PUBLIC_API_URL=http://localhost:8000/api
```

#### Start the frontend dev server

```bash
npm run dev
```

The frontend will be available at **http://localhost:3000**

---

## Running the Project

You need **two terminals** running simultaneously:

| Terminal | Directory | Command | URL |
|---|---|---|---|
| 1 - Backend | `Showcase-Local/` | `php artisan serve` or XAMPP | http://localhost:8000 or http://localhost/Showcase-Local/public |
| 2 - Frontend | `Showcase-Local/frontend/` | `npm run dev` | http://localhost:3000 |

---

## Admin Panel

The admin panel is powered by [Filament](https://filamentphp.com/) and is available at:

**http://localhost:8000/admin**

Default admin credentials (after seeding):

| Email | Password | Role |
|---|---|---|
| `admin@vitrine.com` | `password` | Admin |

Sample entrepreneur accounts:

| Email | Password |
|---|---|
| `maria@teste.com` | `password` |
| `joao@teste.com` | `password` |
| `ana@teste.com` | `password` |

---

## Environment Variables

### Backend `.env`

| Variable | Description | Default |
|---|---|---|
| `DB_CONNECTION` | Database driver | `mysql` |
| `DB_HOST` | Database host | `127.0.0.1` |
| `DB_PORT` | Database port | `3306` |
| `DB_DATABASE` | Database name | `vitrine_negocio` |
| `DB_USERNAME` | Database user | `root` |
| `DB_PASSWORD` | Database password | _(empty)_ |

### Frontend `frontend/.env.local`

| Variable | Description | Default |
|---|---|---|
| `NEXT_PUBLIC_API_URL` | Backend API base URL | `http://localhost:8000/api` |

---

## License

MIT
