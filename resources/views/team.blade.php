@extends('layouts.app')

@section('title', 'Équipe - LLABB TECH GROUP')

@section('content')

@include('partials.page-header', [
    'title' => 'Notre équipe',
    'description' => 'Des profils complémentaires réunis autour d\'une même exigence : livrer des solutions qui comptent.'
])

<style>
    .team-page .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 28px;
    }

    .team-page .member-card {
        background: #fff;
        border: 1px solid #e4e9f2;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(16, 32, 61, 0.06);
        display: flex;
        flex-direction: column;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .team-page .member-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 24px rgba(16, 32, 61, 0.12);
    }

    .team-page .member-photo {
        width: 100%;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        background: #eef2fa;
    }
    .team-page .member-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .team-page .member-body {
        padding: 20px 18px 24px;
        text-align: center;
    }
    .team-page .member-name {
        display: block;
        font-weight: 700;
        font-size: 1.05rem;
        color: var(--color-text-primary, #10203d);
    }
    .team-page .member-role {
        display: block;
        margin-top: 2px;
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--color-primary);
    }
    .team-page .member-socials {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 14px;
    }
    .team-page .member-socials a {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #eef2fa;
        color: var(--color-primary);
        transition: background .2s ease, color .2s ease;
    }
    .team-page .member-socials a:hover {
        background: var(--color-primary);
        color: #fff;
    }
    .team-page .member-socials svg {
        width: 16px;
        height: 16px;
    }
    .team-page .member-bio {
        margin-top: 14px;
        font-size: 0.88rem;
        line-height: 1.6;
        color: #5c6b84;
    }
</style>

<div class="main d-flex-center pt-8 pb-8 team-page">
    <div class="container main-content">
        <section class="team">
            <div class="team-grid">
                @foreach ($teamMembers as $member)
                    <div class="member-card" data-aos="fade-up" data-aos-delay="0">
                        <div class="member-photo">
                            <img src="{{ $member->photo ? asset('assets/images/team/' . $member->photo) : asset('assets/images/testimonials/face-01.png') }}" alt="{{ $member->nom }}">
                        </div>
                        <div class="member-body">
                            <span class="member-name">{{ $member->nom }}</span>
                            <span class="member-role">{{ $member->poste }}</span>

                            @include('partials.team-socials', ['member' => $member])

                            @if ($member->bio)
                                <p class="member-bio">{{ $member->bio }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</div>

@endsection