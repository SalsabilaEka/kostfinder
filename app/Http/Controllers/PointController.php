<?php

namespace App\Http\Controllers;

use App\Models\Points;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PointController extends Controller
{
    public function __construct()
    {
        $this->point = new Points();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $points = $this->point->points();
        $feature = [];

        foreach ($points as $p) {
            $feature[] = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'nama' => $p->nama,
                    'user_name' => $p->user_name,
                    'alamat' => $p->alamat,
                    'jenis'=> $p->jenis,
                    'harga'=> $p->harga,
                    'foto' => $p->foto,
                    'pemilik' => $p->pemilik,
                    'telepon' => $p->telepon,
                    'tunai' => $p->tunai,
                    'transfer' => $p->transfer,
                    'ewallet' => $p->ewallet,
                    'lbangunan' => $p->lbangunan,
                    'ltanah' => $p->ltanah,
                    'jenissertifikat' => $p->jenissertifikat,
                    'ac' => $p->ac,
                    'kasur' => $p->kasur,
                    'mejakursi' => $p->mejakursi,
                    'kamarmandi' => $p->kamarmandi,
                    'lemari' => $p->lemari,
                    'wifi' => $p->wifi,
                    'dapur' => $p->dapur,
                    'kulkas' => $p->kulkas,
                    'ruangtamu' => $p->ruangtamu,
                    'parkirmotor' => $p->parkirmotor,
                    'parkirmobil' => $p->parkirmobil,
                    'cctv' => $p->cctv,
                    'keamanan' => $p->keamanan,
                    'listrik' => $p->listrik,
                    'air' => $p->air,
                    'jammalam' => $p->jammalam,
                    'ketjammalam' => $p->ketjammalam,
                ]
            ];
        }

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $feature,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $point = Points::findOrFail($id);

            if (auth()->user()->email !== 'adminkostfinder@gmail.com' &&
            $point->user_name !== auth()->user()->email) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $point->id,
                    'nama' => $point->nama,
                    'alamat' => $point->alamat,
                    'pemilik' => $point->pemilik,
                    'telepon' => $point->telepon,
                    'jenis' => $point->jenis,
                    'harga' => $point->harga,
                    'foto' => $point->foto,
                    'lbangunan' => $point->lbangunan,
                    'ltanah' => $point->ltanah,
                    'jenissertifikat' => $point->jenissertifikat,
                    'tunai' => $point->tunai,
                    'transfer' => $point->transfer,
                    'ewallet' => $point->ewallet,
                    'ac' => $point->ac,
                    'kasur' => $point->kasur,
                    'mejakursi' => $point->mejakursi,
                    'kamarmandi' => $point->kamarmandi,
                    'lemari' => $point->lemari,
                    'wifi' => $point->wifi,
                    'dapur' => $point->dapur,
                    'kulkas' => $point->kulkas,
                    'ruangtamu' => $point->ruangtamu,
                    'parkirmotor' => $point->parkirmotor,
                    'parkirmobil' => $point->parkirmobil,
                    'cctv' => $point->cctv,
                    'keamanan' => $point->keamanan,
                    'listrik' => $point->listrik,
                    'air' => $point->air,
                    'jammalam' => $point->jammalam,
                    'ketjammalam' => $point->ketjammalam,
                    'user_name' => $point->user_name,
                    'longitude' => $point->longitude,
                    'latitude' => $point->latitude
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $point = $this->point->find($id);

        if (auth()->user()->email !== 'adminkostfinder@gmail.com' &&
            $point->user_name !== auth()->user()->email) {
            abort(403, 'Unauthorized action.');
        }

        $data = [
            'title' => 'Edit Point',
            'point' => $point,
            'id' => $id
        ];

        return view('edit-point', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $point = Points::findOrFail($id);

        if (auth()->user()->email !== 'adminkostfinder@gmail.com' &&
        auth()->user()->email !== $point->user_name) {
        return response()->json([
            'success' => false,
            'message' => 'Anda tidak memiliki izin untuk mengubah data ini'
        ], 403);
    }

        $data = $request->all();
        $checkboxes = [
            'tunai', 'transfer', 'ewallet', 'ac', 'kasur', 'mejakursi',
            'kamarmandi', 'lemari', 'wifi', 'dapur', 'kulkas', 'ruangtamu',
            'parkirmotor', 'parkirmobil', 'cctv', 'keamanan'
        ];

        foreach ($checkboxes as $checkbox) {
            $data[$checkbox] = $request->input($checkbox, 0) == '1' ? 1 : 0;
        }

        $data['listrik'] = $request->input('listrik', '0') == '1' ? 'Ada' : 'Tidak';
        $data['air'] = $request->input('air', '0') == '1' ? 'Ada' : 'Tidak';

        $point->update($data);

        return response()->json([
            'success' => true,
            'data' => $point
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $point = Points::findOrFail($id);

        if (auth()->user()->email !== 'adminkostfinder@gmail.com' &&
            $point->user_name !== auth()->user()->email) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action'
            ], 403);
        }

        $point->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully'
        ]);
    }

    public function table(Request $request)
    {
        $query = $this->point->query();

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $points = $query->get();

        return view('table-point', [
            'title' => 'Table Point',
            'points' => $points,
            'searchTerm' => $request->input('search', '')
        ]);
    }

    public function storeGeoJSON(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'geom' => 'required',
            'jenis' => 'required',
            'harga' => 'required|integer|min:0',
        ]);

        try {
            $geom = json_decode($request->geom);

            if (!$geom || !isset($geom->coordinates)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid geometry format'
                ], 400);
            }

            $point = new Points();
            $point->user_name = auth()->user()->email;
            $point->nama = $request->nama;
            $point->alamat = $request->alamat;
            $point->jenis = $request->jenis;
            $point->harga = $request->harga;
            $point->longitude = $geom->coordinates[0];
            $point->latitude = $geom->coordinates[1];
            $point->geom = DB::raw("ST_GeomFromGeoJSON('" . $request->geom . "')");
            $point->foto = $request->foto ?: null;
            $point->pemilik = $request->pemilik ?? null;
            $point->telepon = $request->telepon ?? null;
            $point->tunai = $request->tunai ?? false;
            $point->transfer = $request->transfer ?? false;
            $point->ewallet = $request->ewallet ?? false;
            $point->lbangunan = $request->lbangunan ?? null;
            $point->ltanah = $request->ltanah ?? null;
            $point->jenissertifikat = $request->jenissertifikat ?? null;
            $point->ac = $request->ac ?? false;
            $point->kasur = $request->kasur ?? false;
            $point->mejakursi = $request->mejakursi ?? false;
            $point->kamarmandi = $request->kamarmandi ?? false;
            $point->lemari = $request->lemari ?? false;
            $point->wifi = $request->wifi ?? false;
            $point->dapur = $request->dapur ?? false;
            $point->kulkas = $request->kulkas ?? false;
            $point->ruangtamu = $request->ruangtamu ?? false;
            $point->parkirmotor = $request->parkirmotor ?? false;
            $point->parkirmobil = $request->parkirmobil ?? false;
            $point->cctv = $request->cctv ?? false;
            $point->keamanan = $request->keamanan ?? false;
            $point->listrik = $request->listrik ?? 'Tidak';
            $point->air = $request->air ?? 'Tidak';
            $point->jammalam = $request->jammalam ?? 'Tidak';
            $point->ketjammalam = $request->ketjammalam ?? '-';

            $point->save();

            return response()->json([
                'success' => true,
                'data' => $point,
                'message' => 'Point created successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getPriceChartData()
    {
        $priceData = Points::priceDistribution();

        $labels = ['< 500k', '500k-1jt', '1jt-1.5jt', '1.5jt-2jt', '> 2jt'];
        $data = array_fill_keys($labels, 0);

        foreach ($priceData as $item) {
            if (array_key_exists($item->price_range, $data)) {
                $data[$item->price_range] = $item->total;
            }
        }

        return response()->json([
            'labels' => $labels,
            'data' => array_values($data)
        ]);
    }


    public function getDistanceChartData(Request $request)
    {
        $campusLat = -7.771016684834958;
        $campusLng = 110.3790727779467;

        $distribution = Points::distanceDistribution($campusLat, $campusLng);

        return response()->json([
            'labels' => array_keys($distribution),
            'data' => array_values($distribution)
        ]);
    }

    public function getFacilityChartData()
    {
        $data = Points::facilityDistribution();

        return response()->json([
            'labels' => $data['labels'],
            'data' => $data['data'],
        ]);
    }
}
