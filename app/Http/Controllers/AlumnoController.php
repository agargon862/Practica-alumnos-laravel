<?php

namespace App\Http\Controllers;

// Importación de clases necesarias
use App\Models\Alumno;                                   // Modelo Alumno
use Illuminate\Database\QueryException;                  // Excepciones generales de BD
use Illuminate\Database\UniqueConstraintViolationException; // Excepción de valores únicos
use Illuminate\Http\RedirectResponse;                   // Tipo de retorno para redirección
use Illuminate\Http\Request;                            // Request HTTP (datos del usuario)
use Illuminate\View\View;                               // Tipo de retorno de vistas

class AlumnoController extends Controller
{
    /**
     * Muestra la lista completa de alumnos.
     */
    function index(): View {

        // Obtiene todos los registros de la tabla alumnos
        $alumnos = Alumno::all();

        // Envía los datos a la vista alumno/index
        return view('alumno.index', ['alumnos' => $alumnos]);
    }


    /**
     * Muestra el formulario para crear un nuevo alumno.
     */
    function create(): View {
        // Retorna la vista con el formulario de creación
        return view('alumno.create');
    }


    /**
     * Guarda un nuevo alumno en la base de datos.
     */
    function store(Request $request): RedirectResponse {

        $result = false;  // Variable para comprobar si el guardado fue exitoso

        try {

            // Crea una nueva instancia de Alumno con los datos excepto archivos
            $alumno = new Alumno($request->except('fotografia', 'pdf_cv'));

            // Guarda el alumno en la base de datos
            $result = $alumno->save();

            // Si el usuario subió una foto, manejarla
            if ($request->hasFile('fotografia')) {
                $this->uploadFoto($request, $alumno);
            }

            // Si el usuario subió un PDF, manejarlo
            if ($request->hasFile('pdf_cv')) {
                $this->uploadPdf($request, $alumno);
            }

            // Mensaje en caso de éxito
            $txtmessage = 'El alumno ha sido añadido.';
        
        // Cuando el correo ya existe (violación de unicidad)
        } catch (UniqueConstraintViolationException $e) {

            $txtmessage = 'El correo ya existe en la base de datos.';

        // Errores generales de consulta SQL
        } catch (QueryException $e) {

            $txtmessage = 'Error en la base de datos: ' . $e->getMessage();

        // Errores inesperados
        } catch (\Exception $e) {

            $txtmessage = 'Error fatal: ' . $e->getMessage();
        }

        // Mensaje que se enviará a la sesión
        $message = ['mensajeTexto' => $txtmessage];

        // Si el guardado fue exitoso, redirige al listado
        if ($result) {
            return redirect()->route('alumno.index')->with($message);

        // Si falló, regresa al formulario con errores y los campos rellenos
        } else {
            return back()->withInput()->withErrors($message);
        }
    }


    /**
     * Guarda la fotografía del alumno.
     */
    private function uploadFoto(Request $request, Alumno $alumno){

        // Obtiene el archivo subido
        $foto = $request->file('fotografia');

        // Crea un nombre único usando el ID del alumno
        $name = $alumno->id . '.' . $foto->getClientOriginalExtension();

        // Guarda el archivo en storage/app/public/fotos
        $path = $foto->storeAs('fotos', $name, 'public');

        // Guarda la ruta en la base de datos
        $alumno->fotografia = $path;
        $alumno->save();
    }


    /**
     * Guarda el archivo PDF del CV del alumno.
     */
    private function uploadPdf(Request $request, Alumno $alumno){

        // Obtiene el archivo PDF subido
        $pdf = $request->file('pdf_cv');

        // Nombre único usando el ID
        $name = $alumno->id . '.' . $pdf->getClientOriginalExtension();

        // Guarda el archivo en storage/app/public/pdfs
        $path = $pdf->storeAs('pdfs', $name, 'public');

        // Actualiza el registro del alumno
        $alumno->pdf_cv = $path;
        $alumno->save();
    }


    /**
     * Muestra un alumno específico.
     */
    function show(Alumno $alumno): View {
        // Devuelve la vista con los datos del alumno
        return view('alumno.show', ['alumno' => $alumno]);
    }


    /**
     * Muestra el formulario de edición para un alumno.
     */
    function edit(Alumno $alumno): View {
        // Devuelve la vista de edición con los datos existentes
        return view('alumno.edit', ['alumno' => $alumno]);
    }


    /**
     * Actualiza los datos del alumno en la base de datos.
     */
    function update(Request $request, Alumno $alumno): RedirectResponse {

        $result = false;  // Para comprobar el éxito

        try {
            // Actualiza los datos excepto archivos
            $alumno->fill($request->except('fotografia', 'pdf_cv'));
            $result = $alumno->save();

            // Si se subió una nueva foto, actualizarla
            if ($request->hasFile('fotografia')) {
                $this->uploadFoto($request, $alumno);
            }

            // Si se subió un nuevo PDF, actualizarlo
            if ($request->hasFile('pdf_cv')) {
                $this->uploadPdf($request, $alumno);
            }

            $txtmessage = 'El alumno ha sido editado.';

        } catch (UniqueConstraintViolationException $e) {

            $txtmessage = 'El correo ya existe.';

        } catch (QueryException $e) {

            $txtmessage = 'Error en la base de datos.';

        } catch (\Exception $e) {

            $txtmessage = 'Error fatal.';
        }

        // Mensaje para la sesión
        $message = ['mensajeTexto' => $txtmessage];

        // Si guardó bien, redirige a la vista del alumno
        if ($result) {
            return redirect()->route('alumno.show', $alumno)->with($message);
        } 
        
        // Si falló, devuelve al formulario con errores
        return back()->withInput()->withErrors($message);
    }


    /**
     * Elimina un alumno de la base de datos.
     */
    function destroy(Alumno $alumno): RedirectResponse {
        try {
            // Elimina el registro
            $alumno->delete();

            return redirect()->route('alumno.index')->with('success', 'Alumno eliminado correctamente');
        
        } catch (\Exception $e) {

            // Si falla, envía un mensaje de error
            return redirect()->route('alumno.index')->with('error', 'Error al eliminar el alumno: ' . $e->getMessage());
        }
    }
}
