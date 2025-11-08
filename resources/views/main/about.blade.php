@extends('App.template')

@section('title', 'Acerca de')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
      <div class="card shadow-sm border-0 rounded-4 p-4">
        <h2 class="text-center mb-3">Acerca del Proyecto</h2>
        <p class="text-muted text-center mb-4">
          Este sistema de gestión de alumnos ha sido desarrollado con Laravel, permitiendo crear, editar y administrar información de estudiantes de manera sencilla y segura.
        </p>

        <hr>

        <div class="text-center mt-3">
          <p><strong>Desarrollado por:</strong> Alejandro García González</p>
          <p><strong>Tecnologías:</strong> Laravel · PHP · MySQL · Bootstrap</p>
          <p><strong>Versión:</strong> 1.0</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
