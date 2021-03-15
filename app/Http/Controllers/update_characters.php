<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\SwapiCharacter as SwapiCharacter;
use App\UpdateCharacterData as UpdateCharacterData;
use Illuminate\Support\Facades\Log;

class update_characters extends Controller
{
    public function update()
    {
        DB::beginTransaction();
        try {
            $updateCharacterData = UpdateCharacterData::all('name','height','mass','hair_color','birth_year','gender','homeworld_name','species_name')->toArray();
            $names = array_column($updateCharacterData, 'name');
            foreach($updateCharacterData as &$datum){
                $speciesData = json_decode(file_get_contents('https://swapi.dev/api/species/?search='.$datum['species_name']), true);
                if((array_key_exists('count', $speciesData)) && ($speciesData['count'] === 0)){
                    Log::error($datum['species_name']." is not a valid species name");
                    $datum['species_name'] = 'n/a';
                }

                $homeWorldData = json_decode(file_get_contents('https://swapi.dev/api/planets/?search='.$datum['homeworld_name']), true);
                if((array_key_exists('count', $homeWorldData)) && ($homeWorldData['count'] === 0)){
                    Log::error($datum['homeworld_name']." is not a valid planet name");
                    $datum['homeworld_name'] = 'n/a';
                }
                SwapiCharacter::whereIn('name', [$datum['name']])->update($datum);
            }
            DB::commit();
            return view('success');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return view('error');
        } catch (\Throwable $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return view('error');
        }
    }
}
