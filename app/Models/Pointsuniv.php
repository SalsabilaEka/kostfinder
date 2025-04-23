<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pointsuniv extends Model
{
    use HasFactory;

    protected $table = 'fakultas';

    public function points()
    {
        return $this->select(
            'universitas',
            'fakultas',
            DB::raw("jsonb_build_object(
                'type', 'Point',
                'coordinates', jsonb_build_array(longitude, latitude)
            ) as geom")
        )->get();
    }
}
