@extends('layouts.admin')

@section('title', $value->exists ? 'Modifier la valeur' : 'Nouvelle valeur')

@section('content')

<div class="admin-card" style="max-width: 700px;">
    <form action="{{ $value->exists ? route('admin.valeurs.update', $value) : route('admin.valeurs.store') }}" method="POST">
        @csrf
        @if ($value->exists)
            @method('PUT')
        @endif

        <div class="form-group" style="margin-bottom:16px;">
            <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:6px;">Nom de la valeur *</label>
            <input type="text" name="nom" value="{{ old('nom', $value->nom) }}" required placeholder="Ex. Innovation"
                   style="width:100%; padding:10px 12px; border:1px solid #e0e0e0; border-radius:4px;">
            @error('nom')
                <p style="font-size:0.78rem; color:#c0392b; margin-top:4px;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group" style="margin-bottom:16px;">
            <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:6px;">Description *</label>
            <textarea name="description" rows="3" required style="width:100%; padding:10px 12px; border:1px solid #e0e0e0; border-radius:4px;">{{ old('description', $value->description) }}</textarea>
            @error('description')
                <p style="font-size:0.78rem; color:#c0392b; margin-top:4px;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group" style="margin-bottom:24px; width:160px;">
            <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:6px;">Ordre (facultatif)</label>
            <input type="number" name="ordre" value="{{ old('ordre', $value->ordre) }}" placeholder="Auto"
                   style="width:100%; padding:10px 12px; border:1px solid #e0e0e0; border-radius:4px;">
            @error('ordre')
                <p style="font-size:0.78rem; color:#c0392b; margin-top:4px;">{{ $message }}</p>
            @enderror
            <p style="font-size:0.78rem; color:#5c6b84; margin-top:4px;">
                Laisse vide : la valeur passe en dernier.
            </p>
        </div>

        <div style="display:flex; gap:12px;">
            <button type="submit" class="btn-admin">{{ $value->exists ? 'Enregistrer les modifications' : 'Ajouter la valeur' }}</button>
            <a href="{{ route('admin.valeurs.index') }}" class="btn-admin-outline">Annuler</a>
        </div>
    </form>
</div>

@endsection