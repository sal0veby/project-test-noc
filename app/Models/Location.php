<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use CrudTrait;

    protected $table = 'locations';
    protected $fillable = ['name', 'classes_id' , 'active'];

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'classes_id');
    }
}
