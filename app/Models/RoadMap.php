<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WisdomDiala\Countrypkg\Models\State;

class RoadMap extends Model
{
    use HasFactory;
    protected $table = 'road_maps';
    protected $fillable = ['name', 'description', 'description', 'state_id'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
