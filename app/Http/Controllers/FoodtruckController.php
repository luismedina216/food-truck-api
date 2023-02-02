<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;


class FoodtruckController extends Controller
{


    public function index(Request $request)
    {

        $foodServiceRequest = Http::get('https://data.sfgov.org/resource/rqzj-sfat.json');
        $foodData = $foodServiceRequest->json();

        $key = array_search($request->id, array_column($foodData, 'objectid'));

        return response($foodData[$key], 200);
    }

    public function search(Request $request)
    {
        $requestData = $request->validate([
            'search' => 'required'
        ]);

        $foodServiceRequest = Http::get('https://data.sfgov.org/resource/rqzj-sfat.json');
        $foodData = $foodServiceRequest->json();

        $foodFound = $this->getCoincidences($foodData, $requestData['search'], 'applicant');

        return response($foodFound, 200);
    }

    private function getCoincidences($foodData, $search, $column)
    {
        $keysFound = array_filter(
            array_column($foodData, $column),
            function ($value) use ($search) {
                return preg_match('/' . $search . '/i', $value);
            }
        );
        $keysFound = array_keys($keysFound);
        return array_values(array_intersect_key($foodData, array_flip($keysFound)));
    }

}
