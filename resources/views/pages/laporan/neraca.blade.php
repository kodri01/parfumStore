@extends('layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $judul }}</h1>
    </div>

    <form action="{{ route('lap.neraca') }}" method="GET">
        <div class="wrapper-table bg-white rounded ">
            <div class="card shadow ">
                <div class="card-header">
                    <div class="input-group flex-nowrap w-25">
                        <select id="tahun" name="tahun" class="btn btn-primary">
                            <option selected disabled class="text-white">-- Pilih Tahun --</option>
                            @foreach ($tahun as $tahunItem)
                                <option value="{{ $tahunItem }}">{{ $tahunItem }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-header text-center">
                            <h6 class="text-uppercase "><b>{{ $setting->company_name }}</b></h6>
                            <h6 class="text-capitalize"><b>laporan posisi keuangan (neraca)</b></h6>
                            <h6 class="text-capitalize"><b>Periode Akhir Desember {{ $selectedYear }}</b></h6>
                        </div>
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-sm-12 col-md-6 col-lg-6 ">
                                    <center> <span class="text-uppercase"><b>aktiva</b></span></center>
                                    <span class="text-capitalize"><b>Asset</b></span>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <span>Kas</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <span class="text-right">{{ 'Rp ' . number_format($kas, 0, ',', '.') }}</span>
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <span><b>Total Asset</b></span>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <span
                                                class="text-right"><b>{{ 'Rp ' . number_format($kas, 0, ',', '.') }}</b></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <center> <span class="text-uppercase"><b>kewajiban</b></span></center>
                                    <span class="text-capitalize"><b>kewajiban & ekuitas</b></span>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <span>Total Modal</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <span
                                                class="text-right">{{ 'Rp ' . number_format($totalModal, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <span>Keuntungan</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <span class=" text-right">{{ 'Rp ' . number_format($profit, 0, ',', '.') }}
                                            </span>
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <span><b>Total Modal + Keuntungan</b></span>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <span
                                                class="text-right"><b>{{ 'Rp ' . number_format($totalEkuitas, 0, ',', '.') }}</b></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil elemen dropdown tahun
            var dropdownTahun = document.getElementById('tahun');

            // Tambahkan event listener untuk perubahan nilai dropdown
            dropdownTahun.addEventListener('change', function() {
                // Submit form saat nilai dropdown berubah
                this.closest('form').submit();
            });
        });
    </script>
@endsection
