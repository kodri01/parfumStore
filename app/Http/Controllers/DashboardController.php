<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\OrderStok;
use App\Models\Product;
use App\Models\ProductSell;
use App\Models\Resep;
use App\Models\Setting;
use App\Models\StokKeluar;
use App\Models\StokMasuk;
use App\Models\Supplier;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Dashboard";

        $setting = Setting::first();

        $modelrole = DB::table('model_has_roles')->where('model_id', auth()->user()->id)->first();
        $role = Role::where('id', $modelrole->role_id)->first();

        $modalAwal = 600000;

        $produk = Product::with(['stokMasuk', 'stokKeluar'])->get();
        $totalHargaStokKeluar = 0;
        // Menghitung total harga stok keluar
        foreach ($produk as $produk) {
            $totalHargaStokKeluar += $produk->getTotalHargaStokKeluar();
        }

        // dd($totalHargaStokKeluar);
        $credit = Credit::select(DB::raw('SUM(credit) as credit'))->first();
        $totalBaku = Product::select(DB::raw('COUNT(id) as totalBaku'))->first();
        $masuk = StokMasuk::select(DB::raw(
            'SUM(stok_masuk) as totalMasuk',
        ))->first();
        $keluar = StokKeluar::select(
            DB::raw('SUM(harga_jual) as hargaJual'),
            DB::raw('SUM(stok_keluar) as totalKeluar'),
        )->first();

        $sisaParfum = $masuk->totalMasuk - $keluar->totalKeluar;

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

        $totalHarga = $total->total_harga + $totalOngkir + $credit->credit;
        $profit = $keluar->hargaJual - $totalHarga;
        $ballance = $modalAwal - $totalHarga + $keluar->hargaJual;


        //parfum terlaris
        $produkLaris = StokKeluar::select('produk_id', DB::raw('SUM(stok_keluar) as total_stok'))
            ->groupBy('produk_id')
            ->orderBy('total_stok', 'desc')
            ->paginate(5);

        // dd($produkLaris);

        $ongkir = OrderStok::value('ongkir');
        $stoks = Product::with(['stokMasuk', 'stokKeluar'])->get();
        $produkStoks = [];
        foreach ($stoks as $stok) {
            $totalStokMasuk = $stok->stokMasuk->sum('stok_masuk');
            $totalStokKeluar = $stok->stokKeluar->sum('stok_keluar');
            $stokAkhir = $totalStokMasuk - $totalStokKeluar;
            $produkStoks[] = [
                'nama_produk' => $stok->nama_barang,
                'stok_akhir' => $stokAkhir,
            ];
        }

        usort($produkStoks, function ($a, $b) {
            return $b['stok_akhir'] <=> $a['stok_akhir'];
        });
        $produkStoks = array_slice($produkStoks, 0, 5);

        $stok_masuk = StokMasuk::with('produk')->orderBy('created_at', 'desc')->paginate(5);
        $stok_keluar = StokKeluar::with('produk')->orderBy('created_at', 'desc')->paginate(5);

        if ($role->name == 'administrator') {
            return view('pages.dashboard.index', compact('setting', 'title', 'stok_masuk', 'sisaParfum', 'ballance', 'masuk', 'profit', 'produkLaris', 'keluar', 'stok_keluar', 'totalBaku', 'totalHarga'), ['produkStoks' => $produkStoks]);
        } else {
            return view('pages.dashboard.produksi', compact('setting', 'title', 'stokpro', 'resep', 'totalProduk'));
        }
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
