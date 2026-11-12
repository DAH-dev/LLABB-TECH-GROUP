<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $settings?->seo_titre ?: 'LLABB TECH GROUP - Digital, Technologie, IA, Marketing')</title>
    <meta name="description" content="@yield('description', $settings?->seo_description ?: 'LLABB TECH GROUP - Entreprise spécialisée dans le numérique, la technologie, l\'intelligence artificielle et le marketing digital.')">
    

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon-32.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon-180.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/universal-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/hover3d-effects.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/auto-progress-bar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/globals.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
      
/* Logo de l'en-tête (horizontal) : on garde les règles du template, on ajuste seulement */
.header .logo img.logo-img { object-position: left center; }

@media (min-width: 1025px) and (max-width: 1279px) {
    .header .logo { width: 140px; }
}
@media (min-width: 1280px) and (max-width: 1439px) {
    .header .logo { width: 175px; }
}
@media (max-width: 1024px) {
    .header .logo { width: 40%; min-width: 0; }
    /* Le bouton "devis" est invisible sur mobile mais prenait quand même sa place */
    .header .actions .btn-get-quotes { display: none; }
    .header .actions .theme-switcher { margin: 0 8px; }
    .header .actions .theme-switcher .theme-toggle-btn {
        width: 32px;
        height: 32px;
        padding: 4px;
    }
    .header .actions .theme-switcher .theme-toggle-btn svg {
        width: 18px;
        height: 18px;
    }
}

        /* Sous-menus de l'en-tête (scopés sur .nav-menu .has-submenu) */
        .nav-menu .has-submenu { position: relative; }
        .nav-menu .has-submenu > .submenu-wrap {
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .nav-menu .submenu-toggle {
            background: none;
            border: none;
            padding: 4px;
            cursor: pointer;
            color: inherit;
            display: inline-flex;
            align-items: center;
        }
        .nav-menu .submenu-toggle svg {
            width: 12px;
            height: 12px;
            transition: transform .2s ease;
        }
        .nav-menu .submenu {
            list-style: none;
            margin: 0;
            padding: 8px 0;
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 180px;
            background: #072066;
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 8px;
            box-shadow: 0 10px 24px rgba(0,0,0,0.25);
            opacity: 0;
            visibility: hidden;
            transform: translateY(6px);
            transition: opacity .2s ease, transform .2s ease, visibility .2s ease;
            z-index: 50;
        }
        .nav-menu .submenu li { display: block; margin: 0; }
        .nav-menu .submenu a {
            display: block;
            padding: 10px 18px;
            color: #fff;
            font-size: 0.92rem;
            white-space: nowrap;
        }
        .nav-menu .submenu a:hover { background: rgba(255,255,255,0.1); }

        @media (min-width: 992px) {
            .nav-menu .has-submenu:hover > .submenu,
            .nav-menu .has-submenu:focus-within > .submenu {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
            .nav-menu .has-submenu:hover .submenu-toggle svg { transform: rotate(180deg); }
        }

        @media (max-width: 991px) {
            .nav-menu .submenu {
                position: static;
                display: none;
                opacity: 1;
                visibility: visible;
                transform: none;
                box-shadow: none;
                border: none;
                background: transparent;
                padding: 0 0 0 16px;
            }
            .nav-menu .has-submenu.open > .submenu { display: block; }
            .nav-menu .has-submenu.open .submenu-toggle svg { transform: rotate(180deg); }
        }

        /* Sélecteur de langue (menu déroulant) */
        .lang-dropdown {
            position: relative;
            margin-right: 10px;
            flex-shrink: 0;
        }
        .lang-dropdown-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: none;
            border: 1px solid currentColor;
            border-radius: 20px;
            padding: 6px 10px;
            font-size: 0.8rem;
            font-weight: 600;
            line-height: 1;
            cursor: pointer;
            color: #fff;
            transition: background .2s ease, color .2s ease;
        }
        .lang-dropdown-btn:hover { background: rgba(128, 128, 128, 0.18); }
        .lang-dropdown-btn svg { width: 16px; height: 16px; flex-shrink: 0; }
        .lang-dropdown-btn .chev { width: 10px; height: 10px; transition: transform .2s ease; }
        .lang-dropdown.open .lang-dropdown-btn .chev { transform: rotate(180deg); }

        /* La liste est déplacée dans <body> par le script : elle ne peut plus être coupée par l'en-tête */
        .lang-dropdown-menu {
            list-style: none;
            margin: 0;
            padding: 6px 0;
            position: fixed;
            top: 0;
            left: 0;
            min-width: 150px;
            background: #072066;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.25);
            opacity: 0;
            visibility: hidden;
            transform: translateY(6px);
            transition: opacity .2s ease, transform .2s ease, visibility .2s ease;
            z-index: 9999;
        }
        .lang-dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .lang-dropdown-menu li { margin: 0; list-style: none; }
        .lang-dropdown-menu button {
            display: block;
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            color: #fff;
            font-size: 0.9rem;
            padding: 10px 16px;
            cursor: pointer;
        }
        .lang-dropdown-menu button:hover { background: rgba(255, 255, 255, 0.1); }
        .lang-dropdown-menu button.active { background: rgba(30, 136, 229, 0.35); font-weight: 600; }

@media (max-width: 575px) {
    .lang-dropdown { margin-right: 4px; }
    .lang-dropdown-btn { padding: 6px 8px; gap: 4px; }
    .lang-dropdown-btn svg { width: 14px; height: 14px; }
    .lang-dropdown-btn .chev { display: none; }
}
@media (max-width: 420px) {
    .lang-dropdown-btn > svg:first-child { display: none; }
}

        /* Masquer l'interface par défaut de Google Translate */
        #google_translate_element { display: none; }
        .goog-te-banner-frame,
        .goog-te-banner-frame.skiptranslate,
        iframe.skiptranslate,
        .VIpgJd-ZVi9od-ORHb-OEVmcd,
        .VIpgJd-ZVi9od-aZ2wEe-wOHMyf,
        .goog-te-balloon-frame,
        #goog-gt-tt { display: none !important; }
        body { top: 0 !important; }
        .goog-text-highlight { background: none !important; box-shadow: none !important; }
    </style>
</head>
<body class="body-1">
    <div id="google_translate_element"></div>

    <div id="particles-js" class="particles-background"></div>

    <div id="page-loader" class="page-loader">
        <div class="loader-container">
            <div class="loader-content">
                <div class="loader-spinner">
                    <div class="spinner-ring">
                        <div></div>
                    </div>
                </div>
                <div class="loader-progress">
                    <div class="progress-bar"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="header">
        <div class="container d-flex-between">
            <div class="logo position-relative">
                <img class="image logo-img" id="siteLogo"
                     src="{{ asset('assets/images/logo-horizontal-negatif.png') }}"
                     data-light="{{ asset('assets/images/logo-horizontal-couleur.png') }}"
                     data-dark="{{ asset('assets/images/logo-horizontal-negatif.png') }}"
                     alt="LLABB TECH GROUP">
                <a class="overlay-link" href="{{ route('home') }}"></a>
            </div>

            <nav class="navbar" id="navbar">
                <ul class="nav-menu">
                    <li><a href="{{ route('home') }}" class="nav-link">Accueil</a></li>
                    <li><a href="{{ route('about') }}" class="nav-link">À propos</a></li>

                    <li class="has-submenu">
                        <span class="submenu-wrap">
                            <a href="{{ route('services') }}" class="nav-link">Services</a>
                            <button type="button" class="submenu-toggle" aria-label="Ouvrir le sous-menu Services">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </button>
                        </span>
                        <ul class="submenu">
                            <li><a href="{{ route('pricing') }}">Tarifs</a></li>
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <span class="submenu-wrap">
                            <a href="{{ route('team') }}" class="nav-link">Équipe</a>
                            <button type="button" class="submenu-toggle" aria-label="Ouvrir le sous-menu Équipe">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </button>
                        </span>
                        <ul class="submenu">
                            <li><a href="{{ route('portfolio') }}">Portfolio</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('blog') }}" class="nav-link">Blog</a></li>
                    <li><a href="{{ route('nouvelles') }}" class="nav-link">Nouvelles</a></li>
                    <li><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
                </ul>
            </nav>

            <div class="actions d-flex-center">
                <div class="lang-dropdown notranslate" translate="no" id="langDropdown">
                    <button type="button" class="lang-dropdown-btn" id="langDropdownBtn" aria-haspopup="true" aria-expanded="false" aria-label="Langue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                        <span class="lang-current">FR</span>
                        <svg class="chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                    </button>
                    <ul class="lang-dropdown-menu notranslate" translate="no" id="langDropdownMenu">
                        <li><button type="button" data-lang="fr">Français</button></li>
                        <li><button type="button" data-lang="en">English</button></li>
                        <li><button type="button" data-lang="es">Español</button></li>
                        <li><button type="button" data-lang="de">Deutsch</button></li>
                        <li><button type="button" data-lang="zh-CN">中文</button></li>
                    </ul>
                </div>
                <a href="#" class="btn btn-get-quotes">Demander un devis</a>
                <div class="theme-switcher">
                    <button id="theme-toggle" class="theme-toggle-btn" aria-label="Basculer le mode sombre">
                        <svg id="theme-toggle-light-icon" class="sun-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.106a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.894 17.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.894 17.894a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM4.5 12a.75.75 0 01-.75.75H1.5a.75.75 0 010-1.5h2.25a.75.75 0 01.75.75zM6.106 6.106a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z"/></svg>
                        <svg id="theme-toggle-dark-icon" class="moon-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 004.463-.69a.75.75 0 01.981.981A10.501 10.501 0 0118 19.5a10.5 10.5 0 01-10.5-10.5 10.5 10.5 0 011.718-5.528.75.75 0 01.81-.162z" clip-rule="evenodd" /></svg>
                    </button>
                </div>
            </div>

            <button class="mobile-menu-toggle" id="mobile-menu-toggle">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
        </div>
    </header>

    @yield('content')

    <!-- Footer -->
    <footer class="footer pt-5 pb-5">
        <div class="footer-main">
            <div class="container">
                <div class="footer-content">
                    <div class="footer-section footer-about">
                        <div class="footer-logo">
                           <img src="{{ asset('assets/images/logo-horizontal-negatif.png') }}" alt="LLABB TECH GROUP" style="height: 40px; width: auto; max-width: 220px;">
                        </div>
                        <p class="footer-description">
                            <span translate="no">LLABB TECH GROUP</span> accompagne les entreprises avec des solutions numériques, technologiques et d'intelligence artificielle innovantes.
                        </p>
                    </div>

                    <div class="footer-section footer-links">
                        <h4 class="footer-title">Navigation</h4>
                        <ul class="footer-menu">
                            <li><a href="{{ route('home') }}" class="footer-link">Accueil</a></li>
                            <li><a href="{{ route('about') }}" class="footer-link">À propos</a></li>
                            <li><a href="{{ route('team') }}" class="footer-link">Équipe</a></li>
                            <li><a href="{{ route('services') }}" class="footer-link">Services</a></li>
                            <li><a href="{{ route('portfolio') }}" class="footer-link">Portfolio</a></li>
                            <li><a href="{{ route('blog') }}" class="footer-link">Blog</a></li>
                            <li><a href="{{ route('nouvelles') }}" class="footer-link">Nouvelles</a></li>
                            <li><a href="{{ route('pricing') }}" class="footer-link">Tarifs</a></li>
                            <li><a href="{{ route('temoignages') }}" class="footer-link">Témoignages</a></li>
                            <li><a href="{{ route('faq') }}" class="footer-link">FAQ</a></li>
                            <li><a href="{{ route('legal') }}" class="footer-link">Mentions légales</a></li>
                        </ul>
                    </div>

<div class="footer-section footer-contact">
    <h4 class="footer-title">Contact</h4>
    <div class="footer-contact-info">
        <div class="contact-item">
            <div class="contact-text">
                <span class="contact-label">Email</span>
                <span class="contact-value" translate="no">{{ $settings?->email_contact ?: 'contact@llabbtechgroup.com' }}</span>
            </div>
        </div>
        @if ($settings?->telephone)
            <div class="contact-item">
                <div class="contact-text">
                    <span class="contact-label">Téléphone</span>
                    <span class="contact-value" translate="no">{{ $settings->telephone }}</span>
                </div>
            </div>
        @endif
        @if ($settings?->adresse)
            <div class="contact-item">
                <div class="contact-text">
                    <span class="contact-label">Adresse</span>
                    <span class="contact-value">{{ $settings->adresse }}</span>
                </div>
            </div>
        @endif
    </div>

    <div class="social-links" style="margin-top:16px;">
        @include('partials.social-links', ['s' => $settings])
    </div>
</div>

                    <div class="footer-section footer-newsletter">
    <h4 class="footer-title">Newsletter</h4>
    <p class="newsletter-description">Abonnez-vous pour recevoir nos actualités et conseils tech.</p>
    <form class="newsletter-form" id="footerNewsletterForm" action="{{ route('newsletter.subscribe') }}" method="POST">
    @csrf
        <div class="newsletter-input-group">
           <input type="email" name="email" class="newsletter-input" placeholder="Entrez votre adresse e-mail" required>
            <button type="submit" class="newsletter-btn" style="display:flex; align-items:center; justify-content:center; font-size:0.85rem; font-weight:600;">
    OK
</button>
        </div>
    </form>

    <div class="footer-copyright">
        <p><span translate="no">LLABB TECH GROUP</span> © {{ date('Y') }}</p>
    </div>
</div>
                </div>
            </div>
        </div>
    </footer>

    <button class="scroll-to-top" id="scrollToTop" aria-label="Retour en haut">
        <svg viewBox="0 0 24 24">
            <path d="M7 14l5-5 5 5z"/>
        </svg>
    </button>

    <script src="{{ asset('assets/lib/particles/particles.min.js') }}"></script>
    <script src="{{ asset('assets/lib/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/lib/hover3dBgEffects/hover3d-bg-effects.js') }}"></script>
    <script src="{{ asset('assets/lib/typed/typed.umd.js') }}"></script>

    <script src="{{ asset('assets/js/custom-isotope.js') }}"></script>
    <script src="{{ asset('assets/js/testimonials.js') }}"></script>
    <script src="{{ asset('assets/js/auto-progress-bar.js') }}"></script>
    <script src="{{ asset('assets/js/animate-counters.js') }}"></script>
    <script src="{{ asset('assets/js/universal-slider.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/contact-form-demo.js') }}"></script> -->

    <script src="{{ asset('assets/data/particles-config.js') }}"></script>
    <script src="{{ asset('assets/data/services.js') }}"></script>

    <script src="{{ asset('assets/js/main-01.js') }}"></script>

    <script>
    window.addEventListener('load', () => {
        setTimeout(() => {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    delay: 100,
                    once: false,
                    mirror: true,
                    offset: 50,
                    easing: 'ease-out-cubic'
                });
            }
        }, 2000);
    });

    // Sous-menus : ouverture au clic sur la flèche (mobile)
    document.querySelectorAll('.nav-menu .submenu-toggle').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            btn.closest('.has-submenu').classList.toggle('open');
        });
    });
    </script>

    <script>
    // Traduction automatique (Google Translate) : FR = langue d'origine
    (function () {
        var AVAILABLE = ['en', 'es', 'de', 'zh-CN'];

        function getLang() {
            var m = document.cookie.match(/(?:^|; )googtrans=\/fr\/([A-Za-z-]+)/);
            return (m && AVAILABLE.indexOf(m[1]) !== -1) ? m[1] : 'fr';
        }

        function setLang(lang) {
            var expire = 'expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/';
            if (lang === 'fr') {
                document.cookie = 'googtrans=; ' + expire;
                document.cookie = 'googtrans=; ' + expire + '; domain=' + location.hostname;
                document.cookie = 'googtrans=; ' + expire + '; domain=.' + location.hostname;
            } else {
                document.cookie = 'googtrans=/fr/' + lang + '; path=/';
            }
            location.reload();
        }

        var current = getLang();
        var dropdown = document.getElementById('langDropdown');
        var dropdownBtn = document.getElementById('langDropdownBtn');
        var menu = document.getElementById('langDropdownMenu');

        // La liste est placée directement dans <body> : l'en-tête ne peut plus la couper
        document.body.appendChild(menu);

        // Afficher la langue active
        dropdown.querySelector('.lang-current').textContent = current.split('-')[0].toUpperCase();
        menu.querySelectorAll('button').forEach(function (btn) {
            if (btn.getAttribute('data-lang') === current) {
                btn.classList.add('active');
            }
            btn.addEventListener('click', function () {
                setLang(btn.getAttribute('data-lang'));
            });
        });

        // Positionner la liste sous le bouton, sans jamais dépasser de l'écran
        function placeMenu() {
            var r = dropdownBtn.getBoundingClientRect();
            var w = menu.offsetWidth || 150;
            var left = Math.min(Math.max(8, r.right - w), window.innerWidth - w - 8);
            menu.style.top = (r.bottom + 8) + 'px';
            menu.style.left = left + 'px';
        }

        function openMenu() {
            placeMenu();
            dropdown.classList.add('open');
            menu.classList.add('show');
            dropdownBtn.setAttribute('aria-expanded', 'true');
        }

        function closeMenu() {
            dropdown.classList.remove('open');
            menu.classList.remove('show');
            dropdownBtn.setAttribute('aria-expanded', 'false');
        }

        dropdownBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            if (menu.classList.contains('show')) { closeMenu(); } else { openMenu(); }
        });
        document.addEventListener('click', function (e) {
            if (!dropdown.contains(e.target) && !menu.contains(e.target)) {
                closeMenu();
            }
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeMenu();
        });
        window.addEventListener('resize', function () {
            if (menu.classList.contains('show')) placeMenu();
        });
        window.addEventListener('scroll', function () {
            if (menu.classList.contains('show')) placeMenu();
        }, { passive: true });

        // Le script de Google n'est chargé que si une autre langue que le français est choisie
        if (current !== 'fr') {
            window.googleTranslateElementInit = function () {
                new google.translate.TranslateElement({
                    pageLanguage: 'fr',
                    includedLanguages: AVAILABLE.join(','),
                    autoDisplay: false
                }, 'google_translate_element');
            };
            var s = document.createElement('script');
            s.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
            document.body.appendChild(s);
        }

        // Couleur du bouton + version du logo :
        // sur mobile on suit le bouton hamburger (le menu des liens est replié),
        // sur ordinateur on suit les liens du menu. Texte clair = fond foncé = logo blanc ;
        // texte foncé = fond blanc = logo en couleur.
        var refLink = document.querySelector('.nav-menu .nav-link');
        var burger = document.querySelector('.mobile-menu-toggle');
        var burgerLine = document.querySelector('.mobile-menu-toggle .hamburger-line');
        var logo = document.getElementById('siteLogo');

        function setLogo(color) {
            if (!logo) return;
            var n = color.match(/[\d.]+/g);
            if (!n || n.length < 3) return;
            var brightness = 0.299 * n[0] + 0.587 * n[1] + 0.114 * n[2];
            var wanted = brightness > 140 ? logo.getAttribute('data-dark') : logo.getAttribute('data-light');
            if (logo.getAttribute('src') !== wanted) logo.setAttribute('src', wanted);
        }

        function syncColor() {
            var color = null;
            if (burger && burgerLine && getComputedStyle(burger).display !== 'none') {
                color = getComputedStyle(burgerLine).backgroundColor;
                if (color === 'rgba(0, 0, 0, 0)' || color === 'transparent') {
                    color = getComputedStyle(burgerLine).color;
                }
            } else if (refLink) {
                color = getComputedStyle(refLink).color;
            }
            if (color) {
                dropdownBtn.style.color = color;
                setLogo(color);
            }
        }

        syncColor();
        window.addEventListener('load', syncColor);
        ['scroll', 'resize', 'click'].forEach(function (ev) {
            window.addEventListener(ev, function () {
                syncColor();
                setTimeout(syncColor, 350);
            }, { passive: true });
        });
        new MutationObserver(syncColor).observe(document.documentElement, { attributes: true });
        new MutationObserver(syncColor).observe(document.body, { attributes: true });
        var headerEl = document.querySelector('.header');
        if (headerEl) new MutationObserver(syncColor).observe(headerEl, { attributes: true });
    })();
    </script>

    @yield('scripts')
</body>
</html>