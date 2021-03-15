<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\SwapiCharacter as SwapiCharacter;
use Illuminate\Support\Facades\Log;

class import_characters extends Controller
{
    public function index()
    {
        DB::beginTransaction();
        try {
            $swapiCharacter = new SwapiCharacter();  
            $swapiCharacter->query()->delete();
            $importedResult = $this->getAllChars();
            if(!$importedResult) {
                Log::info("No characters to insert");
            } else {
                DB::commit();
                Log::info('Characters imported successfully');
            }
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

    public function getAllChars($page = 1) {
        $flag = false;
        $perPage = 10;
        $json = json_decode(file_get_contents('https://swapi.dev/api/people/'), true);
        $count = array_key_exists('count', $json) ? $json['count'] : 0;
        if($count > 0) {
            $nextPage = $page + 1;
            $totalPages = ceil($count/$perPage);
            if(!array_key_exists('results', $json)) {
                return $flag;
            }
            $this->insertData($json['results']);
            if($totalPages>1) {
                for($pageCounter = $nextPage; $pageCounter <= $totalPages; $pageCounter ++) {
                    $json = json_decode(file_get_contents('https://swapi.dev/api/people/?page='.$pageCounter), true);
                    $this->insertData($json['results']);
                    $nextPage = $pageCounter + 1;
                }
            }
            $flag = true;
        }
        return $flag;
    }

    public function insertData($importedResult) {
        $swapiCharacter = new SwapiCharacter();  
        $fillable = $swapiCharacter->getFillable();
        $listSwapiChars = [];
        foreach($importedResult  as $results) {
            $keys = array_keys($results);
            $array_diff = array_diff($keys, $fillable);
            $finalArray = array_diff_key($results, array_flip($array_diff));
            $homeWorldName = $this->getName(array_key_exists('homeworld', $results) ? $results['homeworld'] : null);
            $finalArray['homeworld_name'] = $homeWorldName;
            $speciesName = $this->getName(array_key_exists('species', $results) ? $results['species'] : null);
            $finalArray['species_name'] = $speciesName;
            $listSwapiChars [] = $finalArray; 
        }
        SwapiCharacter::insert($listSwapiChars);
        return true;
    }
    
    public function getName($url) {
        $name = 'n/a';
        if(empty($url)) {
            return $name;
        } 
        if(is_array($url)) {
            foreach($url as $urlItem) {   
                $json = json_decode(file_get_contents($urlItem), true);
                if(array_key_exists('name', $json)) {
                    $name = $json['name'];
                }
            }    
        } else {
            $json = json_decode(file_get_contents($url), true);
            if(array_key_exists('name', $json)) {
                $name = $json['name'];
            }
        }       
        return $name;
    }
}
