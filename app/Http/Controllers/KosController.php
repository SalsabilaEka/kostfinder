<?php

namespace App\Http\Controllers;

use App\Models\Points;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     */
    // app/Http/Controllers/PointController.php
    public function show($id)
    {
        $kos = Points::findOrFail($id);

        $fasilitas = [];
        if ($kos->ac) $fasilitas[] = ['icon' => 'fa-snowflake', 'label' => 'AC'];
        if ($kos->kasur) $fasilitas[] = ['icon' => 'fa-bed', 'label' => 'Kasur'];
        if ($kos->mejakursi) $fasilitas[] = ['icon' => 'fa-chair', 'label' => 'Meja & Kursi'];
        if ($kos->kamarmandi) $fasilitas[] = ['icon' => 'fa-bath', 'label' => 'Kamar Mandi'];
        if ($kos->lemari) $fasilitas[] = ['icon' => 'fa-archive', 'label' => 'Lemari'];
        if ($kos->wifi) $fasilitas[] = ['icon' => 'fa-wifi', 'label' => 'WiFi'];
        if ($kos->dapur) $fasilitas[] = ['icon' => 'fa-utensils', 'label' => 'Dapur'];
        if ($kos->kulkas) $fasilitas[] = ['icon' => 'fa-dice-d6', 'label' => 'Kulkas'];
        if ($kos->ruangtamu) $fasilitas[] = ['icon' => 'fa-couch', 'label' => 'Ruang Tamu'];
        if ($kos->parkirmotor) $fasilitas[] = ['icon' => 'fa-motorcycle', 'label' => 'Parkir Motor'];
        if ($kos->parkirmobil) $fasilitas[] = ['icon' => 'fa-car', 'label' => 'Parkir Mobil'];
        if ($kos->cctv) $fasilitas[] = ['icon' => 'fa-video', 'label' => 'CCTV'];
        if ($kos->keamanan) $fasilitas[] = ['icon' => 'fa-shield-alt', 'label' => 'Keamanan'];
        if ($kos->listrik) $fasilitas[] = ['icon' => 'fa-bolt', 'label' => 'Listrik'];
        if ($kos->air) $fasilitas[] = ['icon' => 'fa-tint', 'label' => 'Air'];

        $pembayaran = [];
        if ($kos->tunai) $pembayaran[] = 'Tunai';
        if ($kos->transfer) $pembayaran[] = 'Transfer';
        if ($kos->ewallet) $pembayaran[] = 'E-Wallet';

        return view('detail', compact('kos', 'fasilitas', 'pembayaran'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {

    }

    public function table()
    {

    }
}
