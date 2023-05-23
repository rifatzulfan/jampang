<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public $sources = [
        [
            'model'      => Jadwal::class,
            'date_field' => 'tanggal',
            'field'      => 'peminjaman_id',
            'mulai'      => 'jammulai',
            'selesai'      => 'jamselesai',
            'prefix'     => '',
            'suffix'     => '',
        ],
    ];

    public function index(Request $request)
    {
        $peminjamans = [];

        foreach ($this->sources as $source) {
            $models = $source['model']::whereHas('peminjaman', function ($query) {
                $query->where('status', 'diterima');
            })->get();
            foreach ($models as $model) {
                $tanggal = $model->getOriginal($source['date_field']);
                $mulai = $model->getOriginal($source['mulai']);
                $selesai = $model->getOriginal($source['selesai']);
                $name = Peminjaman::findOrFail($model->getOriginal($source['field']));

                if (!$tanggal) {
                    continue;
                }
                $peminjamans[] = [
                    'title' => $name->name,
                    'start' => $tanggal,
                    'additionalInfo' => $mulai . '-' . $selesai,
                ];
            }
        }
        $jsonEvents = json_encode($peminjamans);
        // dd($jsonEvents);
        return view('welcome', compact('jsonEvents'));
    }
}
