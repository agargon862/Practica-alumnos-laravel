<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlumnoController extends Controller
{

    function index(): View {

        $alumnos = Alumno::all();

        return view('alumno.index', ['alumnos' => $alumnos]);
    }


    function create(): View {
        return view('alumno.create');
    }


    function store(Request $request): RedirectResponse {
        $result = false;
        
        try {

            $alumno = new Alumno($request->except('fotografia', 'pdf_cv'));
            $result = $alumno->save();
            
        
            if($request->hasFile('fotografia')){
                $this->uploadFoto($request, $alumno);
            }
            
     
            if($request->hasFile('pdf_cv')){
                $this->uploadPdf($request, $alumno);
            }
            
            $txtmessage = 'El alumno ha sido añadido.';
            
        } catch(UniqueConstraintViolationException $e) {

            $txtmessage = 'El correo ya existe en la base de datos.';
            
        } catch(QueryException $e) {

            $txtmessage = 'Error en la base de datos: ' . $e->getMessage();
            
        } catch(\Exception $e) {

            $txtmessage = 'Error fatal: ' . $e->getMessage();
        }

        $message = ['mensajeTexto' => $txtmessage];
        

        if($result) {
            return redirect()->route('alumno.index')->with($message);
        } else {

            return back()->withInput()->withErrors($message);
        }
    }
    

    private function uploadFoto(Request $request, Alumno $alumno){

        $foto = $request->file('fotografia');

        $name = $alumno->id . '.' . $foto->getClientOriginalExtension();


        $path = $foto->storeAs('fotos', $name, 'public');


        $alumno->fotografia = $path;
        $alumno->save();
    }
    

    private function uploadPdf(Request $request, Alumno $alumno){

        $pdf = $request->file('pdf_cv');

        $name = $alumno->id . '.' . $pdf->getClientOriginalExtension();

  
        $path = $pdf->storeAs('pdfs', $name, 'public');


        $alumno->pdf_cv = $path;
        $alumno->save();
    }

    function show(Alumno $alumno): View {
        return view('alumno.show', ['alumno' => $alumno]);
    }


    function edit(Alumno $alumno): View {
        return view('alumno.edit', ['alumno' => $alumno]);
    }

    function update(Request $request, Alumno $alumno): RedirectResponse {
        $result = false;
        
        try {

            $alumno->fill($request->except('fotografia', 'pdf_cv'));
            $result = $alumno->save();
        
            if($request->hasFile('fotografia')){
                $this->uploadFoto($request, $alumno);
            }
            
            if($request->hasFile('pdf_cv')){
                $this->uploadPdf($request, $alumno);
            }
            
            $txtmessage = 'El alumno ha sido editado.';
            
        } catch(UniqueConstraintViolationException $e) {
            $txtmessage = 'El correo ya existe.';
            
        } catch(QueryException $e) {
            $txtmessage = 'Error en la base de datos.';
            
        } catch(\Exception $e) {
            $txtmessage = 'Error fatal.';
        }
        
        $message = ['mensajeTexto' => $txtmessage];
        
        if($result) {
            return redirect()->route('alumno.show', $alumno)->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }

    function destroy(Alumno $alumno): RedirectResponse {
        try {
            $alumno->delete();
            
            return redirect()->route('alumno.index')->with('success', 'Alumno eliminado correctamente');
            
        } catch (\Exception $e) {
            return redirect()->route('alumno.index')->with('error', 'Error al eliminar el alumno: ' . $e->getMessage());
        }
    }
}