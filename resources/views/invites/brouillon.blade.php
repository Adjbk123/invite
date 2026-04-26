<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Carte d'Invitation Officielle</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            background: #ffffff;
            color: #333;
        }

        /* Taille de la carte réduite (proche du format A6) */
        .carte {
            width: 600px;
            height: 400px;
            margin: 10px auto;
            border: 10px solid #1a3a8f;
            padding: 20px;
            position: relative;
            background: #fff;
            text-align: center;
        }

        .border-inner {
            border: 2px solid #0d6efd;
            height: 100%;
            padding: 15px;
            position: relative;
        }

        .logo-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .header-title {
            font-size: 18px;
            font-weight: bold;
            color: #1a3a8f;
            text-transform: uppercase;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }

        .invitation-text {
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 15px;
            font-style: italic;
        }

        .event-details {
            font-size: 15px;
            font-weight: bold;
            color: #0d6efd;
            margin-top: 5px;
        }

        .invite-name {
            font-size: 18px;
            font-weight: bold;
            color: #000;
            text-decoration: underline;
            margin: 10px 0;
        }

        .footer-info {
            position: absolute;
            bottom: 10px;
            left: 15px;
            right: 15px;
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            color: #666;
        }

        /* Numéro de table en bas à droite */
        .table-number {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: #1a3a8f;
            color: #fff;
            padding: 3px 10px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 12px;
        }

        .decoration {
            position: absolute;
            width: 50px;
            height: 50px;
            opacity: 0.1;
        }
        .top-left { top: 0; left: 0; border-top: 3px solid #0d6efd; border-left: 3px solid #0d6efd; }
        .top-right { top: 0; right: 0; border-top: 3px solid #0d6efd; border-right: 3px solid #0d6efd; }
        .bottom-left { bottom: 0; left: 0; border-bottom: 3px solid #0d6efd; border-left: 3px solid #0d6efd; }
        .bottom-right { bottom: 0; right: 0; border-bottom: 3px solid #0d6efd; border-right: 3px solid #0d6efd; }

    </style>
</head>
<body>

@php
    $siteName = $parametres?->website_name ?? 'MAFLYT SARL';
    $logo = $parametres?->photo ? public_path('uploads/' . $parametres->photo) : null;
    $ancienneEdition = $parametres?->event_edition_ancienne ?? 'ancienne';
    $nouvelleEdition = $parametres?->event_edition_nouvelle ?? 'nouvelle';
    $date = $parametres?->event_date ? \Carbon\Carbon::parse($parametres->event_date)->translatedFormat('l d F Y') : 'samedi 23 avril 2026';
    $heure = $parametres?->event_heure ?? '15 heure';
    $lieu = $parametres?->event_lieu ?? 'porto novo';
@endphp

<div class="carte">
    <div class="border-inner">
        <div class="decoration top-left"></div>
        <div class="decoration top-right"></div>
        <div class="decoration bottom-left"></div>
        <div class="decoration bottom-right"></div>

        @if($logo && file_exists($logo))
            <img class="logo-img" src="{{ $logo }}" alt="Logo">
        @endif

        <div class="header-title">{{ $siteName }}</div>

        <div class="invitation-text">
            @if($parametres?->event_motif)
               {!! html_entity_decode($parametre->description) !!}
            @else
                Dans le cadre de la cérémonie des prix aux lauréats de la <strong>{{ $ancienneEdition }} édition</strong> de la formation en informatique organisée au profit des enseignants couplée avec le lancement de la <strong>{{ $nouvelleEdition }} édition</strong>, le DG de la <strong>{{ $siteName }}</strong> a l'honneur de vous inviter au déjeuner de gala qu'il organise le :
            @endif
        </div>

        <div class="invite-name">M/Mme/Mlle {{ $invite->nom }}</div>

        <div class="event-details">
            Le {{ $date }} | {{ $heure }} <br>
            Lieu : {{ $lieu }}
        </div>

        @if($invite->numero_table)
            <div class="table-number">
                {{ $invite->numero_table }}
            </div>
        @endif

        <div class="footer-info">
            <span>Invitation personnelle</span>
            <span>Réf : {{ str_pad($invite->id, 4, '0', STR_PAD_LEFT) }}</span>
        </div>
    </div>
</div>

</body>
</html>

Dans le cadre de la cérémonie de remise des prix aux lauréats de la première édition de la formation en informatique organisée au profit des enseignants couplés avec le lancement de la deuxième édition , le Directeur Général de la Sté MAFLYT SARL à l'honneur de vous inviter au déjeuner de gala qu'il organise le samedi 7 Juin 2025 à partir de 15 heures à Porto-Novo.
