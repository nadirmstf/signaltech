<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // ── Page principale ──
    public function index(Request $request)
    {
        $categorie = $request->get('categorie', 'tous');

        $articles = Article::query()
            ->when(
                $categorie !== 'tous',
                fn($q) =>
                $q->where('categorie', $categorie)
            )
            ->orderBy('publie_le', 'desc')
            ->paginate(12);

        return view('welcome', compact('articles', 'categorie')); // ← welcome ici
    }

    // ── Webhook Make.com ──
    public function store(Request $request)
    {
        // Vérification du token secret
        if ($request->header('X-Webhook-Token') !== config('app.webhook_secret')) {
            return response()->json(['message' => 'Non autorisé'], 401);
        }

        // Validation des données reçues
        $request->validate([
            'titre'      => 'required|string|max:255',
            'contenu'    => 'required|string',
            'categorie'  => 'required|in:data,cybersecurite,reseau,ia,cloud,developpement,hardware',
            'source'     => 'nullable|string',
            'url_source' => 'nullable|url',
            'image'      => 'nullable|url',
        ]);

        // Création de l'article
        Article::create([
            'titre'      => $request->titre,
            'contenu'    => $request->contenu,
            'categorie'  => $request->categorie,
            'source'     => $request->source,
            'url_source' => $request->url_source,
            'image'      => $request->image,
            'publie_le'  => now(),
        ]);

        return response()->json(['message' => 'Article créé avec succès'], 201);
    }
}
