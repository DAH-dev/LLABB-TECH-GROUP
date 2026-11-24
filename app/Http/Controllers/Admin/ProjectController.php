<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('category')->orderBy('ordre')->get();

        return view('admin.projects.index', [
            'projects' => $projects,
        ]);
    }

    public function create()
    {
        return view('admin.projects.form', [
            'project' => new Project(),
            'categories' => ProjectCategory::orderBy('nom')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateProject($request);
        $validated = $this->applyCategory($validated);
        $validated['slug'] = Str::slug($validated['titre']);
        $validated['mis_en_avant'] = $request->boolean('mis_en_avant');
        // Ordre facultatif : s'il est vide, le projet est placé en dernier
        $validated['ordre'] = $validated['ordre'] ?? ((int) Project::max('ordre') + 1);


        if ($request->hasFile('image_couverture')) {
            $validated['image_couverture'] = $this->storeImage($request->file('image_couverture'));
        } else {
            unset($validated['image_couverture']);
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Projet créé avec succès.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', [
            'project' => $project,
            'categories' => ProjectCategory::orderBy('nom')->get(),
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $this->validateProject($request);
        $validated = $this->applyCategory($validated);
        $validated['slug'] = Str::slug($validated['titre']);
        $validated['mis_en_avant'] = $request->boolean('mis_en_avant');
        
        // Ordre facultatif : s'il est vide, on garde l'ordre actuel
        $validated['ordre'] = $validated['ordre'] ?? $project->ordre ?? 0;

        if ($request->hasFile('image_couverture')) {
            if ($project->image_couverture && file_exists(public_path('assets/images/portfolio/' . $project->image_couverture))) {
                @unlink(public_path('assets/images/portfolio/' . $project->image_couverture));
            }
            $validated['image_couverture'] = $this->storeImage($request->file('image_couverture'));
        } else {
            unset($validated['image_couverture']);
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Projet mis à jour avec succès.');
    }

    public function destroy(Project $project)
    {
        if ($project->image_couverture && file_exists(public_path('assets/images/portfolio/' . $project->image_couverture))) {
            @unlink(public_path('assets/images/portfolio/' . $project->image_couverture));
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Projet supprimé.');
    }

    private function validateProject(Request $request): array
    {
        return $request->validate([
            'categorie' => 'required|string|max:100',
            'titre' => 'required|string|max:255',
            'client' => 'nullable|string|max:255',
            'probleme' => 'nullable|string',
            'solution' => 'nullable|string',
            'resultats' => 'nullable|string',
            'image_couverture' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,svg,avif,bmp|max:20480',
            'ordre' => 'nullable|integer',
        ]);
    }

    /**
     * Remplace le nom de catégorie saisi par l'id de la catégorie
     * (la catégorie est créée si elle n'existe pas encore).
     */
    private function applyCategory(array $validated): array
    {
        $category = $this->findOrCreateCategory($validated['categorie']);

        $validated['project_category_id'] = $category->id;
        unset($validated['categorie']);

        return $validated;
    }

    private function findOrCreateCategory(string $nom): ProjectCategory
    {
        $nom = trim($nom);

        $category = ProjectCategory::whereRaw('LOWER(nom) = ?', [mb_strtolower($nom)])->first();

        if ($category) {
            return $category;
        }

        // Le slug est obligatoire : il sert aux boutons de filtre du Portfolio. On le rend unique.
        $base = Str::slug($nom) ?: 'categorie';
        $slug = $base;
        $i = 2;
        while (ProjectCategory::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        $category = new ProjectCategory();
        $category->nom = $nom;
        $category->slug = $slug;
        $category->save();

        return $category;
    }

    private function storeImage($file): string
    {
        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/portfolio'), $filename);

        return $filename;
    }
}