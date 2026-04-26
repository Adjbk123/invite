<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Formateurs Disponibles</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header img {
            width: 70px;
            margin-bottom: 5px;
        }

        h2 {
            margin: 0;
            color: #0d6efd;
            font-weight: bold;
        }

        h3 {
            margin: 5px 0;
            color: #000;
            font-weight: normal;
        }

        .divider {
            width: 100%;
            border-bottom: 2px solid #0d6efd;
            margin: 10px 0 15px 0;
        }

        .date {
            font-size: 10px;
            color: #777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }

        /* En-tête sobre */
        th {
            background: #fff;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Badges statut */
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            color: #fff;
        }
        .badge-disponible { background-color: #28a745; }  /* vert */
        .badge-indisponible { background-color: #dc3545; } /* rouge */

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #888;
            border-top: 1px solid #ccc;
            padding-top: 5px;
        }
    </style>
</head>
<body>

@php
    $logo = $parametres?->photo 
        ? public_path('uploads/' . $parametres->photo) 
        : public_path('uploads/default.png');

    $siteName = $parametres?->website_name ?? 'MAFLYT SARL';
@endphp

<div class="header">
    <img src="{{ $logo }}" alt="Logo">
    <h2>{{ $siteName }}</h2>
    <h3>Liste Officielle des invités Disponibles</h3>
    <div class="divider"></div>
    <div class="date">Généré le : {{ date('d/m/Y') }} — {{ date('H:i') }}</div>
</div>

<table>
    <thead>
        <tr>
            <th width="50%">Nom Complet</th>
            <th width="30%">Téléphone</th>
            <th width="20%">Statut</th>
        </tr>
    </thead>
    <tbody>
        @foreach($formateurs as $formateur)
            <tr>
                <td>{{ $formateur->nom }}</td>
                <td>{{ $formateur->numero ?? '—' }}</td>
                <td style="text-align: center;">
                    @if($formateur->statut === 'disponible')
                        <span class="badge badge-disponible">Disponible</span>
                    @else
                        —
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    © {{ date('Y') }} {{ $siteName }} — Liste officielle de présence
</div>

</body>
</html>
