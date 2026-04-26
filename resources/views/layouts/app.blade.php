<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token pour sécuriser les formulaires POST -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Titre dynamique, défini dans les vues enfants -->
    <title>@yield('title')</title>




<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



    <!-- Polices Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ion Slider -->
  <link rel="stylesheet" href="{{asset('admin/plugins/ion-rangeslider/css/ion.rangeSlider.min.css') }}">
  <!-- bootstrap slider -->
  <link rel="stylesheet" href="{{asset('admin/plugins/bootstrap-slider/css/bootstrap-slider.min.css') }}">
    <!-- Font Awesome 4.7 pour les icônes -->
     <!-- Font Awesome 6 (version recommandée) -->


 <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

     <!-- Ionicons pour icônes -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Font Awesome 6 en CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Font Awesome local (AdminLTE) -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Feuilles de styles CSS personnalisées -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    <!-- Owl Carousel pour sliders -->
    <link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.theme.default.min.css') }}" rel="stylesheet">

    <!-- Plugin Exzoom pour zoom sur images produits -->
    <link href="{{ asset('assets/exzoom/jquery.exzoom.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AlertifyJS pour notifications -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

    <!-- jQuery UI CSS -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    @livewireStyles
</head>

<body class="d-flex flex-column min-vh-100">
    <div id="app">

        {{-- Inclusion du navbar frontend --}}
        @include('layouts.inc.frontend.navbar')

        {{-- Zone de contenu dynamique injectée par chaque page --}}
        <main class="flex-grow-1">
            @yield('content')
        </main>

        {{-- Inclusion du footer frontend --}}
        @include('layouts.inc.frontend.footer')

    </div>






    <!-- Scripts JS -->
    <script src="{{ asset('assets\js\bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets\js\jquery-3.6.0.min.js') }}"></script>


    {{-- AlertifyJS pour les notifications --}}
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>

    <script>
        // Écouteur d'événement personnalisé pour les notifications via AlertifyJS
        window.addEventListener('notify', event => {
            alertify.set('notifier', 'position', 'top-right');
            alertify.notify(event.detail.text, event.detail.type);
        });
    </script>

    {{-- Owl Carousel JS --}}
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>

    {{-- Exzoom JS pour le zoom sur images produits --}}
    <script src="{{ asset('assets/exzoom/jquery.exzoom.js') }}"></script>

<!-- jQuery et jQuery UI JS -->

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>


<script src="{{asset('admin/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<!-- Bootstrap slider -->
 <!-- Summernote -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css')}}">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.css')}}">

<!-- Bootstrap slider -->
<script src="{{asset('admin/plugins/bootstrap-slider/bootstrap-slider.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Initialiser DataTables
$(document).ready(function() {
    $('.datatable').DataTable({
        responsive: true,
        autoWidth: false
    });
});

// Initialiser Summernote
$(document).ready(function() {
    $('.editor').summernote({
        tabsize: 2,
        height: 150
    });
});
</script>



    {{-- Section pour scripts spécifiques à chaque page --}}
    @yield('scripts')

    {{-- Scripts Livewire --}}
    @livewireScripts

    {{-- Pile pour scripts supplémentaires --}}
    @stack('scripts')


</body>

</html>

