<aside class="main-sidebar sidebar-dark-primary elevation-4">

    @php
        $logo = $parametres?->photo ? asset('uploads/' . $parametres->photo) : asset('uploads/default.png');
        $siteName = $parametres?->website_name ?? 'MAFLYT';
    @endphp

    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ $logo }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity:.8">
        <span class="brand-text font-weight-light">{{ $siteName }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                <!-- ACCUEIL -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ setMenuClass('home', 'active') }}">
                        <i class="nav-icon fas fa-home text-primary"></i>
                        <p>Accueil</p>
                    </a>
                </li>

                <!-- ADMIN -->
                @can('administrateur')
                <li class="nav-item has-treeview {{ setMenuClass('administrateur.', 'menu-open') }}">
                    <a href="#" class="nav-link {{ setMenuClass('administrateur.', 'active') }}">
                        <i class="nav-icon fas fa-user-shield text-info"></i>
                        <p>
                            Administration
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('administrateur.dashboard') }}"
                               class="nav-link {{ setMenuClass('administrateur.dashboard', 'active') }}">
                                <i class="nav-icon fas fa-chart-line text-success"></i>
                                <p>Tableau de bord</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('administrateur.gestutilisateurs.users.index') }}"
                               class="nav-link {{ setMenuClass('administrateur.gestutilisateurs.', 'active') }}">
                                <i class="nav-icon fas fa-users text-warning"></i>
                                <p>Utilisateurs</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('administrateur.gestparametres.parametres.index') }}"
                               class="nav-link {{ setMenuClass('administrateur.gestparametres.', 'active') }}">
                                <i class="nav-icon fas fa-cogs text-danger"></i>
                                <p>Paramètres</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                <!-- INFORMATICIEN -->
                @can('informaticien')
                <li class="nav-item has-treeview {{ setMenuClass('informaticien.', 'menu-open') }}">
                    <a href="#" class="nav-link {{ setMenuClass('informaticien.', 'active') }}">
                        <i class="nav-icon fas fa-user-tie text-warning"></i>
                        <p>
                            Gestion des invités
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('informaticien.gestinvites.invites.index') }}"
                               class="nav-link {{ setMenuClass('informaticien.gestinvites.', 'active') }}">
                                <i class="nav-icon fas fa-chalkboard-teacher text-info"></i>
                                <p>Invités</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

            </ul>
        </nav>
    </div>
</aside>
