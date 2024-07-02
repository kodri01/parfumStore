<?php

namespace App\Http\Controllers;

use App\Models\OrderStok;
use App\Models\Product;
use App\Models\Setting;
use App\Models\StokMasuk;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Parfum - Purchase Order";
        $judul = "Purchase Order (PO) Parfum";
        $setting = Setting::first();

        $subQuery = OrderStok::select('no_order', DB::raw('MAX(created_at) as latest_created_at'))
            ->groupBy('no_order');

        $orders = OrderStok::with('produk')
            ->joinSub($subQuery, 'latest_orders', function ($join) {
                $join->on('order_stoks.no_order', '=', 'latest_orders.no_order');
            })
            ->orderBy('latest_orders.latest_created_at', 'desc')
            ->select(
                'order_stoks.no_order',
                'latest_orders.latest_created_at as tgl_order',
                DB::raw('COUNT(order_stoks.no_order) as jml_produk'),
                DB::raw('SUM(order_stoks.qty) as qty')
            )
            ->groupBy('order_stoks.no_order', 'latest_orders.latest_created_at')
            ->get();


        $getBarangs = Product::with('stokMasuk', 'stokKeluar')->get();
        $produks = $getBarangs->unique('nama_barang');

        return view('pages.product.order', compact('setting', 'title', 'judul', 'orders', 'produks'));
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

        $date = Carbon::now()->format('dmY');
        $nama_barang = $request->nama_barang;
        $satuan = $request->satuan;
        $ongkir = $request->ongkir;
        $qty = $request->qty;
        $no_order = "PO" . rand(100, 999) . $date;
        $harga = $request->harga;

        for ($i = 0; $i < count($nama_barang); $i++) {
            $sub_total = $qty[$i] * $harga[$i];
            OrderStok::create([
                'no_order' => $no_order,
                'produk_id' => $nama_barang[$i],
                'satuan' => $satuan[$i],
                'qty' => $qty[$i],
                'harga' => $harga[$i],
                'sub_total' => $sub_total,
                'ongkir' => $ongkir,
            ]);

            StokMasuk::create([
                'produk_id' => $nama_barang[$i],
                'stok_masuk' => $qty[$i],
                'keterangan' => 'Stok Masuk Dengan Nomor Order: ' . $no_order,
            ]);
        }

        return redirect()->route('product.order')
            ->with('success', 'PO Barang Berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $no)
    {

        $title = "Parfum - Details Order";
        $judul = "Details PO Parfum";
        $setting = Setting::first();

        $total = OrderStok::select(
            DB::raw('SUM(qty) as qty'),
            DB::raw('SUM(harga) as harga'),
            DB::raw('SUM(sub_total) as total_harga'),
        )->where('no_order', $no)->first();
        $ong = OrderStok::where('no_order', $no)->select('ongkir')->first();
        $ongkir = OrderStok::where('no_order', $no)->value('ongkir');
        $totalHarga = $total->total_harga + $ong->ongkir;
        $orders = OrderStok::where('no_order', '=', $no)->get();
        $order = OrderStok::where('no_order', '=', $no)->first();
        return view('pages.product.order_details', compact('setting', 'title', 'judul', 'order', 'orders', 'total', 'ongkir', 'totalHarga'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($no)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $no)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $no_order)
    {
        OrderStok::where('no_order', $no_order)->delete();
        return redirect()->back()->with('error', 'Data Order Berhasil dihapus');
    }
}