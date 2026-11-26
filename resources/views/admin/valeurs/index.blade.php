@extends('layouts.admin')

@section('title', 'Valeurs')

@section('content')

<div class="admin-card">
    <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap; margin-bottom:16px;">
        <p style="margin:0; color:#5c6b84; font-size:0.9rem;">
            Ces valeurs s'affichent sur la page « À propos », dans l'ordre ci-dessous.
        </p>
        <a href="{{ route('admin.valeurs.create') }}" class="btn-admin">Nouvelle valeur</a>
    </div>

    @if ($values->isEmpty())
        <p style="color:#5c6b84;">Aucune valeur pour le moment.</p>
    @else
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="text-align:left; border-bottom:2px solid #e0e0e0; font-size:0.82rem; color:#5c6b84;">
                    <th style="padding:10px 8px; width:70px;">Ordre</th>
                    <th style="padding:10px 8px; width:180px;">Valeur</th>
                    <th style="padding:10px 8px;">Description</th>
                    <th style="padding:10px 8px; width:200px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($values as $value)
                    <tr style="border-bottom:1px solid #eef0f4;">
                        <td style="padding:12px 8px;">{{ $value->ordre }}</td>
                        <td style="padding:12px 8px; font-weight:600;">{{ $value->nom }}</td>
                        <td style="padding:12px 8px; color:#5c6b84; font-size:0.9rem;">{{ \Illuminate\Support\Str::limit($value->description, 90) }}</td>
                        <td style="padding:12px 8px; white-space:nowrap;">
                            <a href="{{ route('admin.valeurs.edit', $value) }}" class="btn-admin-outline">Modifier</a>
                            <form action="{{ route('admin.valeurs.destroy', $value) }}" method="POST" style="display:inline;"
                                  onsubmit="return confirm('Supprimer cette valeur ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-admin-outline" style="color:#c0392b; border-color:#c0392b; cursor:pointer;">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection