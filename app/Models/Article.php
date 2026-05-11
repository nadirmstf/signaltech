<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // Colonnes que Make.com peut remplir via le webhook
    protected $fillable = [
        'titre',
        'contenu',
        'categorie',
        'source',
        'url_source',
        'image',
        'publie_le',
    ];

    // Dit à Laravel que publie_le est une date
    protected $casts = [
        'publie_le' => 'datetime',
    ];

    // Scope pour filtrer par catégorie facilement
    public function scopeCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }
}