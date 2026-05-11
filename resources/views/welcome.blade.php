<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/accueil.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">

    <title>SignalTech - Accueil</title>
</head>

<body>

    @include('raccourcis.header')

    <main class="contenu-principal">

        {{-- Titre section --}}
        <div class="en-tete-section">
            <h1 class="titre-principal">Veille technologique</h1>
            <p class="sous-titre">Restez informé des dernières tendances tech en temps réel</p>
        </div>

        {{-- Filtres --}}
        <div class="barre-filtres">
            <a href="?categorie=tous"
                class="bouton-filtre {{ $categorie === 'tous' ? 'actif' : '' }}">
                Tous
            </a>
            <a href="?categorie=data"
                class="bouton-filtre {{ $categorie === 'data' ? 'actif' : '' }}">
                Data
            </a>
            <a href="?categorie=cybersecurite"
                class="bouton-filtre {{ $categorie === 'cybersecurite' ? 'actif' : '' }}">
                Cybersécurité
            </a>
            <a href="?categorie=reseau"
                class="bouton-filtre {{ $categorie === 'reseau' ? 'actif' : '' }}">
                Réseau
            </a>
            <a href="?categorie=ia"
                class="bouton-filtre {{ $categorie === 'ia' ? 'actif' : '' }}">
                IA
            </a>
            <a href="?categorie=cloud"
                class="bouton-filtre {{ $categorie === 'cloud' ? 'actif' : '' }}">
                Cloud
            </a>
            <a href="?categorie=developpement"
                class="bouton-filtre {{ $categorie === 'developpement' ? 'actif' : '' }}">
                Développement
            </a>
            <a href="?categorie=hardware"
                class="bouton-filtre {{ $categorie === 'hardware' ? 'actif' : '' }}">
                Hardware
            </a>
        </div>

        {{-- Grille articles --}}
        <div class="grille-articles">
            @forelse($articles as $article)
            <div class="carte-article">

                {{-- Image --}}
                @if($article->image)
                <div class="carte-image">
                    <img src="{{ $article->image }}" alt="{{ $article->titre }}" />
                </div>
                @else
                <div class="carte-image carte-image--vide"></div>
                @endif

                {{-- Contenu --}}
                <div class="carte-corps">

                    {{-- Badge catégorie --}}
                    <span class="etiquette-categorie etiquette--{{ $article->categorie }}">
                        {{ ucfirst($article->categorie) }}
                    </span>

                    {{-- Titre --}}
                    <h2 class="carte-titre">{{ $article->titre }}</h2>

                    {{-- Résumé --}}
                    <p class="carte-resume">
                        {{ Str::limit($article->contenu, 120) }}
                    </p>

                    {{-- Footer carte --}}
                    <div class="carte-pied">
                        <span class="carte-date">
                            {{ $article->publie_le->diffForHumans() }}
                        </span>
                        @if($article->url_source)
                        <a href="{{ $article->url_source }}"
                            target="_blank"
                            class="carte-lien-source">
                            Lire la source →
                        </a>
                        @endif
                    </div>

                </div>
            </div>
            @empty
            <div class="message-vide">
                <p>Aucun article dans cette catégorie pour le moment.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="zone-pagination">
            {{ $articles->appends(['categorie' => $categorie])->links() }}
        </div>

    </main>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>