@extends('layouts.app')

@section('title', 'home page')

@section('content')

<!-- Carousel Start -->
<div class="container-fluid px-0 mb-5">
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="frontend/img/car5.jpeg" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="col-lg-7 text-start">
                            <p class="fs-4 text-primary h6 animated slideInRight"></p>
                            <h4 class="text-white animated slideInRight">
                                Appuyez sur le bouton pour vous s'inscrire en tant qu'un formateur.
                            </h4>

                            @auth
                            {{-- Si l'utilisateur est connecté, lien vers le formulaire --}}
                            <a href="{{ route('frontend.recrutementForm') }}" class="btn btn-primary rounded-pill py-3 px-5 animated slideInRight">
                                S'inscrire
                            </a>
                            @else
                            {{-- Si non connecté, redirige vers login --}}
                            <a href="{{ route('frontend.login') }}" class="btn btn-primary rounded-pill py-3 px-5 animated slideInRight">
                                Connectez-vous pour vous inscrire
                            </a>
                            @endauth
                        </div>

                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="frontend/img/caro2.jpeg" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-end">
                            <div class="col-lg-7 text-end">
                                <p class="fs-4 text-primary animated slideInLeft">Bienvenu à la <strong>Sté MAFLYT Sarl</strong></p>
                                <h4 class=" text-white  animated slideInLeft">Maitrisez les Notions de Base sur Office.</h4>
                                <a href="{{('/new-arrivals')}}" class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">En Savoir Plus</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->
<!-- Service Start -->
<div class="container-xxl py-3">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp mb-5" data-wow-delay="0.1s" style="max-width: 500px;">
            <h2>Nos Options de Formations</h2>
            <p class="mb-0">Notre formation couvre les compétences essentielles en bureautique, incluant Word, Excel, PowerPoint l'utilisation d'Internet (e services et educ master).
            </p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item position-relative h-100">
                    <div class="service-text rounded p-5">
                        <div class="btn-square bg-light rounded-circle mx-auto mb-4" style="width: 64px; height: 64px;">
                            <img class="img-fluid" src="frontend/img/icon/icon-5.png" alt="Icon">
                        </div>
                        <h5 class="mb-3">1- Formation de base en informatique</h4>
                            <p class="mb-0">Manipulation de l’outil informatique, Suite bureautique (Word, Excel, PowerPoint), Internet, E-services et Educ-master.</p>
                    </div>
                    <div class="service-btn rounded-0 rounded-bottom">
                        <a class="text-primary fw-medium" href="#">Voir Plus<i class="bi bi-chevron-double-right ms-2"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item position-relative h-100">
                    <div class="service-text rounded p-5">
                        <div class="btn-square bg-light rounded-circle mx-auto mb-4" style="width: 64px; height: 64px;">
                            <img class="img-fluid" src="frontend/img/icon/icon-6.png" alt="Icon">
                        </div>
                        <h5 class="mb-3"> 2- Formation de base en informatique + Achat de PC</h4>
                            <p class="mb-0">Manipulation de l’outil informatique, Suite bureautique (Word, Excel, PowerPoint), Internet, E-services et Educ-master Plus Achat d'un ordinateur portable</p>
                    </div>
                    <div class="service-btn rounded-0 rounded-bottom">
                        <a class="text-primary fw-medium" href="#">Voir Plus<i class="bi bi-chevron-double-right ms-2"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item position-relative h-100">
                    <div class="service-text rounded p-5">
                        <div class="btn-square bg-light rounded-circle mx-auto mb-4" style="width: 64px; height: 64px;">
                            <img class="img-fluid" src="frontend/img/icon/icon-7.png" alt="Icon">
                        </div>
                        <h5 class="mb-3"> 3- Récyclage</h4>
                            <p class="mb-0">Rappel sur les manipulations de l’outil informatique, Suite bureautique (Word, Excel, PowerPoint), Internet, E-services et Educ-master.</p>
                    </div>
                    <div class="service-btn rounded-0 rounded-bottom">
                        <a class="text-primary fw-medium" href="#">Voir Plus<i class="bi bi-chevron-double-right ms-2"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Service End -->

@endsection