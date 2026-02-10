<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pengunjung;
use App\Models\Kunjungan;
use Carbon\Carbon;

class PengunjungController extends Controller
{
    public function index()
    {
        return view('user.guestbook');
    }

    public function checkPhone(Request $request)
    {
        $pengunjung = Pengunjung::where('no_hp', $request->no_hp)->first();
        if ($pengunjung) {
            return response()->json([
                'exists' => true,
                'nama' => $pengunjung->nama,
                'asal_institusi' => $pengunjung->asal_institusi
            ]);
        }
        return response()->json(['exists' => false]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_hp' => 'required',
            'nama' => 'required',
            'asal_institusi' => 'required',
            'keperluan' => 'required',
        ]);

        $pengunjung = Pengunjung::updateOrCreate(
            ['no_hp' => $request->no_hp],
            [
                'nama' => $request->nama,
                'asal_institusi' => $request->asal_institusi,
                'tanggal_jam_masuk' => now(),
                'keperluan' => $request->keperluan
            ]
        );

        // Create Kunjungan
        $kunjungan = Kunjungan::create([
            'id_pengunjung' => $pengunjung->id_pengunjung,
            'keperluan' => $request->keperluan,
            'tanggal_jam_masuk' => now(),
            'status' => 'IN'
        ]);

        // Smart Priority Detection
        $urgentKeywords = ['urgent', 'mendesak', 'bahaya', 'komplain', 'darurat'];
        $vipKeywords = ['vip', 'penting', 'direktur', 'pimpinan'];
        
        $urgencyLevel = null;
        $alertMessage = "";

        // Check for Dangerous/Urgent keywords
        foreach ($urgentKeywords as $word) {
            if (stripos($request->keperluan, $word) !== false) {
                $urgencyLevel = 'danger';
                $alertMessage = "Ada tamu dengan keperluan mendesak/masalah";
                break;
            }
        }

        // Check for VIP keywords if not already dangerous
        if (!$urgencyLevel) {
            foreach ($vipKeywords as $word) {
                if (stripos($request->keperluan, $word) !== false) {
                    $urgencyLevel = 'priority';
                    $alertMessage = "Ada tamu penting/atasan berkunjung";
                    break;
                }
            }
        }

        if ($urgencyLevel) {
            \App\Models\PriorityNotification::create([
                'id_kunjungan' => $kunjungan->id_kunjungan,
                'message' => $alertMessage,
                'urgency_level' => $urgencyLevel,
                'is_read' => false
            ]);
        }

        return redirect()->back()->with('success', 'Selamat datang ' . $pengunjung->nama . '!');
    }

    public function checkout(Request $request)
    {
        $kunjungan = Kunjungan::where('status', 'IN')
            ->whereHas('pengunjung', function($q) use ($request) {
                $q->where('no_hp', $request->no_hp);
            })->first();

        if ($kunjungan) {
            $masuk = Carbon::parse($kunjungan->tanggal_jam_masuk);
            $keluar = now();
            $durasi = $masuk->diffInMinutes($keluar);

            $kunjungan->update([
                'tanggal_jam_keluar' => $keluar,
                'durasi_kunjungan' => $durasi,
                'status' => 'OUT'
            ]);

            // Also update last checkout in pengunjung table
            $kunjungan->pengunjung->update([
                'tanggal_jam_keluar' => $keluar
            ]);

            return redirect()->back()->with('success', 'Terima kasih atas kunjungannya!');
        }

        return redirect()->back()->with('error', 'Data kunjungan tidak ditemukan.');
    }
}
