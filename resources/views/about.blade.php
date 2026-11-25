@extends('layouts.app')

@section('title', 'À propos - LLABB TECH GROUP')

@section('content')
<style>
    /* Hero À propos (compact) */
    .about-hero {
        position: relative;
        overflow: hidden;
        padding: 90px 0 46px;
    }
    .about-hero-inner {
        max-width: 720px;
    }
    .about-eyebrow {
        display: inline-block;
        color: var(--color-primary, #1e88e5);
        font-weight: 600;
        font-size: 0.78rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-bottom: 0.3rem;
    }
    .about-hero-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 0.85rem 2rem;
        margin-top: 1.15rem;
        padding-top: 0.9rem;
        border-top: 1px solid rgba(255, 255, 255, 0.16);
    }
    .about-hero-stat strong {
        display: block;
        color: var(--color-primary, #1e88e5);
        font-size: 1.1rem;
        font-weight: 700;
        line-height: 1.2;
    }
    .about-hero-stat span {
        color: rgba(255, 255, 255, 0.82);
        font-size: 0.84rem;
    }

    /* Écrase le "gap: 8rem" de .main-content dans style.css */
    .about-page-body {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
    }
    .about-page-body .main-content {
        gap: 1.75rem !important;
    }
    .about-page-body .heading-lg {
        margin-bottom: 0 !important;
        font-size: 1.85rem;
    }

    .about-sec-head {
        margin-bottom: 0.85rem;
    }
    .about-sec-head h2 {
        margin: 0;
    }

    /* Histoire */
    .about-page-body .about-our-company {
        align-items: center;
    }
    .about-page-body .about-our-company .about-info,
    .about-page-body .about-our-company .about-texts {
        padding-bottom: 0 !important;
    }
    .about-page-body .about-our-company .about-image {
        height: auto;
        max-height: 300px;
    }
    .about-page-body .about-our-company .about-image img {
        max-height: 300px;
        object-fit: cover;
        border-radius: 12px;
    }

    /* Mission & Vision */
    .about-split {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    .about-split-card {
        padding: 1.25rem 1.4rem;
        border-radius: 12px;
        border: 1px solid rgba(128, 128, 128, 0.25);
        background: rgba(128, 128, 128, 0.06);
        border-top: 3px solid var(--color-primary, #1e88e5);
    }
    .about-split-card.is-vision {
        border-top-color: #072066;
        background: rgba(7, 32, 102, 0.06);
    }
    .about-split-card h3 {
        font-size: 1.05rem;
        margin: 0 0 0.4rem;
        color: var(--color-primary, #1e88e5);
    }
    .about-split-card p {
        font-size: 0.95rem;
        line-height: 1.55;
        margin: 0;
    }

    /* Valeurs */
    .about-values {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .about-values li {
        display: grid;
        grid-template-columns: 200px 1fr;
        gap: 1rem;
        padding: 0.75rem 0.85rem;
        border-top: 1px solid rgba(128, 128, 128, 0.22);
        align-items: baseline;
        border-radius: 8px;
        transition: background 0.2s ease;
    }
    .about-values li:hover {
        background: rgba(128, 128, 128, 0.05);
    }
    .about-values li:last-child {
        border-bottom: 1px solid rgba(128, 128, 128, 0.22);
    }
    .about-values .name {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--color-primary, #1e88e5);
    }
    .about-values .num {
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.15rem 0.45rem;
        border-radius: 999px;
        background: rgba(30, 136, 229, 0.14);
        color: var(--color-primary, #1e88e5);
    }
    .about-values p {
        margin: 0;
        font-size: 0.94rem;
        line-height: 1.5;
        opacity: 0.88;
    }

    /* Expertise (accordéon) */
    .about-accordion {
        display: flex;
        flex-direction: column;
        gap: 0.45rem;
    }
    .about-exp-item {
        border: 1px solid rgba(128, 128, 128, 0.24);
        border-radius: 10px;
        background: rgba(128, 128, 128, 0.05);
        padding: 0 1.1rem;
        transition: border-color 0.2s ease, background 0.2s ease;
    }
    .about-exp-item[data-open="true"] {
        border-color: var(--color-primary, #1e88e5);
        background: rgba(30, 136, 229, 0.06);
    }
    .about-exp-item button {
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.8rem 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 0.75rem;
        font-size: 1rem;
        font-weight: 600;
        color: inherit;
    }
    .about-exp-item .about-exp-panel {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }
    .about-exp-item[data-open="true"] .about-exp-panel {
        max-height: 160px;
    }
    .about-exp-item p {
        padding-bottom: 0.8rem;
        margin: 0;
        font-size: 0.93rem;
        line-height: 1.5;
        opacity: 0.86;
    }
    .about-exp-item .plus {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(30, 136, 229, 0.14);
        color: var(--color-primary, #1e88e5);
        font-weight: 700;
        flex-shrink: 0;
        transition: transform 0.2s ease, background 0.2s ease, color 0.2s ease;
    }
    .about-exp-item[data-open="true"] .plus {
        transform: rotate(45deg);
        background: var(--color-primary, #1e88e5);
        color: #fff;
    }

    /* Équipe */
    .about-team .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 1rem;
    }
    .about-team .member-card {
        background: rgba(128, 128, 128, 0.06);
        border: 1px solid rgba(128, 128, 128, 0.25);
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.2s ease, border-color 0.2s ease;
    }
    .about-team .member-card:hover {
        transform: translateY(-3px);
        border-color: var(--color-primary, #1e88e5);
    }
    .about-team .member-photo {
        width: 100%;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        background: rgba(128, 128, 128, 0.12);
    }
    .about-team .member-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .about-team .member-body {
        padding: 0.9rem 0.85rem 1.05rem;
        text-align: center;
    }
    .about-team .member-name {
        display: block;
        font-weight: 700;
        font-size: 0.98rem;
    }
    .about-team .member-role {
        display: block;
        margin-top: 0.15rem;
        font-size: 0.84rem;
        font-weight: 600;
        color: var(--color-primary, #1e88e5);
    }
    .about-team .member-socials {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 0.65rem;
    }
    .about-team .member-socials a {
        width: 30px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(30, 136, 229, 0.14);
        color: var(--color-primary, #1e88e5);
        transition: background 0.2s ease, color 0.2s ease;
    }
    .about-team .member-socials a:hover {
        background: var(--color-primary, #1e88e5);
        color: #fff;
    }
    .about-team .member-socials svg {
        width: 15px;
        height: 15px;
    }

    /* Bandeau CTA final */
    .about-cta-banner {
        padding: 1.45rem 1.65rem;
        border-radius: 12px;
        background: #072066;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.25rem;
        flex-wrap: wrap;
    }
    .about-cta-banner h3,
    .about-cta-banner p {
        color: #ffffff !important;
        margin: 0;
    }
    .about-cta-banner h3 {
        font-size: 1.2rem;
        margin-bottom: 0.25rem;
    }
    .about-cta-banner p {
        font-size: 0.9rem;
        opacity: 0.86;
        max-width: 54ch;
        line-height: 1.45;
    }

    @media (max-width: 800px) {
        .about-split { grid-template-columns: 1fr; }
        .about-values li { grid-template-columns: 1fr; gap: 0.3rem; }
    }
</style>

<!-- Hero compact (pages intérieures) -->
<section class="about-hero">
    <div class="container">
        <div class="about-hero-inner">
            <span class="about-eyebrow" data-aos="fade-down" data-aos-duration="600">À propos de LLABB TECH GROUP</span>
            <h1 class="text-white heading-hero text-shadow" data-aos="fade-down" data-aos-duration="800" data-aos-delay="100">
                Nous construisons des systèmes IA qui comptent.
            </h1>

            <p class="text-white text-shadow--strong pt-2" data-aos="fade-up" data-aos-duration="600" data-aos-delay="300">
                LLABB TECH GROUP est une agence basée à Abidjan qui conçoit des solutions digitales, IT et d'intelligence artificielle pour des entreprises qui veulent avancer plus vite.
            </p>

            <div class="about-hero-stats" data-aos="fade-up" data-aos-duration="500" data-aos-delay="500">
                <div class="about-hero-stat">
                    <strong>5 pôles</strong>
                    <span>Domaines d'expertise</span>
                </div>
                <div class="about-hero-stat">
                    <strong>Abidjan</strong>
                    <span>Côte d'Ivoire</span>
                </div>
                <div class="about-hero-stat">
                    <strong>100 % Sur-mesure</strong>
                    <span>Chaque projet</span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="main d-flex-center about-page-body">
    <div class="container main-content">

        <!-- Histoire -->
        <section class="about-section about-our-company">
            <div class="about-info">
                <div class="about-texts">
                    <span class="about-eyebrow">Notre histoire</span>
                    <h2 class="about-info-title">Une conviction simple : la technologie comme levier de croissance</h2>
                    <p>
                        LLABB TECH GROUP est né d'une conviction simple : la technologie doit être un levier
                        concret de croissance, et non un simple effet de mode. L'équipe fondatrice réunit des
                        profils venus du développement, de l'intelligence artificielle et du marketing, autour
                        d'une même exigence — livrer des solutions qui produisent des résultats mesurables.
                    </p>
                    <p>
                        Depuis ses débuts, l'entreprise a fait le choix de l'excellence opérationnelle : chaque
                        projet est pensé comme une réponse sur-mesure aux réalités et aux ambitions du client,
                        plutôt que comme une solution standardisée appliquée telle quelle.
                    </p>
                </div>
            </div>

            <div class="about-image" data-hover-3d>
                <img src="{{ asset('assets/images/backgrounds/computer-code.png') }}" alt="Notre histoire - LLABB TECH GROUP">
            </div>
        </section>

        <!-- Mission & Vision -->
        <section class="about-section">
            <div class="about-split">
                <div class="about-split-card">
                    <span class="about-eyebrow">Cap quotidien</span>
                    <h3>Notre Mission</h3>
                    <p>Rendre la technologie accessible et rentable pour toute entreprise, à travers des solutions digitales, des outils d'IA et des stratégies marketing qui génèrent un impact concret.</p>
                </div>
                <div class="about-split-card is-vision">
                    <span class="about-eyebrow">Horizon</span>
                    <h3>Notre Vision</h3>
                    <p>Devenir une référence du numérique et de l'intelligence artificielle en Afrique de l'Ouest, reconnue pour la qualité de ses réalisations et la confiance durable qu'elle construit.</p>
                </div>
            </div>
        </section>

        <!-- Valeurs -->
        <section class="about-section">
            <div class="about-sec-head">
                <span class="about-eyebrow">Ce qui nous guide</span>
                <h2 class="heading-lg">Nos valeurs</h2>
            </div>
            <ul class="about-values">
                <li>
                    <span class="name"><span class="num">01</span>Innovation</span>
                    <p>Nous explorons en continu les technologies émergentes — IA, automatisation, données — pour proposer des solutions à la pointe plutôt que suivre la tendance.</p>
                </li>
                <li>
                    <span class="name"><span class="num">02</span>Excellence</span>
                    <p>Chaque livrable répond à des standards élevés de qualité, de performance et de sécurité, du premier prototype à la mise en production.</p>
                </li>
                <li>
                    <span class="name"><span class="num">03</span>Transparence</span>
                    <p>Une relation client fondée sur l'écoute, des points d'étape réguliers et un suivi rigoureux, sans zones d'ombre sur l'avancement du projet.</p>
                </li>
                <li>
                    <span class="name"><span class="num">04</span>Agilité</span>
                    <p>Des méthodes de travail qui s'adaptent aux besoins évolutifs de chaque client, du cadrage initial jusqu'à la mise en ligne.</p>
                </li>
                <li>
                    <span class="name"><span class="num">05</span>Impact</span>
                    <p>Nous mesurons notre réussite à la valeur concrète que nos solutions apportent — visibilité, efficacité, croissance.</p>
                </li>
            </ul>
        </section>

        <!-- Expertise (accordéon) -->
        <section class="about-section">
            <div class="about-sec-head">
                <span class="about-eyebrow">Savoir-faire</span>
                <h2 class="heading-lg">Nos domaines d'expertise</h2>
            </div>
            <div class="about-accordion" id="aboutAccordion">
                <div class="about-exp-item" data-open="true">
                    <button type="button">
                        Développement digital
                        <span class="plus">+</span>
                    </button>
                    <div class="about-exp-panel">
                        <p>Sites web, applications et plateformes sur-mesure, conçus pour évoluer avec l'activité du client.</p>
                    </div>
                </div>
                <div class="about-exp-item" data-open="false">
                    <button type="button">
                        Solutions IT
                        <span class="plus">+</span>
                    </button>
                    <div class="about-exp-panel">
                        <p>Infrastructures, intégrations et architectures back-office pensées pour la fiabilité et la sécurité.</p>
                    </div>
                </div>
                <div class="about-exp-item" data-open="false">
                    <button type="button">
                        Intelligence artificielle
                        <span class="plus">+</span>
                    </button>
                    <div class="about-exp-panel">
                        <p>Automatisation, chatbots et outils d'aide à la décision, intégrés aux processus existants de l'entreprise.</p>
                    </div>
                </div>
                <div class="about-exp-item" data-open="false">
                    <button type="button">
                        Marketing & communication digitale
                        <span class="plus">+</span>
                    </button>
                    <div class="about-exp-panel">
                        <p>Stratégie de contenu, référencement et présence en ligne, construits autour d'objectifs mesurables.</p>
                    </div>
                </div>
                <div class="about-exp-item" data-open="false">
                    <button type="button">
                        Conseil & innovation
                        <span class="plus">+</span>
                    </button>
                    <div class="about-exp-panel">
                        <p>Accompagnement stratégique et formation des équipes pour ancrer durablement les nouveaux outils.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Équipe -->
        <section class="about-section team about-team">
            <div class="about-sec-head">
                <span class="about-eyebrow">Les visages derrière LLABB</span>
                <h2 class="heading-lg">Notre équipe</h2>
            </div>
            <div class="team-grid">
                @foreach ($teamMembers as $member)
                    <div class="member-card" data-aos="fade-up" data-aos-delay="0">
                        <div class="member-photo">
                            <img src="{{ $member->photo ? asset('assets/images/team/' . $member->photo) : asset('assets/images/testimonials/face-01.png') }}" alt="{{ $member->nom }}">
                        </div>
                        <div class="member-body">
                            <span class="member-name">{{ $member->nom }}</span>
                            <span class="member-role">{{ $member->poste }}</span>

                            @if ($member->lien_linkedin)
                                <div class="member-socials">
                                    <a href="{{ $member->lien_linkedin }}" target="_blank" rel="noopener" aria-label="LinkedIn">
                                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Bandeau CTA final -->
        <div class="about-cta-banner">
            <div>
                <h3>Prêt à accélérer votre transformation digitale ?</h3>
                <p>Échangeons sur vos enjeux IA, web ou IT pour bâtir une solution adaptée à votre croissance.</p>
            </div>
            <a href="{{ route('contact') }}" class="btn btn-primary">Discuter avec notre équipe</a>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('#aboutAccordion .about-exp-item button').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var item = btn.closest('.about-exp-item');
            var isOpen = item.getAttribute('data-open') === 'true';
            document.querySelectorAll('#aboutAccordion .about-exp-item').forEach(function (other) {
                other.setAttribute('data-open', 'false');
            });
            if (!isOpen) {
                item.setAttribute('data-open', 'true');
            }
        });
    });
});
</script>
@endsection