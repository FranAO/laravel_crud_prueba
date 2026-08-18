<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Productos') | {{ config('app.name', 'Prueba CRUD') }}</title>
    <style>
        :root {
            color-scheme: light;
            --canvas: #f3f5f7;
            --surface: #ffffff;
            --surface-soft: #f8fafc;
            --ink: #14202b;
            --ink-muted: #64717e;
            --line: #dfe5eb;
            --accent: #1769e0;
            --accent-dark: #0d4faa;
            --accent-soft: #eaf2ff;
            --danger: #b33b45;
            --danger-soft: #fff0f1;
            --success: #176b52;
            --success-soft: #eaf8f2;
            --shadow: 0 16px 40px rgba(24, 38, 51, 0.07);
            --radius: 16px;
        }

        * { box-sizing: border-box; }
        html { min-width: 320px; }
        body {
            margin: 0;
            background: var(--canvas);
            color: var(--ink);
            font-family: "Avenir Next", "Segoe UI", sans-serif;
            font-size: 15px;
            line-height: 1.55;
        }
        a { color: inherit; }
        button, input, textarea { font: inherit; }
        button, a { -webkit-tap-highlight-color: transparent; }
        :focus-visible { outline: 3px solid rgba(23, 105, 224, 0.35); outline-offset: 3px; }

        .app-shell { min-height: 100vh; }
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            max-width: 1240px;
            min-height: 76px;
            margin: 0 auto;
            padding: 0 28px;
        }
        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--ink);
            font-size: 15px;
            font-weight: 800;
            letter-spacing: -0.02em;
            text-decoration: none;
        }
        .brand-mark {
            display: grid;
            width: 30px;
            height: 30px;
            place-items: center;
            border-radius: 10px;
            background: var(--accent);
            color: #fff;
            font-size: 17px;
            font-weight: 800;
        }
        .brand small {
            display: block;
            margin-top: -2px;
            color: var(--ink-muted);
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.15em;
            line-height: 1;
            text-transform: uppercase;
        }
        .topbar nav { display: flex; align-items: center; gap: 22px; }
        .topbar nav a {
            color: var(--ink-muted);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: color 160ms ease-out;
        }
        .topbar nav a:hover, .topbar nav a[aria-current="page"] { color: var(--accent); }

        .page-container { max-width: 1240px; margin: 0 auto; padding: 48px 28px 72px; }
        .page-heading {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 32px;
            margin-bottom: 32px;
        }
        .kicker {
            margin: 0 0 10px;
            color: var(--accent);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.14em;
            line-height: 1.2;
            text-transform: uppercase;
        }
        h1, h2, h3, p { margin-top: 0; }
        h1 {
            margin-bottom: 10px;
            font-size: clamp(2.1rem, 4vw, 3.6rem);
            font-weight: 800;
            letter-spacing: -0.055em;
            line-height: 0.98;
        }
        h2 { margin-bottom: 5px; font-size: 1.1rem; letter-spacing: -0.02em; }
        h3 { margin-bottom: 4px; font-size: 1rem; }
        .lede { max-width: 560px; margin-bottom: 0; color: var(--ink-muted); font-size: 1rem; }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            min-height: 44px;
            padding: 0 17px;
            border: 1px solid transparent;
            border-radius: 12px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 800;
            line-height: 1;
            text-decoration: none;
            transition: transform 160ms ease-out, background-color 160ms ease-out, border-color 160ms ease-out, color 160ms ease-out;
        }
        .button:hover { transform: translateY(-1px); }
        .button:active { transform: translateY(0) scale(0.98); }
        .button-primary { background: var(--accent); color: #fff; box-shadow: 0 8px 18px rgba(23, 105, 224, 0.18); }
        .button-primary:hover { background: var(--accent-dark); }
        .button-secondary { border-color: var(--line); background: var(--surface); color: var(--ink); }
        .button-secondary:hover { border-color: #b8c4cf; background: var(--surface-soft); }
        .button-danger { border-color: #f1c8cc; background: var(--danger-soft); color: var(--danger); }
        .button-danger:hover { border-color: #e6a8ae; background: #ffe5e7; }
        .button-small { min-height: 34px; padding: 0 11px; font-size: 12px; }
        .button-plain { min-height: auto; padding: 0; border: 0; background: transparent; color: var(--accent); font-size: 13px; }
        .button-plain:hover { color: var(--accent-dark); text-decoration: underline; }

        .metrics { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 20px; }
        .metric-card {
            padding: 19px 20px;
            border: 1px solid var(--line);
            border-radius: var(--radius);
            background: var(--surface);
            box-shadow: 0 8px 20px rgba(24, 38, 51, 0.03);
        }
        .metric-label { display: block; margin-bottom: 8px; color: var(--ink-muted); font-size: 12px; font-weight: 700; }
        .metric-value { display: block; font-size: 1.75rem; font-weight: 800; letter-spacing: -0.05em; line-height: 1; }
        .metric-note { display: block; margin-top: 8px; color: var(--ink-muted); font-size: 12px; }

        .surface { border: 1px solid var(--line); border-radius: var(--radius); background: var(--surface); box-shadow: var(--shadow); }
        .surface-head { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; padding: 24px 24px 20px; }
        .surface-head p { margin-bottom: 0; color: var(--ink-muted); font-size: 13px; }
        .muted { color: var(--ink-muted); font-size: 12px; }
        .table-wrap { overflow-x: auto; border-top: 1px solid var(--line); }
        table { width: 100%; border-collapse: collapse; min-width: 690px; }
        th, td { padding: 16px 24px; text-align: left; vertical-align: middle; }
        th { background: var(--surface-soft); color: var(--ink-muted); font-size: 10px; font-weight: 800; letter-spacing: 0.12em; text-transform: uppercase; }
        td { border-top: 1px solid var(--line); font-size: 14px; }
        tbody tr { transition: background-color 160ms ease-out; }
        tbody tr:hover { background: #fbfcfe; }
        .cell-id { color: var(--ink-muted); font-variant-numeric: tabular-nums; }
        .product-name { display: block; margin-bottom: 2px; font-weight: 800; }
        .product-description { display: block; max-width: 310px; overflow: hidden; color: var(--ink-muted); font-size: 12px; text-overflow: ellipsis; white-space: nowrap; }
        .number { font-variant-numeric: tabular-nums; white-space: nowrap; }
        .stock-badge { display: inline-flex; min-width: 32px; justify-content: center; padding: 4px 8px; border-radius: 999px; background: var(--accent-soft); color: var(--accent-dark); font-size: 12px; font-weight: 800; }
        .stock-badge.is-empty { background: var(--danger-soft); color: var(--danger); }
        .row-actions { display: flex; align-items: center; justify-content: flex-end; gap: 13px; white-space: nowrap; }
        .row-actions a { color: var(--accent); font-size: 12px; font-weight: 800; text-decoration: none; }
        .row-actions a:hover { text-decoration: underline; }
        .inline-form { display: inline; }
        .sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0; }
        .empty-state { padding: 62px 24px; text-align: center; }
        .empty-icon { display: grid; width: 46px; height: 46px; margin: 0 auto 14px; place-items: center; border: 1px solid #cbdcf7; border-radius: 14px; background: var(--accent-soft); color: var(--accent); font-size: 22px; font-weight: 400; }
        .empty-state p { max-width: 370px; margin: 0 auto 20px; color: var(--ink-muted); font-size: 14px; }

        .flash { display: flex; align-items: center; gap: 10px; margin-bottom: 24px; padding: 13px 16px; border: 1px solid #bee6d3; border-radius: 12px; background: var(--success-soft); color: var(--success); font-size: 13px; font-weight: 700; }
        .flash::before { content: '✓'; display: grid; width: 20px; height: 20px; place-items: center; border-radius: 50%; background: var(--success); color: #fff; font-size: 11px; }
        .error-summary { margin-bottom: 24px; padding: 15px 18px; border: 1px solid #f0c4c8; border-radius: 12px; background: var(--danger-soft); color: var(--danger); }
        .error-summary strong { display: block; margin-bottom: 4px; }
        .error-summary ul { margin: 0; padding-left: 18px; font-size: 13px; }
        .field-error { display: block; margin-top: 6px; color: var(--danger); font-size: 12px; }

        .form-shell { max-width: 760px; }
        .form-panel { padding: 28px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .field { display: flex; flex-direction: column; gap: 7px; }
        .field-full { grid-column: 1 / -1; }
        .field label { color: var(--ink); font-size: 13px; font-weight: 800; }
        .field input, .field textarea { width: 100%; border: 1px solid #cbd5df; border-radius: 11px; background: #fff; color: var(--ink); outline: none; padding: 12px 13px; transition: border-color 160ms ease-out, box-shadow 160ms ease-out; }
        .field input { min-height: 46px; }
        .field textarea { min-height: 124px; resize: vertical; }
        .field input::placeholder, .field textarea::placeholder { color: #7c8995; }
        .field input:focus, .field textarea:focus { border-color: var(--accent); box-shadow: 0 0 0 4px rgba(23, 105, 224, 0.12); }
        .field-hint { margin: -1px 0 0; color: var(--ink-muted); font-size: 12px; }
        .form-actions { display: flex; align-items: center; gap: 12px; margin-top: 26px; padding-top: 22px; border-top: 1px solid var(--line); }

        .detail-header { display: flex; align-items: flex-start; justify-content: space-between; gap: 28px; margin-bottom: 26px; }
        .detail-header h1 { max-width: 670px; margin-bottom: 0; }
        .detail-actions { display: flex; flex-wrap: wrap; justify-content: flex-end; gap: 10px; }
        .detail-grid { display: grid; grid-template-columns: repeat(3, 1fr); border-bottom: 1px solid var(--line); }
        .detail-item { padding: 22px 24px; border-top: 1px solid var(--line); }
        .detail-item:nth-child(3n + 2), .detail-item:nth-child(3n + 3) { border-left: 1px solid var(--line); }
        .detail-label { display: block; margin-bottom: 6px; color: var(--ink-muted); font-size: 11px; font-weight: 800; letter-spacing: 0.08em; text-transform: uppercase; }
        .detail-value { display: block; font-size: 1.25rem; font-weight: 800; letter-spacing: -0.03em; }
        .description-block { padding: 24px; }
        .description-block p:last-child { max-width: 720px; margin-bottom: 0; color: var(--ink-muted); white-space: pre-line; }
        .back-link { display: inline-flex; margin-bottom: 30px; color: var(--accent); font-size: 13px; font-weight: 800; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
        .footer { max-width: 1240px; margin: 0 auto; padding: 0 28px 28px; color: var(--ink-muted); font-size: 12px; }

        @media (max-width: 760px) {
            .topbar { min-height: 68px; padding: 0 18px; }
            .topbar nav { gap: 14px; }
            .topbar nav a { font-size: 12px; }
            .page-container { padding: 36px 18px 54px; }
            .page-heading, .detail-header { align-items: flex-start; flex-direction: column; gap: 20px; }
            .page-heading .button, .detail-actions { width: 100%; }
            .detail-actions .button { flex: 1; }
            .metrics { grid-template-columns: 1fr; gap: 10px; }
            .metric-card { padding: 16px 18px; }
            .surface-head { padding: 20px 18px 17px; }
            th, td { padding-right: 18px; padding-left: 18px; }
            .form-panel { padding: 20px 18px; }
            .form-grid, .detail-grid { grid-template-columns: 1fr; }
            .field-full { grid-column: auto; }
            .detail-item:nth-child(3n + 2), .detail-item:nth-child(3n + 3) { border-left: 0; }
            .detail-item { padding: 18px; }
            .description-block { padding: 20px 18px; }
            .footer { padding: 0 18px 24px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { scroll-behavior: auto !important; transition-duration: 0.01ms !important; animation-duration: 0.01ms !important; }
        }
    </style>
</head>
<body>
    <div class="app-shell">
        <header class="topbar">
            <a class="brand" href="{{ route('productos.index') }}" aria-label="Ir al listado de productos">
                <span class="brand-mark" aria-hidden="true">p</span>
                <span>prueba <small>inventario</small></span>
            </a>
            <nav aria-label="Navegación principal">
                <a href="{{ route('productos.index') }}" @if(request()->routeIs('productos.index')) aria-current="page" @endif>Productos</a>
                <a href="{{ route('productos.create') }}" @if(request()->routeIs('productos.create')) aria-current="page" @endif>Nuevo registro</a>
            </nav>
        </header>

        <main class="page-container">
            @if (session('success'))
                <div class="flash" role="status">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="error-summary" role="alert">
                    <strong>Revisá los datos ingresados.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="footer">Prueba CRUD local · Gestión simple de productos</footer>
    </div>
</body>
</html>
