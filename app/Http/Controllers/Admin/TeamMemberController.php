<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::orderBy('ordre')->get();

        return view('admin.team.index', [
            'teamMembers' => $teamMembers,
        ]);
    }

    public function create()
    {
        return view('admin.team.form', [
            'member' => new TeamMember(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateMember($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->storeImage($request->file('photo'));
        } else {
            unset($validated['photo']);
        }

        // Ordre facultatif : s'il est vide, le membre passe en dernier
        $validated['ordre'] = $validated['ordre'] ?? ((int) TeamMember::max('ordre') + 1);

        TeamMember::create($validated);

        return redirect()->route('admin.team.index')->with('success', 'Membre ajouté avec succès.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.form', [
            'member' => $team,
        ]);
    }

    public function update(Request $request, TeamMember $team)
    {
        $validated = $this->validateMember($request);

        if ($request->hasFile('photo')) {
            if ($team->photo && file_exists(public_path('assets/images/team/' . $team->photo))) {
                @unlink(public_path('assets/images/team/' . $team->photo));
            }
            $validated['photo'] = $this->storeImage($request->file('photo'));
        } else {
            unset($validated['photo']);
        }

        // Ordre facultatif : s'il est vide, on garde l'ordre actuel
        $validated['ordre'] = $validated['ordre'] ?? $team->ordre ?? 0;

        $team->update($validated);

        return redirect()->route('admin.team.index')->with('success', 'Membre mis à jour avec succès.');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->photo && file_exists(public_path('assets/images/team/' . $team->photo))) {
            @unlink(public_path('assets/images/team/' . $team->photo));
        }

        $team->delete();

        return redirect()->route('admin.team.index')->with('success', 'Membre supprimé.');
    }

    private function validateMember(Request $request): array
    {
        return $request->validate([
            'nom' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,svg,avif,bmp|max:20480',
            'lien_linkedin' => 'nullable|string|max:255',
            'lien_facebook' => 'nullable|string|max:255',
            'lien_telegram' => 'nullable|string|max:255',
            'lien_instagram' => 'nullable|string|max:255',
            'ordre' => 'nullable|integer',
        ]);
    }

    private function storeImage($file): string
    {
        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/team'), $filename);

        return $filename;
    }
}