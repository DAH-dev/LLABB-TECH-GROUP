@extends('layouts.app')

@section('title', $project->titre . ' - LLABB TECH GROUP')

@section('content')

<style>
    /* Détail d'un projet : harmonisé avec la charte du site */
    .project-detail {
        display: flex;
        flex-direction: column;
        gap: 2.25rem;
    }

    .project-detail .pd-top-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        padding-bottom: 1.25rem;
        border-bottom: 1px solid rgba(128, 128, 128, 0.2);
    }

    .project-detail .pd-crumb {
        font-size: 0.88rem;
        opacity: 0.75;
    }
    .project-detail .pd-crumb a {
        text-decoration: none;
        font-weight: 500;
    }
    .project-detail .pd-crumb a:hover {
        color: var(--color-primary, #1e88e5);
    }
    .project-detail .pd-crumb .sep {
        margin: 0 0.5rem;
        opacity: 0.6;
    }

    .project-detail .pd-meta {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        flex-wrap: wrap;
    }
    .project-detail .pd-badge {
        display: inline-block;
        padding: 0.35rem 0.85rem;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        color: var(--color-primary, #1e88e5);
        background: rgba(30, 136, 229, 0.12);
        border: 1px solid rgba(30, 136, 229, 0.25);
    }
    .project-detail .pd-client {
        font-size: 0.88rem;
        padding: 0.35rem 0.85rem;
        border-radius: 999px;
        background: rgba(128, 128, 128, 0.12);
        border: 1px solid rgba(128, 128, 128, 0.22);
    }

    .project-detail .pd-cover {
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid rgba(128, 128, 128, 0.22);
        background: rgba(128, 128, 128, 0.06);
    }
    .project-detail .pd-cover img {
        display: block;
        width: 100%;
        max-height: 440px;
        object-fit: cover;
    }

    .project-detail .pd-layout {
        display: grid;
        grid-template-columns: minmax(0, 2fr) minmax(0, 1fr);
        gap: 2rem;
        align-items: start;
    }
    @media (max-width: 991px) {
        .project-detail .pd-layout {
            grid-template-columns: 1fr;
        }
    }

    .project-detail .pd-eyebrow {
        display: block;
        color: var(--color-primary, #1e88e5);
        font-weight: 600;
        font-size: 0.8rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-bottom: 0.35rem;
    }

    .project-detail .pd-section {
        padding-bottom: 1.75rem;
        margin-bottom: 1.75rem;
        border-bottom: 1px solid rgba(128, 128, 128, 0.18);
    }
    .project-detail .pd-section:last-child {
        padding-bottom: 0;
        margin-bottom: 0;
        border-bottom: none;
    }
    .project-detail .pd-section h2 {
        margin: 0 0 0.85rem;
        font-size: 1.35rem;
    }

    .project-detail .pd-text {
        line-height: 1.75;
    }
    .project-detail .pd-text p {
        margin: 0 0 0.9rem;
    }
    .project-detail .pd-text ul,
    .project-detail .pd-text ol {
        margin: 0 0 0.9rem;
        padding-left: 1.35rem;
    }
    .project-detail .pd-text ul { list-style: disc; }
    .project-detail .pd-text ol { list-style: decimal; }
    .project-detail .pd-text li { margin: 0 0 0.4rem; }
    .project-detail .pd-text > *:last-child { margin-bottom: 0; }

    .project-detail .pd-aside {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        position: sticky;
        top: 110px;
    }
    @media (max-width: 991px) {
        .project-detail .pd-aside {
            position: static;
        }
    }

    .project-detail .pd-card {
        padding: 1.5rem;
        border-radius: 12px;
        border: 1px solid rgba(128, 128, 128, 0.25);
        background: rgba(128, 128, 128, 0.06);
    }
    .project-detail .pd-card h3 {
        margin: 0 0 0.85rem;
        font-size: 1.05rem;
    }

    .project-detail .pd-result-card {
        border-left: 4px solid var(--color-primary, #1e88e5);
        background: rgba(30, 136, 229, 0.06);
    }

    .project-detail .pd-info-list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        font-size: 0.92rem;
    }
    .project-detail .pd-info-list li {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        padding-bottom: 0.6rem;
        border-bottom: 1px solid rgba(128, 128, 128, 0.14);
    }
    .project-detail .pd-info-list li:last-child {
        padding-bottom: 0;
        border-bottom: none;
    }
    .project-detail .pd-info-list span {
        opacity: 0.72;
    }
    .project-detail .pd-info-list strong {
        text-align: right;
    }

    .project-detail .pd-cta {
        background: #072066;
        border-color: #072066;
    }
    .project-detail .pd-cta h3,
    .project-detail .pd-cta p {
        color: #ffffff !important;
    }
    .project-detail .pd-cta p {
        margin: 0 0 1.25rem;
        font-size: 0.92rem;
        line-height: 1.6;
        opacity: 0.88;
    }
    .project-detail .pd-cta-actions {
        display: flex;
        flex-direction: column;
        gap: 0.65rem;
    }
    .project-detail .pd-cta-actions .btn {
        width: 100%;
        text-align: center;
    }
</style>

@php
    $lede = trim(preg_replace('/\s*[\r\n]+\s*/', ' ', preg_replace('/^\s*(?:[-–—*•]|\d+[.)])\s+/m', '', (string) $project->probleme)));
@endphp

@include('partials.page-header', [
    'title' => $project->titre,
    'description' => $lede !== '' ? \Illuminate\Support\Str::limit($lede, 160) : $project->category->nom
])

<div class="main d-flex-center pt-8 pb-8">
    <div class="container main-content">
        <div class="project-detail">

            <div class="pd-top-bar">
                <nav class="pd-crumb" aria-label="Fil d'Ariane">
                    <a href="{{ route('portfolio') }}">Portfolio</a>
                    <span class="sep">/</span>
                    <span>{{ $project->titre }}</span>
                </nav>

                <div class="pd-meta">
                    <span class="pd-badge">{{ $project->category->nom }}</span>
                    @if ($project->client)
                        <span class="pd-client">Client : <strong>{{ $project->client }}</strong></span>
                    @endif
                </div>
            </div>

            <div class="pd-cover">
                <img src="{{ $project->image_couverture ? asset('assets/images/portfolio/' . $project->image_couverture) : asset('assets/images/portfolio/project-1.png') }}" alt="{{ $project->titre }}">
            </div>

            <div class="pd-layout">

                <div class="pd-main">
                    <span class="pd-eyebrow">Étude de cas</span>

                    @if ($project->probleme)
                        <section class="pd-section">
                            <h2>Problématique</h2>
                            <div class="pd-text">
                                @include('partials.formatted-text', ['text' => $project->probleme])
                            </div>
                        </section>
                    @endif

                    @if ($project->solution)
                        <section class="pd-section">
                            <h2>Solution mise en place</h2>
                            <div class="pd-text">
                                @include('partials.formatted-text', ['text' => $project->solution])
                            </div>
                        </section>
                    @endif
                </div>

                <aside class="pd-aside">
                    @if ($project->resultats)
                        <div class="pd-card pd-result-card">
                            <span class="pd-eyebrow">Impact</span>
                            <h3>Résultats obtenus</h3>
                            <div class="pd-text">
                                @include('partials.formatted-text', ['text' => $project->resultats])
                            </div>
                        </div>
                    @endif

                    <div class="pd-card">
                        <h3>Fiche projet</h3>
                        <ul class="pd-info-list">
                            <li>
                                <span>Catégorie</span>
                                <strong>{{ $project->category->nom }}</strong>
                            </li>
                            @if ($project->client)
                                <li>
                                    <span>Client</span>
                                    <strong>{{ $project->client }}</strong>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <div class="pd-card pd-cta">
                        <h3>Un projet similaire ?</h3>
                        <p>Discutons de vos objectifs et voyons comment nous pouvons déployer une solution adaptée.</p>
                        <div class="pd-cta-actions">
                            <a href="{{ route('contact') }}" class="btn btn-primary">Discuter de mon projet</a>
                            <a href="{{ route('portfolio') }}" class="btn btn-outline">Voir d'autres projets</a>
                        </div>
                    </div>
                </aside>

            </div>

        </div>
    </div>
</div>

@endsection