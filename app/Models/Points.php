<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Expression;

class Points extends Model
{
    use HasFactory;

    protected $table = 'table_point';

    protected $primaryKey = 'id';

    public $incrementing = true;
    protected $keyType = 'integer';

    protected $fillable = [
        'user_name', 'nama', 'alamat', 'jenis', 'harga', 'longitude', 'latitude',
        'foto', 'pemilik', 'telepon',
        'tunai', 'transfer', 'ewallet', 'ac', 'kasur', 'mejakursi',
        'kamarmandi', 'lemari', 'wifi', 'dapur', 'kulkas', 'ruangtamu',
        'parkirmotor', 'parkirmobil', 'cctv', 'keamanan', 'listrik',
        'air', 'jammalam', 'ketjammalam', 'lbangunan', 'ltanah', 'jenissertifikat'
    ];


    public function points()
    {
        return $this->select(
            'id',
            'user_name',
            'nama',
            'alamat',
            'pemilik',
            'telepon',
            'jenis',
            'harga',
            'tunai',
            'transfer',
            'ewallet',
            'lbangunan',
            'ltanah',
            'jenissertifikat',
            'ac',
            'kasur',
            'mejakursi',
            'kamarmandi',
            'lemari',
            'wifi',
            'dapur',
            'kulkas',
            'ruangtamu',
            'parkirmotor',
            'parkirmobil',
            'cctv',
            'keamanan',
            'listrik',
            'air',
            'jammalam',
            'ketjammalam',
            DB::raw("jsonb_build_object(
                'type', 'Point',
                'coordinates', jsonb_build_array(longitude, latitude)
            ) as geom"),
            'foto'
        )->get();
    }

    public function point($id)
    {
        return $this->select(
            'id',
            'user_name',
            'nama',
            'alamat',
            'pemilik',
            'telepon',
            'jenis',
            'harga',
            'tunai',
            'transfer',
            'ewallet',
            'lbangunan',
            'ltanah',
            'jenissertifikat',
            'ac',
            'kasur',
            'mejakursi',
            'kamarmandi',
            'lemari',
            'wifi',
            'dapur',
            'kulkas',
            'ruangtamu',
            'parkirmotor',
            'parkirmobil',
            'cctv',
            'keamanan',
            'listrik',
            'air',
            'jammalam',
            'ketjammalam',
            DB::raw("jsonb_build_object(
                'type', 'Point',
                'coordinates', jsonb_build_array(longitude, latitude)
            ) as geom"),
            'foto'
        )->where('id', $id)->get();
    }

    public function setGeomAttribute($value)
    {
        if ($value instanceof Expression) {
            $this->attributes['geom'] = $value;
            return;
        }

        $coordinates = null;

        if (is_string($value)) {
            try {
                $decoded = json_decode($value, true);
                if (isset($decoded['coordinates'])) {
                    $coordinates = $decoded['coordinates'];
                }
            } catch (\Exception $e) {
            }
        }
        elseif (is_array($value)) {
            if (isset($value['coordinates'])) {
                $coordinates = $value['coordinates'];
            } elseif (count($value) >= 2) {
                $coordinates = array_slice($value, 0, 2);
            }
        }

        if ($coordinates && count($coordinates) >= 2) {
            $longitude = (float)$coordinates[0];
            $latitude = (float)$coordinates[1];

            $this->attributes['longitude'] = $longitude;
            $this->attributes['latitude'] = $latitude;

            $this->attributes['geom'] = DB::raw(
                "ST_SetSRID(ST_MakePoint(?, ?), 4326)",
                [$longitude, $latitude]
            );
        } else {
            throw new \InvalidArgumentException('Invalid geometry data format');
        }
    }

    public static function priceDistribution()
    {
        return self::select(
            DB::raw("CASE
                WHEN harga < 500000 THEN '< 500k'
                WHEN harga BETWEEN 500000 AND 999999 THEN '500k-1jt'
                WHEN harga BETWEEN 1000000 AND 1499999 THEN '1jt-1.5jt'
                WHEN harga BETWEEN 1500000 AND 1999999 THEN '1.5jt-2jt'
                ELSE '> 2jt'
            END as price_range"),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('price_range')
        ->get();
    }

    public static function distanceDistribution($campusLat, $campusLng)
    {
        // Ambil semua data terlebih dahulu
        $allKos = self::select('id', 'latitude', 'longitude')->get();

        $ranges = [
            '0-1 km' => 0,
            '1-3 km' => 0,
            '3-5 km' => 0,
            '> 5 km' => 0
        ];

        foreach ($allKos as $kos) {
            $distance = self::calculateHaversine(
                $campusLat, $campusLng,
                $kos->latitude, $kos->longitude
            );

            if ($distance < 1000) {
                $ranges['0-1 km']++;
            } elseif ($distance < 3000) {
                $ranges['1-3 km']++;
            } elseif ($distance < 5000) {
                $ranges['3-5 km']++;
            } else {
                $ranges['> 5 km']++;
            }
        }

        return $ranges;
    }

    private static function calculateHaversine($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // Radius bumi dalam meter

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat/2) * sin($dLat/2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon/2) * sin($dLon/2);

        $c = 2 * asin(sqrt($a));

        return $earthRadius * $c;
    }

    public static function facilityDistribution()
    {
        $facilities = [
            'ac', 'kasur', 'mejakursi', 'kamarmandi', 'lemari',
            'wifi', 'dapur', 'parkirmotor',
            'parkirmobil', 'cctv'
        ];

        $results = [];

        foreach ($facilities as $facility) {
            $results[$facility] = self::where($facility, true)->count();
        }

        // Urutkan dari fasilitas paling banyak ke paling sedikit
        arsort($results);

        return [
            'labels' => array_keys($results),
            'data' => array_values($results)
        ];
    }
}
