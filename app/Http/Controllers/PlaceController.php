<?php

namespace App\Http\Controllers;

use App\Services\PlaceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    protected PlaceService $service;
    public function __construct(PlaceService $service)
    {
        $this->service = $service;
    }
    
    public function index()
    {
        $places = $this->service->getAllPlaces();
        return json_encode($places);
    }

    public function search(Request $request) {
         // Obter o parâmetro de busca da query string
         $query = $request->query('q');

         // Verificar se o parâmetro de busca está presente
         if (!$query) {
             return response()->json(['error' => 'Parâmetro de busca não fornecido.'], 400);
         }
 
         // Chamar o serviço para buscar os lugares
         $places = $this->service->searchPlaces($query);
 
         // Retornar o resultado como JSON
         return response()->json($places);
    }

    public function show($id)
    {
        $place = $this->service->getPlaceById($id);
        if ($place) {
            return json_encode($place);
        }
        return response()->json(['message' => 'Place not found'], 404);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' =>'required|max:255',
           'slug' =>'required|unique:places|max:255',
            'city' =>'required|max:255',
           'state' =>'required|max:255',
        ]);

        $place = $this->service->createPlace($validatedData);
        return json_encode($place);
    }

    public function update(Request $request, $id)
    {
        $place = $this->service->getPlaceById($id);
        if (!$place) {
            return response()->json(['message' => 'Place not found'], 404);
        }

        $validatedData = $request->validate([
            'name' =>'required|max:255',
           'slug' =>'required|unique:places,slug,'. $id. '|max:255',
            'city' =>'required|max:255',
           'state' =>'required|max:255',
        ]);

        $updatedPlace = $this->service->updatePlace($place, $validatedData);
        return json_encode($updatedPlace);
    }

    public function destroy($id)
    {
        $place = $this->service->getPlaceById($id);
        if (!$place) {
            return response()->json(['message' => 'Place not found'], 404);
        }

        $this->service->deletePlace($place);
        return response()->json(['message' => 'Place deleted successfully'], 204);
    }
}
