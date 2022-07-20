<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container">
        <!-- Navbar brand -->
        <a class="navbar-brand me-2" href="/">
            <img src="https://www.g3tech.com.pt/wp-content/uploads/2019/08/logocr01-1.png" height="16" alt="MDB Logo"
                loading="lazy" style="margin-top: -1px;" />
        </a>

        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample"
            aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarButtonsExample">
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    {{-- <a class="nav-link" href="#">{{ trans('utilizador.dashHome') }}</a> --}}
                </li>
            </ul>
            <div class="d-flex align-items-center">
                {{-- login btn --}}
                <button type="button" class="btn btn-link px-3 me-2 btnLogin">
                    <i class="fa-solid fa-user me-2"></i>
                    {{ trans('utilizador.entrar') }}
                </button>
                {{-- abrir ponto --}}
                <button type="button" class="btn btn-primary me-3 btn-abrirPonto">
                    <i class="fa-solid fa-clock me-2 fa-2x"></i>
                    {{ trans('utilizador.abrirP') }}
                </button>
                {{-- fechar ponto --}}
                <button type="button" class="btn btn-secondary me-3 btn-fecharPonto">
                    <i class="fa-solid fa-clock me-2 fa-2x"></i>
                    {{ trans('utilizador.fecharP') }}
                </button>
              
                {{-- backoffice test --}}
                {{-- <button type="button" class="btn btn-secondary me-3" id="backofficeTest">
                    backoffice
                </button> --}}
            </div>
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->
