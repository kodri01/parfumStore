<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Setting;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Pengeluaran";
        $judul = "Pengeluaran";
        $setting = Setting::first();

        $credits = Credit::orderBy('created_at', 'asc')->get();
        return view('pages.credit.index', compact('setting', 'title', 'judul', 'credits'));
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
        Credit::create([
            'credit' => $request->credit,
            'keterangan' => $request->ket,

        ]);

        return redirect()->route('credit')
            ->with('success', 'Pengeluaran Berhasil ditambahkan');
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
    public function edit($id)
    {
        $product = Credit::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $categori = Credit::findOrFail($request->id);
        $categori->credit = $request->credit;
        $categori->keterangan = $request->ket;
        $categori->save();

        return redirect()->back()->with('success', 'Pengeluaran Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Credit::find($id)->delete();
        return redirect()->back()->with('error', 'Data Berhasil dihapus');
    }
}
