<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShowcaseLocal - Entrar</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #f8fafc;
        }

        .container {
            text-align: center;
            padding: 2rem;
        }

        .logo {
            font-size: 2rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: #64748b;
            margin-bottom: 3rem;
            font-size: 1.05rem;
        }

        .cards {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            background: #fff;
            border: 2px solid #e2e8f0;
            border-radius: 1rem;
            padding: 2.5rem 2rem;
            width: 260px;
            text-decoration: none;
            color: inherit;
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .card:hover {
            border-color: #6366f1;
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.12);
            transform: translateY(-4px);
        }

        .card-icon {
            width: 64px;
            height: 64px;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .card-empreendedor .card-icon {
            background: #fef3c7;
        }

        .card-admin .card-icon {
            background: #ede9fe;
        }

        .card-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1e293b;
        }

        .card-desc {
            font-size: 0.875rem;
            color: #64748b;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">ShowcaseLocal</div>
        <p class="subtitle">Como deseja entrar?</p>

        <div class="cards">
            <a href="/painel/login" class="card card-empreendedor">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </div>
                <span class="card-title">Empreendedor</span>
                <span class="card-desc">Gerencie sua vitrine, servicos, fotos e horarios.</span>
            </a>

            <a href="/admin/login" class="card card-admin">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <span class="card-title">Administrador</span>
                <span class="card-desc">Gerencie categorias, usuarios e todas as vitrines.</span>
            </a>
        </div>
    </div>
</body>
</html>
