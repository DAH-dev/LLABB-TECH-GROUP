@extends('layouts.app')

@section('title', 'FAQ - LLABB TECH GROUP')

@section('content')

@include('partials.page-header', [
    'title' => 'Questions fréquentes',
    'description' => 'Tout ce qu\'il faut savoir avant de démarrer un projet avec LLABB TECH GROUP.'
])

@php
    $labels = [
        'general' => 'Général',
        'services' => 'Services',
        'tarifs' => 'Tarifs',
        'dashboard' => 'Dashboard & technique',
        'support' => 'Support',
    ];
    $grouped = $faqItems->groupBy('categorie');
@endphp

<style>
    /* Page FAQ : harmonisée avec la charte du site */
    .faq-page-body {
        padding-top: 2.5rem !important;
        padding-bottom: 3rem !important;
    }
    .faq-page-body .main-content {
        gap: 1.75rem !important;
    }

    .faq-wrapper {
        max-width: 840px;
        width: 100%;
        margin: 0 auto;
    }

    /* Barre de recherche avec icône */
    .faq-search {
        position: relative;
        margin-bottom: 1.15rem;
    }
    .faq-search svg {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        color: var(--color-primary, #1e88e5);
        pointer-events: none;
    }
    .faq-search input {
        width: 100%;
        font-size: 0.98rem;
        padding: 0.85rem 1rem 0.85rem 2.75rem;
        border-radius: 12px;
        border: 1px solid rgba(128, 128, 128, 0.28);
        background: rgba(128, 128, 128, 0.05);
        color: inherit;
        transition: border-color 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
    }
    .faq-search input:focus {
        border-color: var(--color-primary, #1e88e5);
        background: rgba(30, 136, 229, 0.04);
        box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.14);
    }

    /* Filtres en pastilles */
    .faq-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        justify-content: center;
        margin-bottom: 1.75rem;
    }
    .faq-filter-btn {
        font-size: 0.85rem;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        border: 1px solid rgba(128, 128, 128, 0.25);
        background: rgba(128, 128, 128, 0.06);
        color: inherit;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .faq-filter-btn:hover {
        border-color: var(--color-primary, #1e88e5);
        color: var(--color-primary, #1e88e5);
    }
    .faq-filter-btn.active {
        background: var(--color-primary, #1e88e5);
        border-color: var(--color-primary, #1e88e5);
        color: #ffffff;
        font-weight: 600;
    }

    /* Groupes par catégorie */
    .faq-group {
        margin-bottom: 1.75rem;
    }
    .faq-group:last-child {
        margin-bottom: 0;
    }
    .faq-group-head {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        margin-bottom: 0.75rem;
    }
    .faq-group-head h2 {
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--color-primary, #1e88e5);
        margin: 0;
    }
    .faq-group-count {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.12rem 0.55rem;
        border-radius: 999px;
        background: rgba(30, 136, 229, 0.14);
        color: var(--color-primary, #1e88e5);
    }

    /* Accordéon en cartes */
    .faq-list {
        display: flex;
        flex-direction: column;
        gap: 0.55rem;
    }
    .faq-item {
        border: 1px solid rgba(128, 128, 128, 0.24);
        border-radius: 10px;
        background: rgba(128, 128, 128, 0.05);
        padding: 0 1.2rem;
        transition: border-color 0.2s ease, background 0.2s ease;
    }
    .faq-item[data-open="true"] {
        border-color: var(--color-primary, #1e88e5);
        background: rgba(30, 136, 229, 0.06);
    }
    .faq-item button {
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        cursor: pointer;
        padding: 1rem 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        font-size: 1.02rem;
        font-weight: 600;
        color: inherit;
        line-height: 1.4;
    }
    .faq-item .faq-panel {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }
    .faq-item[data-open="true"] .faq-panel {
        max-height: 360px;
    }
    .faq-item p {
        padding-bottom: 1.1rem;
        margin: 0;
        font-size: 0.95rem;
        line-height: 1.65;
        opacity: 0.88;
        max-width: 72ch;
    }
    .faq-item .plus {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(30, 136, 229, 0.14);
        color: var(--color-primary, #1e88e5);
        font-size: 1.1rem;
        font-weight: 700;
        line-height: 1;
        flex-shrink: 0;
        transition: transform 0.2s ease, background 0.2s ease, color 0.2s ease;
    }
    .faq-item[data-open="true"] .plus {
        transform: rotate(45deg);
        background: var(--color-primary, #1e88e5);
        color: #ffffff;
    }

    /* Message vide */
    .faq-empty {
        display: none;
        text-align: center;
        padding: 2.25rem 1.25rem;
        border-radius: 12px;
        border: 1px dashed rgba(128, 128, 128, 0.3);
        background: rgba(128, 128, 128, 0.04);
        opacity: 0.85;
    }
    .faq-empty.show {
        display: block;
    }

    /* Bandeau CTA bleu #072066 */
    .faq-cta-banner {
        max-width: 840px;
        width: 100%;
        margin: 0.5rem auto 0;
        padding: 1.6rem 1.85rem;
        border-radius: 12px;
        background: #072066;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.25rem;
        flex-wrap: wrap;
    }
    .faq-cta-banner h3,
    .faq-cta-banner p {
        color: #ffffff !important;
        margin: 0;
    }
    .faq-cta-banner h3 {
        font-size: 1.2rem;
        margin-bottom: 0.25rem;
    }
    .faq-cta-banner p {
        font-size: 0.9rem;
        opacity: 0.86;
        line-height: 1.5;
    }
</style>

<div class="main d-flex-center faq-page-body">
    <div class="container main-content">

        <div class="faq-wrapper">

            <div class="faq-search">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                <input type="search" id="faqSearch" placeholder="Rechercher une question ou un mot-clé…" aria-label="Rechercher une question">
            </div>

            <div class="faq-filters" id="faqFilters">
                <button type="button" class="faq-filter-btn active" data-filter="all">Toutes</button>
                @foreach ($labels as $slug => $label)
                    @if ($grouped->has($slug))
                        <button type="button" class="faq-filter-btn" data-filter="{{ $slug }}">{{ $label }}</button>
                    @endif
                @endforeach
            </div>

            <div class="faq-accordion" id="faqAccordion">
                @foreach ($labels as $slug => $label)
                    @if ($grouped->has($slug))
                        <div class="faq-group" data-group="{{ $slug }}">
                            <div class="faq-group-head">
                                <h2>{{ $label }}</h2>
                                <span class="faq-group-count">{{ $grouped[$slug]->count() }}</span>
                            </div>
                            <div class="faq-list">
                                @foreach ($grouped[$slug]->sortBy('ordre') as $index => $item)
                                    <div class="faq-item" data-open="{{ $loop->first && $slug === 'general' ? 'true' : 'false' }}">
                                        <button type="button">
                                            <span>{{ $item->question }}</span>
                                            <span class="plus">+</span>
                                        </button>
                                        <div class="faq-panel">
                                            <p>{{ $item->reponse }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="faq-empty" id="faqEmpty">Aucune question ne correspond à votre recherche.</div>

        </div>

        <div class="faq-cta-banner">
            <div>
                <h3>Vous ne trouvez pas votre réponse ?</h3>
                <p>Notre équipe vous répond rapidement pour éclaircir vos besoins techniques ou budgétaires.</p>
            </div>
            <a href="{{ route('contact') }}" class="btn btn-primary">Contactez-nous</a>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var filterButtons = document.querySelectorAll('#faqFilters .faq-filter-btn');
    var groups = document.querySelectorAll('.faq-group');
    var items = document.querySelectorAll('.faq-item');
    var searchInput = document.getElementById('faqSearch');
    var empty = document.getElementById('faqEmpty');
    var activeFilter = 'all';

    function applyFilters() {
        var query = searchInput.value.trim().toLowerCase();
        var totalVisible = 0;

        groups.forEach(function (group) {
            var groupMatches = activeFilter === 'all' || group.getAttribute('data-group') === activeFilter;
            var groupVisibleCount = 0;

            group.querySelectorAll('.faq-item').forEach(function (item) {
                var questionText = item.querySelector('button').textContent.toLowerCase();
                var answerText = item.querySelector('.faq-panel').textContent.toLowerCase();
                var matchesQuery = query === '' || questionText.indexOf(query) !== -1 || answerText.indexOf(query) !== -1;
                var visible = groupMatches && matchesQuery;
                item.hidden = !visible;
                if (visible) groupVisibleCount++;
            });

            group.hidden = groupVisibleCount === 0;
            totalVisible += groupVisibleCount;
        });

        empty.classList.toggle('show', totalVisible === 0);
    }

    filterButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            filterButtons.forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');
            activeFilter = btn.getAttribute('data-filter');
            applyFilters();
        });
    });

    searchInput.addEventListener('input', applyFilters);

    items.forEach(function (item) {
        item.querySelector('button').addEventListener('click', function () {
            var isOpen = item.getAttribute('data-open') === 'true';
            item.setAttribute('data-open', isOpen ? 'false' : 'true');
        });
    });
});
</script>
@endsection