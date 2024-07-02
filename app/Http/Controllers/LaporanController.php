<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\OrderStok;
use App\Models\Product;
use App\Models\ProductSell;
use App\Models\Setting;
use App\Models\StokKeluar;
use App\Models\StokMasuk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Laporan - Neraca";
        $judul = "Laporan Neraca";
        $setting = Setting::first();

        $modalAwal = 600000;
        $kas = 0;
        $profit = 0;
        $totalEkuitas = 0;

        $tahun = Product::select(DB::raw('YEAR(created_at) as year'))
            ->distinct()
            ->pluck('year')
            ->sort()
            ->toArray();

        $selectedYear = $request->input('tahun', reset($tahun));

        // Ambil data transaksi berdasarkan tahun yang dipilih
        $keluar = StokKeluar::select(
            DB::raw('SUM(harga_jual) as hargaJual'),
            DB::raw('SUM(stok_keluar) as totalKeluar'),
        )->first();

        $credit = Credit::select(DB::raw('SUM(credit) as credit'))->first();

        $total = OrderStok::select(
            DB::raw('SUM(sub_total) as total_harga'),
        )->first();

        $uniqueOngkirs = OrderStok::select('ongkir')->distinct()->get();
        $totalOngkir = 0;
        foreach ($uniqueOngkirs as $ongkir) {
            // Ambil satu data dengan ongkir tertentu
            $order = OrderStok::where('ongkir', $ongkir->ongkir)->first();
            if ($order) {
                $totalOngkir += $order->ongkir;
            }
        }

        $totalModal = $total->total_harga + $totalOngkir + $credit->credit;
        $profit = $keluar->hargaJual - $totalModal;
        $ballance = $modalAwal - $totalModal + $keluar->hargaJual;

        $kas = $keluar->hargaJual;
        $totalEkuitas = $totalModal + $profit;

        if ($tahun != null) {
            $tahun;
        } else {
            $tahun[] = 2024;
        }

        return view('pages.laporan.neraca', compact('setting', 'title', 'judul', 'tahun', 'kas', 'selectedYear', 'totalModal', 'profit', 'totalEkuitas'));
    }

    public function laba_rugi(Request $request)
    {
        $title = "Laporan - Laba Rugi";
        $judul = "Laporan Laba Rugi";
        $setting = Setting::first();

        $modalAwal = 600000;
        $pendapatan = 0;
        $bebanUsaha = 0;
        $labaRugi = 0;


        $tahun = Product::select(DB::raw('YEAR(created_at) as year'))
            ->distinct()
            ->pluck('year')
            ->sort()
            ->toArray();

        $selectedYear = $request->input('tahun', reset($tahun));

        // Ambil data transaksi berdasarkan tahun yang dipilih

        $keluar = StokKeluar::select(
            DB::raw('SUM(harga_jual) as hargaJual'),
            DB::raw('SUM(stok_keluar) as totalKeluar'),
        )->first();

        $total = OrderStok::select(
            DB::raw('SUM(sub_total) as total_harga'),
        )->first();

        $credit = Credit::select(DB::raw('SUM(credit) as credit'))->first();

        $uniqueOngkirs = OrderStok::select('ongkir')->distinct()->get();
        $totalOngkir = 0;
        foreach ($uniqueOngkirs as $ongkir) {
            // Ambil satu data dengan ongkir tertentu
            $order = OrderStok::where('ongkir', $ongkir->ongkir)->first();
            if ($order) {
                $totalOngkir += $order->ongkir;
            }
        }

        $pendapatan = $keluar->hargaJual;
        $bebanUsaha = $total->total_harga + $totalOngkir + $credit->credit;
        $labaRugi = $pendapatan - $bebanUsaha;

        return view('pages.laporan.laba_rugi', compact('setting', 'title', 'judul', 'tahun', 'pendapatan', 'bebanUsaha', 'labaRugi', 'selectedYear'));
    }

    public function per_modal(Request $request)
    {
        $title = "Laporan - Perubahan Modal";
        $judul = "Laporan Perubahan Modal";
        $setting = Setting::first();

        $modalAwal = 600000;
        $labaBersih = 0;

        $tahun = Product::select(DB::raw('YEAR(created_at) as year'))
            ->distinct()
            ->pluck('year')
            ->sort()
            ->toArray();

        $selectedYear = $request->input('tahun', reset($tahun));

        //perubahan Modal
        $keluar = StokKeluar::select(
            DB::raw('SUM(harga_jual) as hargaJual'),
            DB::raw('SUM(stok_keluar) as totalKeluar'),
        )->first();

        $total = OrderStok::select(
            DB::raw('SUM(sub_total) as total_harga'),
        )->first();

        $credit = Credit::select(DB::raw('SUM(credit) as credit'))->first();


        $uniqueOngkirs = OrderStok::select('ongkir')->distinct()->get();
        $totalOngkir = 0;
        foreach ($uniqueOngkirs as $ongkir) {
            // Ambil satu data dengan ongkir tertentu
            $order = OrderStok::where('ongkir', $ongkir->ongkir)->first();
            if ($order) {
                $totalOngkir += $order->ongkir;
            }
        }

        $pendapatan = $keluar->hargaJual;
        $bebanUsaha = $total->total_harga + $totalOngkir + $credit->credit;
        $labaBersih = $pendapatan - $bebanUsaha;

        $modalAkhir = $modalAwal + $labaBersih;

        return view('pages.laporan.perubahan_modal', compact('setting', 'title', 'judul', 'tahun', 'modalAwal', 'labaBersih', 'modalAkhir', 'selectedYear'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
