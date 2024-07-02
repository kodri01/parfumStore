<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Setting;
use Illuminate\Http\Request;

class CategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Categori";
        $judul = "Kategori Produk";
        $setting = Setting::first();

        $categories = Categorie::orderBy('created_at', 'asc')->get();
        return view('pages.categori.index', compact('setting', 'title', 'judul', 'categories'));
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
        Categorie::create([
            'name' => $request->name,

        ]);

        return redirect()->route('categori')
            ->with('success', 'Categori Berhasil ditambahkan');
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
        $product = Categorie::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $categori = Categorie::findOrFail($request->id);
        $categori->name = $request->name;
        $categori->save();

        return redirect()->back()->with('success', 'Kategori Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Categorie::find($id)->delete();
        return redirect()->back()->with('error', 'Data Berhasil dihapus');
    }
}