# ShowcaseLocal

> Uma plataforma para microempreendedores locais criarem uma vitrine digital e divulgarem seus serviços para clientes da região.

![Next.js](https://img.shields.io/badge/Next.js-16-black?style=flat-square&logo=next.js)
![Laravel](https://img.shields.io/badge/Laravel-11-red?style=flat-square&logo=laravel)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4-blue?style=flat-square&logo=tailwindcss)
![MySQL](https://img.shields.io/badge/MySQL-8-orange?style=flat-square&logo=mysql)

🌐 [Read in English](README.md)

---

## Sobre

O ShowcaseLocal conecta microempreendedores com sua comunidade local. Donos de negócios podem criar uma vitrine digital personalizada — com fotos, serviços, preços e horários de funcionamento — enquanto clientes podem facilmente descobrir e entrar em contato com negócios próximos.

---

## Funcionalidades

- 🏪 Listagem de negócios com foto de perfil e banner
- 🔍 Busca por nome do serviço e cidade
- 🗂️ Filtro por categoria
- 📋 Catálogo de serviços com preços e descrições
- 🕐 Horários de funcionamento por dia da semana
- 🖼️ Galeria de fotos
- ⭐ Avaliações e notas de clientes
- 💬 Botão de contato direto via WhatsApp
- 📸 Link para perfil do Instagram
- 🛠️ Painel administrativo para gerenciar negócios, categorias e usuários

---

## Tecnologias

### Frontend (`/frontend`)
| Tecnologia | Versão | Finalidade |
|---|---|---|
| [Next.js](https://nextjs.org/) | 16.1.6 | Framework React com SSR |
| [React](https://react.dev/) | 19 | Biblioteca de UI |
| [Tailwind CSS](https://tailwindcss.com/) | 4 | Estilização utilitária |
| [shadcn/ui](https://ui.shadcn.com/) | 3 | Componentes de UI |
| [Lucide React](https://lucide.dev/) | 0.575 | Ícones |
| [Axios](https://axios-http.com/) | 1.13 | Cliente HTTP |
| [TanStack Query](https://tanstack.com/query) | 5 | Busca de dados e cache |
| [Zustand](https://zustand-demo.pmnd.rs/) | 5 | Gerenciamento de estado |
| [React Hook Form](https://react-hook-form.com/) | 7 | Manipulação de formulários |
| [Zod](https://zod.dev/) | 4 | Validação de schemas |

### Backend (`/`)
| Tecnologia | Versão | Finalidade |
|---|---|---|
| [Laravel](https://laravel.com/) | 11 | Framework PHP / API REST |
| [Filament](https://filamentphp.com/) | 3 | Painel administrativo |
| [MySQL](https://www.mysql.com/) | 8 | Banco de dados |
| [Vite](https://vitejs.dev/) | 6 | Bundler de assets |
| [Tailwind CSS](https://tailwindcss.com/) | 3 | Estilização do admin |

---

## Estrutura do Projeto
```
Showcase-Local/
├── frontend/                   # Frontend Next.js
│   └── src/
│       └── app/
│           ├── page.tsx            # Home / busca
│           ├── categorias/         # Listagem de categorias
│           └── vitrine/[slug]/     # Página da vitrine
│
├── app/                        # Laravel — Models, Controllers, Filament
│   ├── Models/
│   ├── Http/Controllers/Api/
│   └── Filament/
├── routes/
│   └── api.php                 # Rotas da API
├── database/
│   └── migrations/             # Migrações do banco
└── ...                         # Backend Laravel (raiz)
```

---

## Pré-requisitos

Antes de começar, certifique-se de ter instalado na sua máquina:

- [PHP](https://www.php.net/) >= 8.2
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) >= 18
- [npm](https://www.npmjs.com/) (vem junto com o Node.js)
- [MySQL](https://www.mysql.com/) >= 8.0

---

## Como Rodar

### 1. Clonar o repositório

```bash
git clone https://github.com/SophiaT7/Showcase-Local.git
cd Showcase-Local
```

### 2. Configurar o Backend (Laravel)

```bash
# Instalar dependências PHP
composer install

# Criar arquivo de ambiente
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate
```

#### Configurar o banco de dados

Abra o arquivo `.env` e configure suas credenciais do MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vitrine_negocio
DB_USERNAME=root
DB_PASSWORD=
```

> Certifique-se de que o banco `vitrine_negocio` existe no MySQL antes de rodar as migrações.
> Você pode criar com: `mysql -u root -e "CREATE DATABASE vitrine_negocio;"`

```bash
# Rodar migrações
php artisan migrate

# (Opcional) Popular o banco com dados de exemplo
php artisan db:seed

# Criar o link simbólico para arquivos enviados
php artisan storage:link
```

#### Iniciar o servidor backend

**Opção A — Usando `php artisan serve`:**

```bash
php artisan serve
```

A API estará disponível em **http://localhost:8000/api**

**Opção B — Usando XAMPP:**

Se você usa [XAMPP](https://www.apachefriends.org/), coloque o projeto dentro de `C:\xampp\htdocs\` e acesse via:

```
http://localhost/Showcase-Local/public
```

> Se estiver usando XAMPP, atualize `NEXT_PUBLIC_API_URL` no `frontend/.env.local`:
> ```env
> NEXT_PUBLIC_API_URL=http://localhost/Showcase-Local/public/api
> ```

---

### 3. Configurar o Frontend (Next.js)

Abra um **novo terminal** e execute:

```bash
cd frontend

# Instalar dependências
npm install

# Criar arquivo de ambiente
cp .env.example .env.local
```

O `.env.local` padrão já aponta para o backend local:

```env
NEXT_PUBLIC_API_URL=http://localhost:8000/api
```

#### Iniciar o servidor frontend

```bash
npm run dev
```

O frontend estará disponível em **http://localhost:3000**

---

## Executando o Projeto

Você precisa de **dois terminais** rodando simultaneamente:

| Terminal | Diretório | Comando | URL |
|---|---|---|---|
| 1 - Backend | `Showcase-Local/` | `php artisan serve` ou XAMPP | http://localhost:8000 ou http://localhost/Showcase-Local/public |
| 2 - Frontend | `Showcase-Local/frontend/` | `npm run dev` | http://localhost:3000 |

---

## Painel Administrativo

O painel admin é feito com [Filament](https://filamentphp.com/) e está disponível em:

**http://localhost:8000/admin**

Após rodar o seed, uma conta admin padrão é criada:

| Email | Senha | Papel |
|---|---|---|
| `admin@vitrine.com` | `password` | Admin |

> **Nota:** Altere a senha padrão após o primeiro login.

---

## Variáveis de Ambiente

### Backend `.env`

| Variável | Descrição | Padrão |
|---|---|---|
| `DB_CONNECTION` | Driver do banco | `mysql` |
| `DB_HOST` | Host do banco | `127.0.0.1` |
| `DB_PORT` | Porta do banco | `3306` |
| `DB_DATABASE` | Nome do banco | `vitrine_negocio` |
| `DB_USERNAME` | Usuário do banco | `root` |
| `DB_PASSWORD` | Senha do banco | _(vazio)_ |

### Frontend `frontend/.env.local`

| Variável | Descrição | Padrão |
|---|---|---|
| `NEXT_PUBLIC_API_URL` | URL base da API backend | `http://localhost:8000/api` |

---

## Licença

MIT
