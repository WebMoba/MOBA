<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Person;
use App\Models\NumberPhone;



class BusquedaController extends Controller
{
    public function buscar(Request $request)
{
    // Obtener el término de búsqueda del formulario
    $termino = $request->input('termino');
    // Realizar la consulta para buscar eventos que coincidan con el término
    $events = Event::where('place', 'LIKE', "%$termino%")
    ->orWhere('title', 'LIKE', "%$termino%")
    ->orWhere('description', 'LIKE', "%$termino%")
    ->orWhere('importance', 'LIKE', "%$termino%")
    ->paginate();
    // Imprimir los resultados para verificar si hay resultados en la consulta
    // Pasar los resultados de la búsqueda a la vista 'event.index' y paginarlos
    return view('event.index', compact('events'))
    // Calcular la numeración de los elementos en la página actual
    ->with('i', (request()->input('page', 1) - 1) * $events->perPage());

}
    public function buscarPeople(Request $request){

    // Obtener el término de búsqueda del formulario
    $findId = $request->input('findId');
    // Realizar la consulta para buscar eventos que coincidan con el término
    $people = Person::where('id_card', 'LIKE', "%$findId%")->paginate();
    // Imprimir los resultados para verificar si hay resultados en la consulta
    // Pasar los resultados de la búsqueda a la vista 'event.index' y paginarlos
    return view('person.index', compact('people'))
    // Calcular la numeración de los elementos en la página actual
    ->with('i', (request()->input('page', 1) - 1) * $people->perPage());

}
public function buscarCel(Request $request)
{
    // Obtener el término de búsqueda del formulario
    $findCel = $request->input('findCel');

    // Realizar la consulta para buscar números de teléfono que coincidan con el término
    $numberPhones = NumberPhone::where('number', 'LIKE', "%$findCel%")->paginate();

    // Pasar los resultados de la búsqueda a la vista 'number-phone.index' y paginarlos
    return view('number-phone.index', compact('numberPhones'))
        ->with('i', (request()->input('page', 1) - 1) * $numberPhones->perPage());
}
}
