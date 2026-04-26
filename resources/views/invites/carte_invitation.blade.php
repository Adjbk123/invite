<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Carte d'Invitation</title>
    <style>
        @page {
            margin: 0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            background: #ffffff;
            color: #333;
        }

        .carte {
            width: 700px;
            height: 340px;
            margin: 0 auto;
            border: 10px solid #1a3a8f;
            padding: 15px;
            position: relative;
            background: #fff;
            overflow: hidden;
        }

        /* Logo en arrière-plan (Filigrane) */
        .background-logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            height: 300px;
            opacity: 0.08;
            /* Très léger pour ne pas gêner la lecture */
            z-index: 0;
            object-fit: contain;
        }

        .border-inner {
            border: 1px solid #1a3a8f;
            height: 100%;
            padding: 10px;
            position: relative;
            z-index: 1;
            /* Par-dessus le logo d'arrière-plan */
            background: rgba(255, 255, 255, 0.4);
            /* Légère transparence pour voir le fond */
        }

        /* En-tête */
        .header {
            position: relative;
            height: 60px;
            margin-bottom: 2px;
            text-align: center;
        }

        .logo-container {
            position: absolute;
            left: 0;
            top: 0;
            text-align: left;
        }

        .logo-img {
            width: 55px;
            height: 55px;
            object-fit: contain;
        }

        .site-name {
            font-size: 8px;
            font-weight: bold;
            color: #1a3a8f;
        }

        .invitation-title {
            color: #28a745;
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 12px;
            line-height: 55px;
            display: inline-block;
        }

        /* Nom */
        .invite-name-container {
            text-align: center;
            margin-bottom: 30px; /* Augmenté pour ne pas coller au pied de page */
        }

        .invite-name {
            font-size: 20px;
            font-weight: bold;
            color: #000;
            border-bottom: 2px solid #1a3a8f;
            display: inline-block;
            padding: 2px 15px;
        }

        /* Corps */
        .invitation-body {
            text-align: center;
            margin-top: -10px; /* Fait monter le motif */
            margin-bottom: 10px;
        }

        .motif-text {
            font-size: 14px;
            line-height: 1.4;
            font-style: italic;
            color: #000;
            font-weight: bold;
            padding: 0 45px;
        }

        /* Pied de page */
        .footer {
            position: absolute;
            bottom: 10px; /* Remonté un peu */
            left: 15px;
            right: 15px;
            border-top: 4px double #1a3a8f;
            padding-top: 10px;
            overflow: hidden;
        }

        .contacts {
            font-size: 10px;
            font-weight: bold;
            float: left;
            width: 80%;
            text-align: left;
        }

        .contact-item {
            display: inline-block;
            margin-right: 15px;
            vertical-align: middle;
        }

        .footer-icon {
            width: 14px;
            height: 14px;
            vertical-align: middle;
            margin-right: 4px;
        }

        /* Table dans le coin */
        .table-info {
            float: right;
            background: #FFD700;
            padding: 5px 12px;
            border-radius: 20px;
            border: 1px solid #000;
            font-weight: bold;
            font-size: 13px;
            color: #000;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body>

    @php
        $siteName = $parametres?->website_name ?? 'MAFLYT SARL';
        $logo = $parametres?->photo ? public_path('uploads/' . $parametres->photo) : null;

        // Logos en Base64
        $phoneIcon =
            'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iIzFhM2E4ZiI+PHBhdGggZD0iTTIuMjEyIDYuMzNBMS4xMjUgMS4xMjUgMCAwMTEgNC41YzAtMS4xNC45OS0yLjEwNyAyLjEzLTIuMDY3IDMuNDIuMTE4IDYuMjg2IDEuMTU4IDkuMzg0IDMuMzg2IDQuMDE4IDIuODk0IDcuMTkyIDcuMDMgOC4zOTkgMTEuNjE1LjM2IDEuMzczLS41MjMgMi41NjEtMS45MDMgMi41NjEtMS4wMjIgMC0xLjk2OC0uNjQzLTIuMjEzLTEuNTgxbC0uNTE2LTEuOTY2YS0xLjEyNSAxLjEyNSAxLjEyNSAwIDAwLTEuMDEzLS44MjZMMTEuNyAxNy4yNWE1LjY5NiA1LjY5NiAwIDAxLTMuOTU0LTMuOTU0bC0uMjUyLTAuOTVhMS4xMjUgMS4xMjUgMCAwMC0uODI2LTEuMDEzbC0xLjk2Ni0uNTE2YTEuMTI1IDEuMTI1IDAgMDAtMS41ODEuMjEzSDEuMTkxYzAtMS4xNS45OS0yLjExMSAyLjEzLTIuMDcxeiIvPjwvc3ZnPg==';
        $whatsappIcon =
            'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iIzI1RDM2NiI+PHBhdGggZD0iTTEyLjA0IDJDNi40OCAyIDIuMTMgNi4zNSAyLjEzIDEyLjMxYzAgMi4xNS41MyA0LjE3IDEuNTQgNi4wbC0xLjY0IDUuOThsNi4xMi0xLjYxYTEwLjEyIDEwLjEyIDAgMDE0Ljg5IDEuMzdjNS41NiAwIDkuOTEtNC4zNSA5LjkxLTEwLjMxUzE3LjYgMiAxMi4wNCAyek05LjE4IDE2LjAyYy0uMzItLjI0LS41My0uNzYtMS4wMy0xLjE3YTEuOTEgMS45MSAwIDAxLS40LTEuNzZjLjA5LS41OS4zOS0xLjUuNzEtMi4xMS4yMi0uNC41LS43NC43NS0xLjExYTIuMDcgMi4wNyAwIDAxMS4zNS0uODhjLjIzLS4wNC40Ni0uMDUuNjktLjA1LjY1IDAgMS4wNy40MSAxLjI1Ljk3LjIxLjY4LjAyIDEuNDEtLjQ4IDEuOTQtLjUxLjU0LTEuMDUgMS4wNy0xLjU3IDEuNjEuOTkgMS4wNiAyLjIxIDIuMDYgMy41MiAyLjc2LjI5LjE1LjYxLjI0LjkzLjI4LjQ0LjA1Ljg3LS4wMiAxLjI0LS4yNy4yNi0uMTcuNDMtLjQyLjUtLjY5LjExLS4zNS4xMS0uNzYtLjAzLTEuMTJhMS4yOCAxLjI4IDAgMDAtLjY3LS45MmMtLjMxLS4xOC0uNjgtLjE4LS45OS4wMS0uMzMuMTktLjY0LjQxLS45NC42MmEuODkuODkgMCAwMS0xLjAyLjExYy0xLjQ3LS43Ny0yLjY3LTEuOTgtMy40LTMuNDVhLjg5Ljg5IDAgMDExMS0xLjAyYy4yMS0uMzEuNDMtLjYxLjYyLS45NC4yLS4zMS4yLS42OS4wMS0uOTljLS4xNy0uMzQtLjQ4LS41OS0uODMtLjY3LS4zNy0uMDgtLjc3LS4wOC0xLjEyLjAzLS4yOC4wOC0uNTMuMjMtLjY5LjUuMTQtLjM3LjQ1LS42OC44OC0uODQuNDEtLjE2Ljk1LS4xOCAxLjM4LjAxLjIzLjEuNDMuMjguNTcuNTEuMTQuMjUuMjkuNS40NC43NS4xNS4yNS4yNS41MS4yNC43Ny0uMTIuNTYtLjQzIDEuMDctLjgzIDEuNDctLjU0LjU0LTEuMDggMS4wOS0xLjYyIDEuNjMtLjUxLjUxLTEuMDcgMS4wNy0xLjU4IDEuNjh6Ii8+PC9zdmc+';
        $emailIcon =
            'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iIzFhM2E4ZiI+PHBhdGggZD0iTTMS41IDguNjc1VjE4YTIuMjUgMi4yNSAwIDAwMi4yNSAyLjI1aDE2LjVhMi4yNSAyLjI1IDAgMDAyLjI1LTIuMjVWOC42NzVsLTguOTI0IDUuMTgzYTEuNSAxLjUgMCAwMS0xLjE1MiAwTDEuNSA4LjY3NXpNMjIuNSA2YTIuMjUgMi4yNSAwIDAwLTIuMjUtMi4yNUgzLjc1QTIuMjUgMi4yNSAwIDAwMS41IDZ2LjY5M2wxMC41IDYuMDY5IDEwLjUtNi4wNjlWNnoiLz48L3N2Zz4=';
    @endphp

    <div class="carte">
        {{-- Logo en Filigrane --}}
        @if ($logo && file_exists($logo))
            <img class="background-logo" src="{{ $logo }}" alt="Logo Background">
        @endif

        <div class="border-inner">

            <div class="header">
                <div class="logo-container">
                    @if ($logo && file_exists($logo))
                        <img class="logo-img" src="{{ $logo }}" alt="Logo Small">
                    @endif
                    <div class="site-name">{{ $siteName }}</div>
                </div>
                <div class="invitation-title">INVITATION</div>
            </div>
             <div class="invite-name-container">
                <div class="invite-name">M/Mme/Mlle {{ $invite->nom }}</div>
            </div>
            <div class="invitation-body">
                <div class="motif-text">
                    @if ($parametres?->event_motif)
                        {!! nl2br($parametres->event_motif) !!}
                    @endif
                </div>
            </div>





            <div class="footer">
                <div class="contacts">
                    <span class="contact-item">
                        <img src="{{ $phoneIcon }}" class="footer-icon"> {{ $parametres->phone1 ?? 'N/A' }}
                    </span>
                    <span class="contact-item">
                        <img src="{{ $whatsappIcon }}" class="footer-icon"> {{ $parametres->phone2 ?? 'N/A' }}
                    </span>
                </div>

                @if ($invite->numero_table)
                    <div class="table-info">
                        Table N° {{ $invite->numero_table }}
                    </div>
                @endif
                <div class="clear"></div>
            </div>
        </div>
    </div>

</body>

</html>
