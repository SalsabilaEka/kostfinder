<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pointshalte extends Model
{
    use HasFactory;

    protected $table = 'table_halte';

    protected $guarded = ['id'];

    public function points()
    {
        return $this->select(
            'id',
            'nama',
            DB::raw("jsonb_build_object(
                'type', 'Point',
                'coordinates', jsonb_build_array(x, y)
            ) as geom")
        )->get();
    }

    public function point($id)
    {
        return $this->select(DB::raw('id, name, description, ST_AsGeoJSON(geom) as geom, created_at, updated_at, image'))->where('id', $id)->get();
    }
}
