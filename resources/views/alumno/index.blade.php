@extends('App.template')

@section('title', 'Listado de Alumnos')

@section('content')
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Listado de Alumnos</h2>
    <a href="{{ route('alumno.create') }}" class="btn btn-primary rounded-pill">
      <i class="lni lni-plus"></i> Nuevo Alumno
    </a>
  </div>

  @if(session('mensajeTexto'))
    <div class="alert alert-success rounded-3">
      {{ session('mensajeTexto') }}
    </div>
  @endif

  @if(session('success'))
    <div class="alert alert-success rounded-3">{{ session('success') }}</div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
  @endif

  @if($alumnos->isEmpty())
    <div class="text-center py-5">
      <img src="https://cdn-icons-png.flaticon.com/512/4076/4076505.png" alt="Sin alumnos" width="120" class="mb-3 opacity-75">
      <h5 class="text-muted">No hay alumnos registrados aún.</h5>
      <a href="{{ route('alumno.create') }}" class="btn btn-outline-primary mt-3 rounded-pill">Agregar uno nuevo</a>
    </div>
  @else
    <div class="row g-4">
      @foreach($alumnos as $alumno)
        <div class="col-lg-4 col-md-6">
          <div class="card shadow-sm border-0 rounded-4 h-100">
            <div class="card-body text-center p-4 d-flex flex-column justify-content-between">
              
              @if($alumno->fotografia)
                <img src="{{ asset('storage/' . $alumno->fotografia) }}" class="img-fluid rounded-circle shadow-sm" alt="Foto del alumno">
              @else
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="rounded-circle mb-3" width="100" height="100" style="object-fit: cover;" alt="Sin foto">
              @endif

              <h5 class="fw-bold mb-1">{{ $alumno->nombre }} {{ $alumno->apellidos }}</h5>
              <p class="text-muted mb-2">{{ $alumno->correo }}</p>
              <p class="small text-secondary mb-3">{{ $alumno->telefono }}</p>

              <div class="d-flex justify-content-center gap-2 mt-auto">
                <a href="{{ route('alumno.show', $alumno) }}" class="btn btn-outline-primary btn-sm rounded-pill">
                   Ver
                </a>
                <a href="{{ route('alumno.edit', $alumno) }}" class="btn btn-outline-warning btn-sm rounded-pill">
                  Editar
                </a>

                <form action="{{ route('alumno.destroy', $alumno) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este alumno?')" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">
                     Eliminar
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>
@endsection
