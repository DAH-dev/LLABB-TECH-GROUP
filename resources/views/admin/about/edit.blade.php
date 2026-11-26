@extends('layouts.admin')

@section('title', 'Page « À propos »')

@section('content')

<div class="admin-card" style="max-width: 760px;">
    <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h3 style="margin:0 0 14px; font-size:1rem;">Introduction (haut de page)</h3>

        <div class="form-group" style="margin-bottom:16px;">
            <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:6px;">Titre principal *</label>
            <input type="text" name="hero_titre" value="{{ old('hero_titre', $about->hero_titre) }}" required
                   style="width:100%; padding:10px 12px; border:1px solid #e0e0e0; border-radius:4px;">
            @error('hero_titre')
                <p style="font-size:0.78rem; color:#c0392b; margin-top:4px;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group" style="margin-bottom:28px;">
            <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:6px;">Texte d'introduction *</label>
            <textarea name="hero_texte" rows="3" required style="width:100%; padding:10px 12px; border:1px solid #e0e0e0; border-radius:4px;">{{ old('hero_texte', $about->hero_texte) }}</textarea>
            @error('hero_texte')
                <p style="font-size:0.78rem; color:#c0392b; margin-top:4px;">{{ $message }}</p>
            @enderror
            <p style="font-size:0.78rem; color:#5c6b84; margin-top:4px;">
                Les chiffres sous l'introduction (nombre de pôles, de projets et de membres de l'équipe) se calculent automatiquement.
            </p>
        </div>

        <h3 style="margin:0 0 14px; font-size:1rem;">Notre histoire</h3>

        <div class="form-group" style="margin-bottom:16px;">
            <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:6px;">Titre *</label>
            <input type="text" name="histoire_titre" value="{{ old('histoire_titre', $about->histoire_titre) }}" required
                   style="width:100%; padding:10px 12px; border:1px solid #e0e0e0; border-radius:4px;">
            @error('histoire_titre')
                <p style="font-size:0.78rem; color:#c0392b; margin-top:4px;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group" style="margin-bottom:16px;">
            <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:6px;">Texte *</label>
            <textarea name="histoire_texte" rows="8" required style="width:100%; padding:10px 12px; border:1px solid #e0e0e0; border-radius:4px;">{{ old('histoire_texte', $about->histoire_texte) }}</textarea>
            @error('histoire_texte')
                <p style="font-size:0.78rem; color:#c0392b; margin-top:4px;">{{ $message }}</p>
            @enderror
            <p style="font-size:0.78rem; color:#5c6b84; margin-top:4px;">
                Une ligne = un paragraphe. Commence une ligne par « - » pour faire une liste à puces.
            </p>
        </div>

        <div class="form-group" style="margin-bottom:28px;">
            <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:6px;">Image</label>
            @if ($about->histoire_image)
                <div style="margin-bottom:8px;">
                    <img src="{{ asset('assets/images/about/' . $about->histoire_image) }}" alt="Image actuelle"
                         style="height:80px; border-radius:6px; object-fit:cover;">
                </div>
            @endif
            <input type="file" name="histoire_image" accept="image/*"
                   style="width:100%; padding:10px 12px; border:1px solid #e0e0e0; border-radius:4px;">
            @error('histoire_image')
                <p style="font-size:0.78rem; color:#c0392b; margin-top:4px;">{{ $message }}</p>
            @enderror
            <p style="font-size:0.78rem; color:#5c6b84; margin-top:4px;">
                Laisse ce champ vide pour garder l'image actuelle (ou l'image par défaut). Formats acceptés : JPG, PNG, WEBP, GIF, SVG, AVIF, BMP (max 20 Mo).
            </p>
        </div>

        <h3 style="margin:0 0 14px; font-size:1rem;">Mission et vision</h3>

        <div class="form-group" style="margin-bottom:16px;">
            <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:6px;">Notre mission *</label>
            <textarea name="mission_texte" rows="3" required style="width:100%; padding:10px 12px; border:1px solid #e0e0e0; border-radius:4px;">{{ old('mission_texte', $about->mission_texte) }}</textarea>
            @error('mission_texte')
                <p style="font-size:0.78rem; color:#c0392b; margin-top:4px;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group" style="margin-bottom:28px;">
            <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:6px;">Notre vision *</label>
            <textarea name="vision_texte" rows="3" required style="width:100%; padding:10px 12px; border:1px solid #e0e0e0; border-radius:4px;">{{ old('vision_texte', $about->vision_texte) }}</textarea>
            @error('vision_texte')
                <p style="font-size:0.78rem; color:#c0392b; margin-top:4px;">{{ $message }}</p>
            @enderror
        </div>

        <h3 style="margin:0 0 14px; font-size:1rem;">Bandeau bleu (bas de page)</h3>

        <div class="form-group" style="margin-bottom:16px;">
            <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:6px;">Titre *</label>
            <input type="text" name="cta_titre" value="{{ old('cta_titre', $about->cta_titre) }}" required
                   style="width:100%; padding:10px 12px; border:1px solid #e0e0e0; border-radius:4px;">
            @error('cta_titre')
                <p style="font-size:0.78rem; color:#c0392b; margin-top:4px;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group" style="margin-bottom:24px;">
            <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:6px;">Texte *</label>
            <textarea name="cta_texte" rows="2" required style="width:100%; padding:10px 12px; border:1px solid #e0e0e0; border-radius:4px;">{{ old('cta_texte', $about->cta_texte) }}</textarea>
            @error('cta_texte')
                <p style="font-size:0.78rem; color:#c0392b; margin-top:4px;">{{ $message }}</p>
            @enderror
        </div>

        <div style="display:flex; gap:12px;">
            <button type="submit" class="btn-admin">Enregistrer</button>
            <a href="{{ route('about') }}" target="_blank" class="btn-admin-outline">Voir la page</a>
        </div>
    </form>
</div>

@endsection