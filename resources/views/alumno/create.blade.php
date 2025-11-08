@extends('App.template')

@section('title', 'Añadir Alumno - Gestión de Alumnos')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
      <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
          <h3 class="text-center mb-4">Añadir Nuevo Alumno</h3>

          {{-- Mensajes de error --}}
          @if($errors->any())
            <div class="alert alert-danger rounded-3">
              @foreach($errors->all() as $error)
                <p class="mb-0">{{ $error }}</p>
              @endforeach
            </div>
          @endif

          {{-- Mensaje de éxito --}}
          @if(session('mensajeTexto'))
            <div class="alert alert-success rounded-3">
              {{ session('mensajeTexto') }}
            </div>
          @endif

          <form action="{{ route('alumno.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
              <div class="col-md-6">
                <label for="nombre" class="form-label fw-semibold">Nombre</label>
                <input type="text" class="form-control rounded-3" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
              </div>

              <div class="col-md-6">
                <label for="apellidos" class="form-label fw-semibold">Apellidos</label>
                <input type="text" class="form-control rounded-3" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required>
              </div>

              <div class="col-md-6">
                <label for="telefono" class="form-label fw-semibold">Teléfono</label>
                <input type="text" class="form-control rounded-3" id="telefono" name="telefono" value="{{ old('telefono') }}" required>
              </div>

              <div class="col-md-6">
                <label for="correo" class="form-label fw-semibold">Correo Electrónico</label>
                <input type="email" class="form-control rounded-3" id="correo" name="correo" value="{{ old('correo') }}" required>
              </div>

              <div class="col-md-6">
                <label for="fecha_nacimiento" class="form-label fw-semibold">Fecha de Nacimiento</label>
                <input type="date" class="form-control rounded-3" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
              </div>

              <div class="col-md-6">
                <label for="nota_media" class="form-label fw-semibold">Nota Media</label>
                <input type="number" step="0.01" min="0" max="10" class="form-control rounded-3" id="nota_media" name="nota_media" value="{{ old('nota_media') }}">
              </div>

              <div class="col-12">
                <label for="experiencia" class="form-label fw-semibold">Experiencia</label>
                <textarea class="form-control rounded-3" id="experiencia" name="experiencia" rows="2">{{ old('experiencia') }}</textarea>
              </div>

              <div class="col-12">
                <label for="formacion" class="form-label fw-semibold">Formación</label>
                <textarea class="form-control rounded-3" id="formacion" name="formacion" rows="2">{{ old('formacion') }}</textarea>
              </div>

              <div class="col-12">
                <label for="habilidades" class="form-label fw-semibold">Habilidades</label>
                <textarea class="form-control rounded-3" id="habilidades" name="habilidades" rows="2">{{ old('habilidades') }}</textarea>
              </div>

              <div class="col-md-6">
                <label for="fotografia" class="form-label fw-semibold">Fotografía</label>
                <input type="file" class="form-control rounded-3" id="fotografia" name="fotografia" accept="image/*">
              </div>

              <div class="col-md-6">
                <label for="pdf_cv" class="form-label fw-semibold">Currículum (PDF)</label>
                <input type="file" class="form-control rounded-3" id="pdf_cv" name="pdf_cv" accept="application/pdf">
              </div>

              <div class="col-12 text-center mt-4">
                <button type="submit" class="btn btn-primary px-4 rounded-pill">
                  <i class="lni lni-plus"></i> Guardar Alumno
                </button>
                <a href="{{ route('alumno.index') }}" class="btn btn-outline-secondary px-4 rounded-pill ms-2">
                  Cancelar
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
