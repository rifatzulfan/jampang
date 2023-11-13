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
            'date_field' => 'tanggalmulai',
            'date_field_to' => 'tanggalselesai',
            'field'      => 'peminjaman_id',
            'prefix'     => '',
            'suffix'     => '',
        ],
    ];

    public function index()
    {
        $peminjamans = [];

        foreach ($this->sources as $source) {
            $models = $source['model']::whereHas('peminjaman', function ($query) {
                $query->whereHas('checkouts', function ($checkoutQuery) {
                    $checkoutQuery->where('payment_status', 'paid');
                });
            })->get();
            foreach ($models as $model) {
                $tanggalmulai = $model->getOriginal($source['date_field']);
                $tanggalselesai = $model->getOriginal($source['date_field_to']);
                $name = Peminjaman::findOrFail($model->getOriginal($source['field']));

                if (!$tanggalmulai) {
                    continue;
                }
                if ($tanggalmulai != $tanggalselesai) {
                    // Add 12 hours to the end date
                    $tanggalselesai = date('Y-m-d H:i:s', strtotime($tanggalselesai . ' +12 hours'));
                }
                $peminjamans[] = [
                    'title' => $name->name,
                    'start' => $tanggalmulai,
                    'end' => $tanggalselesai,
                ];
            }
        }
        $jsonEvents = json_encode($peminjamans);

        return view('welcome', compact('jsonEvents'));
    }
}
