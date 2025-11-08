@extends('App.template')

@section('title', 'Detalles del Alumno')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
      <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
          <h3 class="text-center mb-4">Detalles del Alumno</h3>

          @if(session('mensajeTexto'))
            <div class="alert alert-success rounded-3">
              {{ session('mensajeTexto') }}
            </div>
          @endif

          <div class="row g-4">
            <div class="col-md-4 text-center">
              @if($alumno->fotografia)
                <img src="{{ asset('storage/' . $alumno->fotografia) }}" class="img-fluid rounded-circle shadow-sm" alt="Foto del alumno">
              @else
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="img-fluid rounded-circle shadow-sm" alt="Sin foto">
              @endif
            </div>

            <div class="col-md-8">
              <h4 class="fw-bold mb-1">{{ $alumno->nombre }} {{ $alumno->apellidos }}</h4>
              <p class="text-muted mb-3">{{ $alumno->correo }}</p>

              <p><strong>Teléfono:</strong> {{ $alumno->telefono }}</p>
              <p><strong>Fecha de nacimiento:</strong> {{ \Carbon\Carbon::parse($alumno->fecha_nacimiento)->format('d/m/Y') }}</p>
              <p><strong>Nota media:</strong> {{ $alumno->nota_media ?? 'No indicada' }}</p>
            </div>
          </div>

          <hr class="my-4">

          <div class="mb-4">
            <h5 class="fw-bold mb-3">
              <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
              Currículum Vitae
            </h5>
            
            @if($alumno->pdf_cv)
              <div class="card bg-light border-0">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <p class="mb-1"><strong>Archivo:</strong> CV_{{ $alumno->nombre }}_{{ $alumno->apellidos }}.pdf</p>
                      <p class="mb-0 text-muted small">Currículum en formato PDF</p>
                    </div>
                    <div>
                      <a href="{{ asset('storage/' . $alumno->pdf_cv) }}" target="_blank" class="btn btn-danger me-2">
                        <i class="bi bi-eye me-1"></i> Ver PDF
                      </a>
                      <a href="{{ asset('storage/' . $alumno->pdf_cv) }}" download class="btn btn-outline-danger">
                        <i class="bi bi-download me-1"></i> Descargar
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            @else
              <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Este alumno aún no ha subido su currículum.
              </div>
            @endif
          </div>

          <hr class="my-4">

          <div>
            <p><strong>Experiencia:</strong><br>{{ $alumno->experiencia ?? 'Sin especificar' }}</p>
            <p><strong>Formación:</strong><br>{{ $alumno->formacion ?? 'Sin especificar' }}</p>
            <p><strong>Habilidades:</strong><br>{{ $alumno->habilidades ?? 'Sin especificar' }}</p>
          </div>

          <div class="text-center mt-4">
            <a href="{{ route('alumno.edit', $alumno) }}" class="btn btn-warning px-4 rounded-pill me-2">Editar</a>
            <a href="{{ route('alumno.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">Volver</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection