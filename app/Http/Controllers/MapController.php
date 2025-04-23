<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $data = [
            "title" => "Kost Finder"
        ];

        return view('page', $data);
    }

    public function map()
    {
        $data = [
            "title" => "Kost Finder",
        ];
            return view('index-public', $data);
        }

    public function addMap()
    {
        $data = [
            "title" => "Kost Finder",
        ];
            return view('index', $data);

    }

    public function table()
    {
        $data = [
            "title" => "Table"
        ];

        return view('table', $data);
    }

    public function keunggulan()
    {
        $data = [
            "title" => "Kos Finder"
        ];

        return view('keunggulan', $data);
    }

    public function fitur()
    {
        $data = [
            "title" => "Kos Finder"
        ];

        return view('fitur', $data);
    }

    public function infografis()
    {
        $data = [
            "title" => "Kos Finder"
        ];

        return view('infografis', $data);
    }
}
