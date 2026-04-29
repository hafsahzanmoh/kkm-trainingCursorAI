<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Visitor Registration System</title>
    <style>
        :root{
            --bg0:#04141a;
            --bg1:#052a33;
            --bg2:#0a5b67;
            --teal:#29d3c7;
            --cyan:#42a7ff;
            --text:#e9fbff;
            --muted:rgba(233,251,255,.75);
            --card:rgba(255,255,255,.08);
            --card2:rgba(255,255,255,.12);
            --border:rgba(255,255,255,.18);
            --shadow:rgba(0,0,0,.35);
            --ring:rgba(41,211,199,.45);
        }
        *{ box-sizing:border-box; }
        html,body{ height:100%; }
        body{
            margin:0;
            font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial, "Noto Sans", "Liberation Sans", sans-serif;
            color:var(--text);
            background:
                radial-gradient(900px circle at 18% 10%, rgba(41,211,199,.20), transparent 40%),
                radial-gradient(700px circle at 80% 30%, rgba(66,167,255,.16), transparent 45%),
                radial-gradient(600px circle at 60% 90%, rgba(10,91,103,.50), transparent 40%),
                linear-gradient(180deg, var(--bg0), var(--bg1));
            overflow-x:hidden;
        }
        /* animated glow layer */
        .bg-anim{
            position:fixed;
            inset:-40vmax;
            pointer-events:none;
            background:
                conic-gradient(from 90deg, rgba(41,211,199,.20), rgba(66,167,255,.16), rgba(41,211,199,.10), rgba(66,167,255,.18));
            filter: blur(60px);
            opacity:.55;
            animation: spin 16s linear infinite;
        }
        @keyframes spin { from{ transform: rotate(0deg);} to{ transform: rotate(360deg);} }
        @media (prefers-reduced-motion: reduce){
            .bg-anim{ animation:none; }
        }

        .wrap{
            position:relative;
            min-height:100%;
        }
        .container{
            max-width:1120px;
            margin:0 auto;
            padding: 0 18px;
        }
        header{
            padding: 18px 0;
        }
        .topbar{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:14px;
        }
        .brand{
            display:flex;
            align-items:center;
            gap:12px;
            text-decoration:none;
            color:inherit;
        }
        .logo{
            width:42px;
            height:42px;
            border-radius:14px;
            background: linear-gradient(135deg, rgba(41,211,199,.25), rgba(66,167,255,.22));
            border:1px solid var(--border);
            box-shadow: 0 10px 30px var(--shadow);
            display:grid;
            place-items:center;
        }
        .brand-title{
            display:flex;
            flex-direction:column;
            line-height:1.1;
        }
        .brand-title strong{
            font-size:14px;
            letter-spacing:.2px;
        }
        .brand-title span{
            font-size:12px;
            color:var(--muted);
        }
        nav{
            display:flex;
            align-items:center;
            gap:10px;
            flex-wrap:wrap;
            justify-content:flex-end;
        }
        nav a{
            text-decoration:none;
            padding:10px 12px;
            border-radius:12px;
            color:var(--muted);
            border:1px solid transparent;
            transition: transform .15s ease, border-color .15s ease, background .15s ease;
        }
        nav a:hover{
            color:var(--text);
            border-color: rgba(255,255,255,.16);
            background: rgba(255,255,255,.06);
            transform: translateY(-1px);
        }
        nav a:focus-visible{
            outline:none;
            box-shadow: 0 0 0 4px var(--ring);
        }

        .hero{
            padding: 28px 0 26px;
        }
        .hero-grid{
            display:grid;
            grid-template-columns: 1.15fr .85fr;
            gap:18px;
            align-items:stretch;
        }
        @media (max-width: 900px){
            .hero-grid{ grid-template-columns:1fr; }
        }
        .hero-card{
            background: linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.04));
            border:1px solid rgba(255,255,255,.16);
            border-radius: 22px;
            padding: 22px;
            box-shadow: 0 25px 70px rgba(0,0,0,.35);
            backdrop-filter: blur(10px);
            position:relative;
            overflow:hidden;
        }
        .hero-card::after{
            content:"";
            position:absolute;
            width: 500px;
            height: 500px;
            right:-260px;
            top:-290px;
            background: radial-gradient(circle at 30% 30%, rgba(41,211,199,.25), transparent 55%);
        }
        h1{
            margin: 6px 0 10px;
            font-size: 42px;
            line-height: 1.05;
            letter-spacing: -.6px;
        }
        @media (max-width: 520px){
            h1{ font-size: 34px; }
        }
        .lead{
            margin: 0 0 18px;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.6;
            max-width: 56ch;
        }
        .cta-row{
            display:flex;
            gap:12px;
            flex-wrap:wrap;
            align-items:center;
        }
        .btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:10px;
            padding: 12px 14px;
            border-radius: 14px;
            text-decoration:none;
            border:1px solid transparent;
            font-weight: 650;
            letter-spacing:.2px;
            transition: transform .15s ease, filter .15s ease, background .15s ease, border-color .15s ease;
            user-select:none;
            cursor:pointer;
        }
        .btn-primary{
            background: linear-gradient(135deg, rgba(41,211,199,.95), rgba(66,167,255,.75));
            color:#042028;
            box-shadow: 0 20px 60px rgba(41,211,199,.20);
        }
        .btn-primary:hover{ transform: translateY(-1px); filter:saturate(1.05); }
        .btn-secondary{
            background: rgba(255,255,255,.06);
            color:var(--text);
            border-color: rgba(255,255,255,.18);
        }
        .btn-secondary:hover{ transform: translateY(-1px); background: rgba(255,255,255,.10); border-color: rgba(255,255,255,.25); }
        .btn:focus-visible{
            outline:none;
            box-shadow: 0 0 0 4px var(--ring);
        }
        .mini-badges{
            margin-top: 16px;
            display:flex;
            gap:10px;
            flex-wrap:wrap;
        }
        .badge{
            padding: 10px 12px;
            border-radius: 16px;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.14);
            color: var(--muted);
            font-size: 13px;
            display:flex;
            align-items:center;
            gap:10px;
        }
        .badge .dot{
            width:10px; height:10px;
            border-radius:999px;
            background: var(--teal);
            box-shadow: 0 0 0 6px rgba(41,211,199,.12);
        }
        .side{
            padding: 18px;
            border-radius: 22px;
            background: rgba(255,255,255,.06);
            border:1px solid rgba(255,255,255,.14);
            backdrop-filter: blur(10px);
            display:flex;
            flex-direction:column;
            gap:14px;
        }
        .side h2{
            font-size:16px;
            margin:0;
            letter-spacing:.2px;
        }
        .side p{
            margin:0;
            color:var(--muted);
            line-height:1.6;
            font-size:14px;
        }
        .side .panel{
            border-radius: 18px;
            padding: 14px;
            background: rgba(255,255,255,.05);
            border:1px solid rgba(255,255,255,.12);
        }
        .grid{
            display:grid;
            grid-template-columns: repeat(3, 1fr);
            gap:14px;
            margin-top: 18px;
        }
        @media (max-width: 1050px){
            .grid{ grid-template-columns:1fr 1fr; }
        }
        @media (max-width: 700px){
            .grid{ grid-template-columns:1fr; }
        }
        .feature{
            border-radius: 20px;
            padding: 16px;
            background: rgba(255,255,255,.06);
            border:1px solid rgba(255,255,255,.14);
            min-height: 138px;
            position:relative;
            overflow:hidden;
        }
        .feature::before{
            content:"";
            position:absolute;
            width: 220px;
            height: 220px;
            right:-140px;
            top:-160px;
            background: radial-gradient(circle at 30% 30%, rgba(66,167,255,.22), transparent 60%);
        }
        .feature .icon{
            width:42px; height:42px;
            border-radius: 16px;
            background: rgba(41,211,199,.12);
            border:1px solid rgba(41,211,199,.25);
            display:grid;
            place-items:center;
            margin-bottom:10px;
            position:relative;
        }
        .feature h3{
            margin: 0 0 8px;
            font-size: 15px;
            letter-spacing:.2px;
            position:relative;
        }
        .feature p{
            margin:0;
            color:var(--muted);
            font-size:14px;
            line-height:1.55;
            position:relative;
        }

        .section{
            padding: 14px 0 26px;
        }
        .section-title{
            display:flex;
            align-items:flex-end;
            justify-content:space-between;
            gap:10px;
            margin-bottom: 12px;
        }
        .section-title h2{
            margin:0;
            font-size: 18px;
            letter-spacing:.2px;
        }
        .section-title span{
            color: var(--muted);
            font-size: 13px;
        }
        .cards{
            display:grid;
            grid-template-columns: repeat(3, 1fr);
            gap:14px;
        }
        @media (max-width: 1050px){
            .cards{ grid-template-columns:1fr 1fr; }
        }
        @media (max-width: 700px){
            .cards{ grid-template-columns:1fr; }
        }
        .module{
            border-radius: 22px;
            padding: 16px;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.14);
            backdrop-filter: blur(10px);
        }
        .module .top{
            display:flex;
            align-items:flex-start;
            justify-content:space-between;
            gap:12px;
            margin-bottom: 10px;
        }
        .module h3{
            margin:0;
            font-size:15px;
            letter-spacing:.2px;
        }
        .module p{
            margin:0 0 12px;
            color:var(--muted);
            font-size:14px;
            line-height:1.6;
        }
        .pill{
            padding: 8px 10px;
            border-radius: 999px;
            font-size:12px;
            border:1px solid rgba(255,255,255,.16);
            background: rgba(255,255,255,.05);
            color: var(--muted);
            white-space:nowrap;
        }
        .footer{
            padding: 18px 0 26px;
            color: rgba(233,251,255,.68);
            font-size:13px;
        }
        .footer .bar{
            border-top: 1px solid rgba(255,255,255,.10);
            padding-top: 14px;
            display:flex;
            justify-content:space-between;
            gap:12px;
            flex-wrap:wrap;
        }
        .sr-only{
            position:absolute;
            width:1px; height:1px;
            padding:0; margin:-1px;
            overflow:hidden; clip:rect(0,0,0,0);
            white-space:nowrap; border:0;
        }
    </style>
</head>
<body>
<div class="bg-anim" aria-hidden="true"></div>
<div class="wrap">
    <header class="container">
        <div class="topbar">
            <a class="brand" href="#top" aria-label="Visitor Registration System">
                <div class="logo" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Logo">
                        <path d="M12 2.5l7.2 4.1v6.9c0 4.5-3.1 8.6-7.2 9.5-4.1-.9-7.2-5-7.2-9.5V6.6L12 2.5Z" stroke="rgba(233,251,255,.85)" stroke-width="1.6"/>
                        <path d="M8.3 12.1l2.3 2.3 5.1-5.1" stroke="rgba(41,211,199,.95)" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="brand-title">
                    <strong>Visitor Registration</strong>
                    <span>Fast, friendly, organized</span>
                </div>
            </a>

            <nav aria-label="Primary navigation">
                <a href="#modules">Modules</a>
                <a href="#how-it-works">How it works</a>
                <a href="#contact">Help</a>
            </nav>
        </div>
    </header>

    <main id="top" class="container hero">
        <div class="hero-grid">
            <section class="hero-card" aria-label="Welcome">
                <p class="pill" style="display:inline-flex; margin:0 0 10px; background:rgba(255,255,255,.04);">
                    Teal-blue futuristic landing page
                </p>
                <h1>Welcome to a smoother visitor check-in.</h1>
                <p class="lead">
                    Register visitors in seconds, keep records tidy, and make office arrivals feel welcoming.
                    This landing page is designed to be responsive, adorable, and user-friendly.
                </p>

                <div class="cta-row">
                    <a class="btn btn-primary" href="#modules" aria-label="Explore modules">
                        Explore modules
                        <span aria-hidden="true">→</span>
                    </a>
                    <a class="btn btn-secondary" href="#how-it-works" aria-label="See how it works">
                        How it works
                    </a>
                </div>

                <div class="mini-badges" aria-label="Highlights">
                    <div class="badge"><span class="dot" aria-hidden="true"></span> Mobile-ready layout</div>
                    <div class="badge"><span class="dot" aria-hidden="true" style="background:var(--cyan)"></span> Clear, friendly steps</div>
                    <div class="badge"><span class="dot" aria-hidden="true" style="background:#a7ff7a"></span> Organized visitor info</div>
                </div>

                <div class="grid" role="list" aria-label="Key benefits">
                    <article class="feature" role="listitem">
                        <div class="icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6h16M7 12h10M10 18h4" stroke="rgba(233,251,255,.9)" stroke-width="1.8" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <h3>Simple registration flow</h3>
                        <p>Reduce friction with a clean, guided experience for staff and visitors.</p>
                    </article>

                    <article class="feature" role="listitem">
                        <div class="icon" aria-hidden="true" style="background:rgba(66,167,255,.10); border-color:rgba(66,167,255,.25);">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 12l3 3 7-7" stroke="rgba(233,251,255,.9)" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 22c5.5 0 10-4.5 10-10S17.5 2 12 2 2 6.5 2 12s4.5 10 10 10Z" stroke="rgba(233,251,255,.45)" stroke-width="1.4"/>
                            </svg>
                        </div>
                        <h3>Accurate records</h3>
                        <p>Keep visitor details consistent so you can find what you need later.</p>
                    </article>

                    <article class="feature" role="listitem">
                        <div class="icon" aria-hidden="true" style="background:rgba(167,255,122,.10); border-color:rgba(167,255,122,.25);">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2v6l4 2" stroke="rgba(233,251,255,.9)" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke="rgba(233,251,255,.45)" stroke-width="1.4"/>
                            </svg>
                        </div>
                        <h3>Quick check-in</h3>
                        <p>Designed to feel fast, clear, and friendly even on smaller screens.</p>
                    </article>
                </div>
            </section>

            <aside class="side" aria-label="Quick info">
                <div class="panel">
                    <h2 id="contact">Need help?</h2>
                    <p>
                        If a module button doesn’t link yet, it’s likely “coming soon”.
                        Tell me which routes you want connected and I’ll wire them up.
                    </p>
                </div>

                <div class="panel">
                    <h2>Today’s vibes</h2>
                    <p>
                        Teal-blue glow, glassy cards, and responsive spacing for a modern landing experience.
                    </p>
                </div>
            </aside>
        </div>
    </main>

    <section id="modules" class="section container" aria-label="Modules">
        <div class="section-title">
            <h2>Modules</h2>
            <span>Start with what you need most</span>
        </div>

        <div class="cards">
            <article class="module">
                <div class="top">
                    <div>
                        <h3>Visitor Registration</h3>
                        <div class="pill" style="margin-top:8px; width:max-content;">Core</div>
                    </div>
                    <span aria-hidden="true" class="pill" style="border-color:rgba(41,211,199,.28); color:rgba(233,251,255,.82); background:rgba(41,211,199,.08);">
                        Ready
                    </span>
                </div>
                <p>Capture visitor details clearly and keep everything organized for quick access.</p>
                <a class="btn btn-secondary" href="#" aria-disabled="true" style="width:100%; text-align:center; pointer-events:none; opacity:.9;">
                    Open (coming soon)
                </a>
            </article>

            <article class="module">
                <div class="top">
                    <div>
                        <h3>Vehicle Tracking</h3>
                        <div class="pill" style="margin-top:8px; width:max-content;">Optional</div>
                    </div>
                    <span aria-hidden="true" class="pill" style="border-color:rgba(66,167,255,.28); color:rgba(233,251,255,.82); background:rgba(66,167,255,.08);">
                        Ready
                    </span>
                </div>
                <p>Associate vehicles with visitors to make arrivals smoother and reduce manual lookups.</p>
                <a class="btn btn-secondary" href="#" aria-disabled="true" style="width:100%; text-align:center; pointer-events:none; opacity:.9;">
                    Open (coming soon)
                </a>
            </article>

            <article class="module">
                <div class="top">
                    <div>
                        <h3>Complaint Form</h3>
                        <div class="pill" style="margin-top:8px; width:max-content;">Feedback</div>
                    </div>
                    <span aria-hidden="true" class="pill" style="border-color:rgba(255,198,41,.28); color:rgba(233,251,255,.82); background:rgba(255,198,41,.10);">
                        Coming
                    </span>
                </div>
                <p>Let visitors share concerns easily so your team can respond faster.</p>
                <a class="btn btn-secondary" href="#" aria-disabled="true" style="width:100%; text-align:center; pointer-events:none; opacity:.9;">
                    Open (coming soon)
                </a>
            </article>
        </div>
    </section>

    <section id="how-it-works" class="section container" aria-label="How it works">
        <div class="section-title">
            <h2>How it works</h2>
            <span>Friendly steps for busy days</span>
        </div>

        <div class="cards">
            <article class="module">
                <h3 style="margin-top:0;">1. Check in</h3>
                <p>Choose the right module and add visitor details with a simple flow.</p>
            </article>
            <article class="module">
                <h3 style="margin-top:0;">2. Stay organized</h3>
                <p>Records stay tidy, so staff can find info quickly when needed.</p>
            </article>
            <article class="module">
                <h3 style="margin-top:0;">3. Get feedback</h3>
                <p>Capture complaints and follow-ups to improve the experience over time.</p>
            </article>
        </div>
    </section>

    <footer class="footer container" aria-label="Footer">
        <div class="bar">
            <div>Copyright 2026 Visitor Registration System</div>
            <div>
                <a href="#top" style="color:inherit; text-decoration: none; border-bottom: 1px dashed rgba(255,255,255,.22);">
                    Back to top
                </a>
            </div>
        </div>
    </footer>
</div>
</body>
</html>