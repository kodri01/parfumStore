@extends('layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-info text-uppercase mb-1">
                                Ballance </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ 'Rp ' . number_format($ballance, 0, ',', '.') }}

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-info"></i><i
                                class="fas fa-dollar-sign fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-success text-uppercase mb-1">
                                Profit </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ 'Rp ' . number_format($profit, 0, ',', '.') }}

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-danger text-uppercase mb-1">
                                Credit</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ 'Rp ' . number_format($totalHarga, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-arrow-up fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                                Debit </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ 'Rp ' . number_format($keluar->hargaJual, 0, ',', '.') }}

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-arrow-down fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-warning text-uppercase mb-1">
                                Variant Parfum</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $totalBaku->totalBaku }} Pcs</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                                Total Parfum </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $masuk->totalMasuk }} Pcs
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-info text-uppercase mb-1">
                                Parfum Terjual </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $keluar->totalKeluar }} Pcs

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-success text-uppercase mb-1">
                                Sisa Parfum </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $sisaParfum }} Pcs
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-basket fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="card border-left-warning border-bottom-warning shadow mb-3 ">
                <div class="card-header">
                    <h5 class="mb-2 font-weight-bold text-warning">Informasi Stok Parfum</h5>
                </div>
                <table class="table table-hover">
                    <thead>
                        <th>Nama Parfum</th>
                        <th>Sisa Stok</th>
                    </thead>
                    @foreach ($produkStoks as $stok)
                        <tr>
                            <td>{{ $stok['nama_produk'] }}</td>
                            <td>
                                {{ $stok['stok_akhir'] }}
                            </td>
                        </tr>
                    @endforeach
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-center"><a href="{{ route('product') }}" class=""> >> Liat
                                    Semua Stok</a></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="card border-left-success border-bottom-success shadow mb-3">
                <div class="card-header">
                    <h5 class="mb-2 font-weight-bold text-success">Parfum Terlaris</h5>
                </div>
                <table class="table table-hover">
                    <thead>
                        <th>Nama Parfum</th>
                        <th>Kategori</th>
                        <th>Terjual</th>
                    </thead>
                    @foreach ($produkLaris as $laris)
                        <tr>

                            <td>{{ $laris->produk->nama_barang }}</td>
                            <td>
                                @if ($laris->produk->kategori_id == 1)
                                    <span class="badge badge-info">PREMIUM</span>
                                @else
                                    <span class="badge badge-primary">REGULER</span>
                                @endif
                            </td>
                            <td>{{ $laris->total_stok }}</td>
                        </tr>
                    @endforeach

                    <tfoot>
                        {{-- <div class=""></div> --}}
                        <tr>
                            {{-- <td></td> --}}
                            <td colspan="4" class="text-center"><a href="" class=""> >> Liat
                                    Parfum Terlaris</a></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="card shadow border-left-primary border-bottom-primary mb-3">
                <div class="card-header">
                    <h5 class="mb-2 font-weight-bold text-primary">Parfum Masuk</h5>
                </div>
                <table class="table table-hover">
                    <thead>
                        <th>#</th>
                        <th>Nama Parfum</th>
                        <th>Qty</th>
                        <th>Datetime</th>
                    </thead>
                    @foreach ($stok_masuk as $masuk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $masuk->produk->nama_barang }}</td>
                            <td>{{ $masuk->stok_masuk }}</td>
                            <td>{{ $masuk->created_at }}</td>
                        </tr>
                    @endforeach
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-center"><a href="{{ route('product.masuk') }}"
                                    class="">
                                    >> Liat Semua
                                    Stok Parfum Masuk</a></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="card border-left-danger border-bottom-danger shadow mb-3">
                <div class="card-header">
                    <h5 class="mb-2 font-weight-bold text-danger">Parfum Keluar</h5>
                </div>
                <table class="table table-hover">
                    <thead>
                        <th>#</th>
                        <th>Nama Parfum</th>
                        <th>Qty</th>
                        <th>Keterangan</th>
                        <th>Datetime</th>
                    </thead>
                    @foreach ($stok_keluar as $keluar)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $keluar->produk->nama_barang }}</td>
                            <td>{{ $keluar->stok_keluar }}</td>
                            <td>{{ $keluar->keterangan }}</td>
                            <td>{{ $keluar->created_at }}</td>
                        </tr>
                    @endforeach
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-center"><a href="{{ route('product.keluar') }}"
                                    class="">
                                    >> Liat Semua
                                    Stok Parfum Keluar</a></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
