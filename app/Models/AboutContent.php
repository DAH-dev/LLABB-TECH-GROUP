<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    protected $fillable = [
        'hero_titre',
        'hero_texte',
        'histoire_titre',
        'histoire_texte',
        'histoire_image',
        'mission_texte',
        'vision_texte',
        'cta_titre',
        'cta_texte',
    ];
}