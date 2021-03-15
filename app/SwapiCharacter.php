<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SwapiCharacter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'swapi_characters';
    protected $fillable = [
        'name','height','mass','hair_color','birth_year','gender','homeworld_name','species_name'
    ];
}
