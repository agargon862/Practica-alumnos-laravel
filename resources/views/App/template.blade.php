<!DOCTYPE html>
<html class="no-js" lang="es">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('title', 'Gestión de Alumnos')</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-5.0.0-beta1.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/LineIcons.2.0.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/tiny-slider.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/lindy-uikit.css') }}"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    @stack('styles')
  </head>
  <body>

  
    <!-- ========================= header start ========================= -->
    <header class="header header-6">
      <div class="navbar-area">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12">
              <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="{{ route('main') }}">
                  <img src="{{ asset('assets/img/logo/logo.svg') }}" alt="Logo" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent6" aria-controls="navbarSupportedContent6" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="toggler-icon"></span>
                  <span class="toggler-icon"></span>
                  <span class="toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent6">
                  <ul id="nav6" class="navbar-nav ms-auto">
                    <li class="nav-item">
                      <a class="page-scroll {{ request()->routeIs('main') ? 'active' : '' }}" href="{{ route('main') }}">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="page-scroll {{ request()->routeIs('alumno.*') ? 'active' : '' }}" href="{{ route('alumno.index') }}">Alumnos</a>
                    </li>
                    <li class="nav-item">
                      <a class="page-scroll {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                    </li>
                  </ul>
                </div>
                
                <div class="header-action d-flex">
                  <a href="{{ route('alumno.create') }}" title="Crear Alumno"> 
                    <i class="lni lni-plus"></i> 
                  </a>
                  <a href="{{ route('alumno.index') }}" title="Ver Alumnos"> 
                    <i class="lni lni-users"></i> 
                  </a>
                </div>
                <!-- navbar collapse -->
              </nav>
              <!-- navbar -->
            </div>
          </div>
          <!-- row -->
        </div>
        <!-- container -->
      </div>
      <!-- navbar area -->
    </header>
    <!-- ========================= header end ========================= -->

    <!-- ========================= main content start ========================= -->
    <main>
      @yield('content')
    </main>
    <!-- ========================= main content end ========================= -->

    <!-- ========================= footer start ========================= -->
    <footer class="footer footer-style-4 mt-5">
      <div class="container">
        <div class="copyright-wrapper wow fadeInUp" data-wow-delay=".2s">
          <p>Gestión de Alumnos - {{ date('Y') }}</p>
        </div>
      </div>
    </footer>
    <!-- ========================= footer end ========================= -->

    <!-- ========================= scroll-top start ========================= -->
    <a href="#" class="scroll-top"> <i class="lni lni-chevron-up"></i> </a>
    <!-- ========================= scroll-top end ========================= -->
    

    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('js/bootstrap-5.0.0-beta1.min.js') }}"></script>
    <script src="{{ asset('js/tiny-slider.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    
    @stack('scripts')
  </body>
</html>