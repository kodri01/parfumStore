@extends('layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $judul }}</h1>
    </div>
    <div class="card shadow ">
        <div class="card-header">
            <h6 class="mb-2 font-weight-bold"><a href="#" data-toggle="modal" data-target="#stokModal"
                    class="btn btn-primary ">+ Pengeluaran</a></h6>
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
        </div>
    </div>

    <div class="wrapper-table bg-white rounded ">
        <div class="card-body" id="tableStok">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pengeluaran (Rp)</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Jumlah Pengeluaran</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($credits as $credit)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ 'Rp ' . number_format($credit->credit, 0, ',', '.') }}

                                </td>
                                <td>{{ $credit->keterangan }}</td>
                                <td><a href="#" data-toggle="modal" data-target="#produkModalEdit"
                                        class="btn btn-primary btn-circle btn-sm" data-id="{{ $credit->id }}">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('delete.credit', $credit->id) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-sm btn-circle btn-danger"
                                            onclick="return confirm('Anda Yakin Akan Menghapus Data Ini ?')" type="submit">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="stokModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengeluaran</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('add.credit') }}" method="post">
                            <div class="modal-body">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control @error('credit') is-invalid @enderror"
                                                id="floatingInput" placeholder="Nama Barang" name="credit">
                                            <label for="floatingInput">Nilai Pengeluaran</label>
                                        </div>
                                        @error('credit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control @error('ket') is-invalid @enderror"
                                                id="floatingInput" placeholder="Nama Barang" name="ket">
                                            <label for="floatingInput">Keterangan</label>
                                        </div>
                                        @error('ket')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-warning" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="produkModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="editprodukForm" action="{{ route('update.credit') }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editProdukId">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Pengeluaran </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control @error('credit') is-invalid @enderror"
                                            id="editProdukBarang" placeholder="Invoice" name="credit">
                                        <label for="editProdukBarang">Nama Kategori</label>
                                    </div>
                                    @error('credit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('ket') is-invalid @enderror"
                                            id="editKeterangan" placeholder="Invoice" name="ket">
                                        <label for="editKeterangan">Nama Kategori</label>
                                    </div>
                                    @error('ket')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-warning" type="button" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $('#produkModalEdit').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget); // Button that triggered the modal
                    var produkId = button.data('id'); // Extract info from data-* attributes

                    // AJAX request to get the user data
                    $.ajax({
                        url: '/credit/' + produkId + '/edit',
                        method: 'GET',
                        success: function(data) {
                            $('#editProdukId').val(data.id);
                            $('#editProdukBarang').val(data.credit);
                            $('#editKeterangan').val(data.keterangan);
                        }
                    });
                });
            });
        </script>
    @endsection
