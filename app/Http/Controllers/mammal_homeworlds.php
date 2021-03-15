<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

const MAMMAL_VALUE = "mammal"; 
class mammal_homeworlds extends Controller
{
    public function index()
    {
        try {
            $perPage = 10;
            $page = 1;
            $speciesData = json_decode(file_get_contents('https://swapi.dev/api/species/'), true);
            $count = array_key_exists('count', $speciesData) ? $speciesData['count'] : 0;
            if($count > 0) {
                $nextPage = $page + 1;
                $totalPages = ceil($count/$perPage);
                if(!array_key_exists('results', $speciesData)) {
                    Log::info("No mammals to insert");
                }
                $mammals = $this->getMammal($speciesData['results']);
                if($totalPages>1) {
                    for($pageCounter = $nextPage; $pageCounter <= $totalPages; $pageCounter ++) {
                        $speciesData = json_decode(file_get_contents('https://swapi.dev/api/species/?page='.$pageCounter), true);
                        $mammals = array_merge($mammals, $this->getMammal($speciesData['results']));
                        $nextPage = $pageCounter + 1;
                    }
                }
            }   
            return view('mammal_homeworlds', ["mammals" => $mammals]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return view('error');
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return view('error');
        } 
    }

    public function getMammal($species) 
    {
        $mammals = [];
        foreach($species as $singleSpecies) {
            if(array_key_exists('classification', $singleSpecies)) {
                if($singleSpecies['classification'] === (\Config::get('constants.mammal_value'))) {
                    if(array_key_exists('name', $singleSpecies)) {
                        $mammals [] = $singleSpecies['name'];
                    }
                }
            }
        }
        return $mammals;
    }
 
}
