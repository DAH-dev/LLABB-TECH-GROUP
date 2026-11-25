@extends('layouts.app')

@section('title', $service->titre . ' - LLABB TECH GROUP')

@section('content')

<style>
    /* Détail d'un service : colonnes structurées (limité à cette page) */
    .service-detail {
        display: grid;
        grid-template-columns: minmax(0, 2fr) minmax(0, 1fr);
        gap: 2rem;
        align-items: start;
    }
    @media (max-width: 991px) {
        .service-detail { grid-template-columns: 1fr; }
    }

    .service-detail .sd-eyebrow {
        display: block;
        color: var(--color-primary, #1e88e5);
        font-weight: 600;
        font-size: 0.8rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }
    .service-detail .sd-title { margin: 0.4rem 0 1.25rem; }
    .service-detail .sd-text p {
        margin: 0 0 1rem;
        line-height: 1.75;
    }

    .service-detail .sd-block {
        margin-top: 1.75rem;
        padding: 1.25rem 1.5rem;
        border-radius: 12px;
        border-left: 4px solid var(--color-primary, #1e88e5);
        background: rgba(128, 128, 128, 0.08);
    }
    .service-detail .sd-block h3 {
        margin: 0 0 0.75rem;
        font-size: 1.1rem;
    }
    .service-detail .sd-block p {
        margin: 0 0 0.75rem;
        line-height: 1.75;
    }
    .service-detail .sd-block p:last-child { margin-bottom: 0; }

    .service-detail .sd-aside {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        position: sticky;
        top: 110px;
    }
    @media (max-width: 991px) {
        .service-detail .sd-aside { position: static; }
    }

    .service-detail .sd-card {
        padding: 1.5rem;
        border-radius: 12px;
        border: 1px solid rgba(128, 128, 128, 0.25);
        background: rgba(128, 128, 128, 0.06);
    }
    .service-detail .sd-card h3 {
        margin: 0 0 1rem;
        font-size: 1.05rem;
    }

    .service-detail .sd-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .service-detail .sd-chips li {
        margin: 0;
        padding: 0.35rem 0.8rem;
        border-radius: 999px;
        border: 1px solid rgba(128, 128, 128, 0.25);
        background: rgba(128, 128, 128, 0.14);
        font-size: 0.85rem;
        line-height: 1.3;
    }

    .service-detail .sd-cta {
        background: #072066;
        border-color: #072066;
    }
    .service-detail .sd-cta h3,
    .service-detail .sd-cta p { color: #ffffff !important; }
    .service-detail .sd-cta p {
        margin: 0 0 1.25rem;
        font-size: 0.92rem;
        line-height: 1.6;
        opacity: 0.85;
    }
</style>

@include('partials.page-header', [
    'title' => $service->titre,
    'description' => $service->resume
])

@php
    // Chaque ligne tapée dans le Dashboard devient un paragraphe
    $descriptionLines = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) ($service->description ?: $service->resume))));
    $methodologieLines = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $service->methodologie)));
    // Les technologies séparées par des virgules deviennent des pastilles
    $technologies = array_filter(array_map('trim', preg_split('/[,;]+/', (string) $service->technologies)));
@endphp

<div class="main d-flex-center pt-8 pb-8">
    <div class="container main-content">
        <div class="service-detail">

            <div class="sd-main">
                <span class="sd-eyebrow">Description</span>
                <h2 class="sd-title">{{ $service->titre }}</h2>

                <div class="sd-text">
                    @foreach ($descriptionLines as $line)
                        <p>{{ $line }}</p>
                    @endforeach
                </div>

                @if (count($methodologieLines))
                    <div class="sd-block">
                        <h3>Méthodologie</h3>
                        @foreach ($methodologieLines as $line)
                            <p>{{ $line }}</p>
                        @endforeach
                    </div>
                @endif
            </div>

            <aside class="sd-aside">
                @if (count($technologies))
                    <div class="sd-card">
                        <h3>Technologies utilisées</h3>
                        <ul class="sd-chips">
                            @foreach ($technologies as $tech)
                                <li>{{ $tech }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="sd-card sd-cta">
                    <h3>Un projet en tête ?</h3>
                    <p>Parlons-en : nous vous répondons rapidement avec une proposition adaptée.</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary">Discuter de mon projet</a>
                </div>
            </aside>

        </div>
    </div>
</div>

@endsection