# Showcase-Local
Platform for local micro-entrepreneurs to showcase their services and reach nearby customers.

About
ShowcaseLocal connects micro-entrepreneurs with their local community. Business owners can create a personalized digital storefront — with photos, services, pricing, and opening hours — while customers can easily discover and contact nearby businesses.

Features

🏪 Business listing with profile photo and banner
🔍 Search by service name and city
🗂️ Filter by category
📋 Service catalog with prices and descriptions
🕐 Opening hours per day of the week
🖼️ Photo gallery
⭐ Customer reviews and ratings
💬 Direct WhatsApp contact button
🛠️ Admin panel for managing businesses, categories and users


Tech Stack
Frontend
TechnologyVersionPurposeNext.js15React framework with SSRTailwind CSS3Utility-first stylingshadcn/ui-UI componentsLucide React-IconsAxios-HTTP client
Backend
TechnologyVersionPurposeLaravel11PHP framework / REST APIFilament3Admin panelMySQL8DatabaseLaravel Sanctum-API authentication

Project Structure
showcase-local/
├── showcase-local-api/      # Laravel backend
│   ├── app/
│   │   ├── Models/          # Vitrine, Categoria, Servico...
│   │   ├── Http/Controllers/Api/
│   │   └── Filament/        # Admin panel resources
│   └── routes/
│       └── api.php
│
└── showcase-local-web/      # Next.js frontend
    └── src/
        └── app/
            ├── page.tsx         # Home / search
            ├── categorias/      # Categories listing
            └── vitrine/[slug]/  # Business storefront page

Getting Started
Backend (Laravel)
bashgit clone https://github.com/your-username/showcase-local-api
cd showcase-local-api

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
Frontend (Next.js)
bashgit clone https://github.com/your-username/showcase-local-web
cd showcase-local-web

npm install
cp .env.example .env.local
# Set NEXT_PUBLIC_API_URL=http://your-backend-url/api
npm run dev

Environment Variables
Frontend .env.local
envNEXT_PUBLIC_API_URL=http://vitrine-backend.test/api
Backend .env
envAPP_URL=http://vitrine-backend.test
DB_DATABASE=vitrine_negocio
DB_USERNAME=root
DB_PASSWORD=

License
MIT
