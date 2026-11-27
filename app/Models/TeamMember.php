<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

protected $fillable = [
    'nom',
    'poste',
    'bio',
    'photo',
    'lien_linkedin',
    'lien_facebook',
    'lien_telegram',
    'lien_instagram',
    'ordre',
];
}