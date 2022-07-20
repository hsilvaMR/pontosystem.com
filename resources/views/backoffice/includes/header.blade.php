<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light headerBackoffice">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="{{ route('pageDashboard') }}">
                <img src="https://www.g3tech.com.pt/wp-content/uploads/2019/08/logocr01-1.png" height="15"
                    alt="MDB Logo" loading="lazy" />
            </a>
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item  border border-1 border-primary me-2">
                    <a class="nav-link" href="{{ route('pageGestUser') }}">
                        <i class="fa-solid fa-users me-1"></i>
                        {{ trans('backoffice.menu1') }}
                    </a>
                </li>
                <li class="nav-item border border-1 border-primary me-2 ">
                    <a class="nav-link" href="{{ route('pagePontos') }}">
                        <i class="fa-solid fa-clock me-1"></i>
                        {{ trans('backoffice.menu2') }}
                    </a>
                </li>
                {{-- consultar horas --}}
                <li class="nav-item border btnConsulta border-1 border-primary me-2" style="cursor: pointer;">
                    <a class="nav-link">
                        <i class="fa-solid fa-user-clock me-1"></i>
                        {{ trans('backoffice.menu3') }}
                    </a>
                </li>
                {{-- user profile  id="navbarDropdown --}}
                <li class="nav-item me-3 me-lg-0 dropdown">

                    <a class="nav-link dropdown-toggle border border-1 border-primary" role="button"
                        data-bs-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fas fa-user me-1"></i>
                        {{-- {{ trans('backoffice.menu4') }} --}}
                        {{ json_decode(\Cookie::get('admin_cookie'))->nome }}
                    </a>

                    <ul class="dropdown-menu">

                        {{-- ver conta --}}
                        <li>
                            <a class="dropdown-item" href="{{ route('pageShowAdmin') }}">
                                <i class="fa-solid fa-address-card me-1"></i>
                                {{ trans('backoffice.submenu1') }}
                            </a>
                        </li>
                        {{-- editar conta   --}}
                        <li>
                            <a class="dropdown-item" href="{{route('pageEditAdmin',json_decode(Cookie::get("admin_cookie"))->id) }}">
                                <i class="fa-solid fa-user-pen me-1"></i>
                                {{ trans('backoffice.submenu2') }}
                            </a>
                        </li>
                        {{-- sair --}}
                        <li>
                            <a class="dropdown-item" href="/">
                                <i class="fa-solid fa-right-to-bracket me-1"></i>
                                {{ trans('backoffice.submenu3') }}
                            </a>
                        </li>
                    </ul>

                </li>

                {{-- sair --}}
                <li class="nav-item border border-1 border-primary ms-2 ">
                    <a class="nav-link" href="/">
                        <i class="fa-solid fa-right-to-bracket me-1"></i>
                        {{ trans('backoffice.menu5') }}
                    </a>
                </li>
            </ul>
            <!-- Left links -->
        </div>

    </div>
</nav>
<!-- Navbar -->
