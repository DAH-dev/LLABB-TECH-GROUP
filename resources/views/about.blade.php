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
        color: #ffffff;
        font-size: 1.45rem;
        font-weight: 800;
        line-height: 1.15;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.35);
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
    .about-values > li {
        display: grid;
        grid-template-columns: 200px minmax(0, 1fr);
        gap: 1rem;
        padding: 0.75rem 0.85rem;
        border-top: 1px solid rgba(128, 128, 128, 0.22);
        align-items: baseline;
        border-radius: 8px;
        transition: background 0.2s ease;
    }
    .about-values > li:hover {
        background: rgba(128, 128, 128, 0.05);
    }
    .about-values > li:last-child {
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
    .about-values .about-value-desc {
        min-width: 0;
        font-size: 0.94rem;
        line-height: 1.55;
        opacity: 0.88;
    }
    .about-values .about-value-desc p {
        margin: 0 0 0.45rem;
    }
    .about-values .about-value-desc ul {
        list-style: disc;
        padding-left: 1.25rem;
        margin: 0.25rem 0 0.45rem;
    }
    .about-values .about-value-desc ol {
        list-style: decimal;
        padding-left: 1.25rem;
        margin: 0.25rem 0 0.45rem;
    }
    .about-values .about-value-desc li {
        margin-bottom: 0.25rem;
    }
    .about-values .about-value-desc > *:last-child,
    .about-values .about-value-desc li:last-child {
        margin-bottom: 0;
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
            <span class="about-eyebrow" data-aos="fade-down" data-aos-duration="600">À propos de <span translate="no">LLABB TECH GROUP</span></span>
            <h1 class="text-white heading-hero text-shadow" data-aos="fade-down" data-aos-duration="800" data-aos-delay="100">
                {{ $about->hero_titre }}
            </h1>

            <p class="text-white text-shadow--strong pt-2" data-aos="fade-up" data-aos-duration="600" data-aos-delay="300">
                {{ $about->hero_texte }}
            </p>

            <div class="about-hero-stats" data-aos="fade-up" data-aos-duration="500" data-aos-delay="500">
                @if ($services->count() > 0)
                    <div class="about-hero-stat">
                        <strong>{{ $services->count() }} {{ $services->count() > 1 ? 'pôles' : 'pôle' }}</strong>
                        <span>Domaines d'expertise</span>
                    </div>
                @endif
                @if ($projectsCount > 0)
                    <div class="about-hero-stat">
                        <strong>{{ $projectsCount }}</strong>
                        <span>{{ $projectsCount > 1 ? 'Projets réalisés' : 'Projet réalisé' }}</span>
                    </div>
                @endif
                @if ($teamMembers->count() > 0)
                    <div class="about-hero-stat">
                        <strong>{{ $teamMembers->count() }}</strong>
                        <span>{{ $teamMembers->count() > 1 ? "Experts dans l'équipe" : "Expert dans l'équipe" }}</span>
                    </div>
                @endif
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
                    <h2 class="about-info-title">{{ $about->histoire_titre }}</h2>
                    @include('partials.formatted-text', ['text' => $about->histoire_texte])
                </div>
            </div>

            <div class="about-image" data-hover-3d>
                <img src="{{ $about->histoire_image ? asset('assets/images/about/' . $about->histoire_image) : asset('assets/images/backgrounds/computer-code.png') }}" alt="Notre histoire - LLABB TECH GROUP">
            </div>
        </section>

        <!-- Mission & Vision -->
        <section class="about-section">
            <div class="about-split">
                <div class="about-split-card">
                    <span class="about-eyebrow">Cap quotidien</span>
                    <h3>Notre Mission</h3>
                    <p>{{ $about->mission_texte }}</p>
                </div>
                <div class="about-split-card is-vision">
                    <span class="about-eyebrow">Horizon</span>
                    <h3>Notre Vision</h3>
                    <p>{{ $about->vision_texte }}</p>
                </div>
            </div>
        </section>

        <!-- Valeurs -->
<!-- Valeurs -->
        @if ($values->isNotEmpty())
            <section class="about-section">
                <div class="about-sec-head">
                    <span class="about-eyebrow">Ce qui nous guide</span>
                    <h2 class="heading-lg">Nos valeurs</h2>
                </div>
                <ul class="about-values">
                    @foreach ($values as $value)
                        <li>
                            <span class="name"><span class="num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>{{ $value->nom }}</span>
                            <div class="about-value-desc">
                                @include('partials.formatted-text', ['text' => $value->description])
                            </div>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif

        <!-- Expertise (accordéon) : les services publiés -->
        @if ($services->isNotEmpty())
            <section class="about-section">
                <div class="about-sec-head">
                    <span class="about-eyebrow">Savoir-faire</span>
                    <h2 class="heading-lg">Nos domaines d'expertise</h2>
                </div>
                <div class="about-accordion" id="aboutAccordion">
                    @foreach ($services as $service)
                        <div class="about-exp-item" data-open="{{ $loop->first ? 'true' : 'false' }}">
                            <button type="button">
                                {{ $service->titre }}
                                <span class="plus">+</span>
                            </button>
                            <div class="about-exp-panel">
                                <p>{{ $service->resume }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Équipe -->
        @if ($teamMembers->isNotEmpty())
            <section class="about-section team about-team">
                <div class="about-sec-head">
                    <span class="about-eyebrow">Les visages derrière <span translate="no">LLABB</span></span>
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
        @endif

        <!-- Bandeau CTA final -->
        <div class="about-cta-banner">
            <div>
                <h3>{{ $about->cta_titre }}</h3>
                <p>{{ $about->cta_texte }}</p>
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