@extends('App.template')

@section('title', 'Inicio - Gestión de Alumnos')

@section('content')
<section class="hero-section hero-style-5 img-bg" style="background-image: url('{{ asset('assets/img/hero/hero-5/hero-bg.svg') }}')">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="hero-content-wrapper text-center">
          <h2 class="mb-30 wow fadeInUp" data-wow-delay=".2s">Bienvenido a Gestión de Alumnos</h2>
          <p class="mb-30 wow fadeInUp" data-wow-delay=".4s">Sistema para administrar información de estudiantes</p>
          <a href="{{ route('alumno.index') }}" class="button button-lg radius-50 wow fadeInUp" data-wow-delay=".6s">
            Ver Alumnos <i class="lni lni-chevron-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <h3 class="text-center mb-5">Lista de Alumnos</h3>

    @if($alumnos->isEmpty())
      <p class="text-center text-muted">No hay alumnos registrados aún.</p>
    @else
      <div class="row g-4">
        @foreach($alumnos as $alumno)
          <div class="col-md-4 col-lg-3">
            <div class="card shadow-sm border-0 rounded-4 h-100 text-center p-3 hover-shadow transition-all">
              <div class="card-body">
                @if($alumno->fotografia)
                  <img src="{{ asset('storage/' . $alumno->fotografia) }}" 
                       class="rounded-circle mx-auto mb-3 shadow-sm" 
                       style="width:80px; height:80px; object-fit:cover;" 
                       alt="Foto de {{ $alumno->nombre }}">
                @else
                  <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" 
                       class="rounded-circle mx-auto mb-3 shadow-sm" 
                       style="width:80px; height:80px; object-fit:cover;" 
                       alt="Sin foto">
                @endif

                <h5 class="card-title mb-1">{{ $alumno->nombre }} {{ $alumno->apellidos }}</h5>
                <p class="text-muted mb-2" style="font-size: 0.9rem;">{{ $alumno->correo }}</p>
                
                @if($alumno->nota_media)
                  <span class="badge bg-primary mb-2">Nota: {{ $alumno->nota_media }}</span>
                @endif
                
                <a href="{{ route('alumno.show', $alumno->id) }}" class="btn btn-outline-primary btn-sm mt-2 rounded-pill">
                  Ver detalles
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>
@endsection