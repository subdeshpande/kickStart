<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\SwapiCharacter as SwapiCharacter;
use App\UpdateCharacterData as UpdateCharacterData;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Request;
class create_character extends Controller
{
    public function create()
    {
        DB::beginTransaction();
        try {
            $formValidator = Validator::make(Request::all(), [
                    'name' => 'required|unique:swapi_characters|max:255',
                    'height' => 'required|regex:/^[a-zA-Z0-9_\-]*$/',
                    'mass' => 'required',
                    'birth_year' => 'regex:/^[a-zA-Z0-9_\-]*$/',
                    'gender' => 'required|in:male,female'
                ]);
            if ($formValidator->fails()) {
                $messages = $formValidator->errors()->all();
                return view('create_character', ['error' => $messages]); 
            }
            $characterData = Request::all();
            $swapiCharacter = SwapiCharacter::create($characterData);
            DB::commit();
            return view('create_character', ['success' => 'Character successfully added']);
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

    public function show()
    {
        return view('create_character');
    }
}
