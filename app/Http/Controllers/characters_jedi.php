<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
class characters_jedi extends Controller
{
    public function index()
    {
        try {
            $jediCharacterNames = [];
            $jediData = json_decode(file_get_contents('https://swapi.dev/api/films/3'), true);
            if(array_key_exists('characters', $jediData)) {
                foreach($jediData['characters'] as $characterUrl) {
                    $characterData = json_decode(file_get_contents($characterUrl), true);
                    $jediCharacterNames [] = array_key_exists('name', $characterData) ? $characterData['name'] : 'n/a';
                }
            }
            return view('characters_jedi', ["jediCharacterNames" => $jediCharacterNames]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return view('error');
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return view('error');
        }  
    }
 
}
