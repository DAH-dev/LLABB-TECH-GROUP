<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AboutContentController extends Controller
{
    public function edit()
    {
        return view('admin.about.edit', [
            'about' => AboutContent::first() ?? new AboutContent(),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'hero_titre' => 'required|string|max:255',
            'hero_texte' => 'required|string',
            'histoire_titre' => 'required|string|max:255',
            'histoire_texte' => 'required|string',
            'histoire_image' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,svg,avif,bmp|max:20480',
            'mission_texte' => 'required|string',
            'vision_texte' => 'required|string',
            'cta_titre' => 'required|string|max:255',
            'cta_texte' => 'required|string',
        ]);

        $about = AboutContent::first() ?? new AboutContent();

        if ($request->hasFile('histoire_image')) {
            if ($about->histoire_image && file_exists(public_path('assets/images/about/' . $about->histoire_image))) {
                @unlink(public_path('assets/images/about/' . $about->histoire_image));
            }
            $validated['histoire_image'] = $this->storeImage($request->file('histoire_image'));
        } else {
            unset($validated['histoire_image']);
        }

        $about->fill($validated)->save();

        return redirect()->route('admin.about.edit')->with('success', 'Page « À propos » mise à jour.');
    }

    private function storeImage($file): string
    {
        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/about'), $filename);

        return $filename;
    }
}