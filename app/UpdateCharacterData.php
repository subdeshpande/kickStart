<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpdateCharacterData extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'update_characters_data';
    protected $fillable = [
        'name','height','mass','hair_color','birth_year','gender','homeworld_name','species_name'
    ];
}
