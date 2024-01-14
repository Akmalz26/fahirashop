<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wedding Dream</title>
    <style>
        body {
            background-color: lightgray !important;
        }

    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
@extends('layouts.admin')
<body>
@section('content')
    
     <!-- Table Start -->
     <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-create-transaksi">TAMBAH</a>
                    <h6 class="mb-4">Responsive Table</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Pelanggan</th>
                                    <th>Kasir</th>
                                    <th>tgl</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="table-transaksis">
                                @foreach($transaksis as $transaksi)
                                <tr id="index_{{ $transaksi->id }}">
                                    <td>{{ optional($transaksi->produk)->nama }}</td>
                                    <td>{{ optional($transaksi->pelanggan)->nama }}</td>
                                    <td>{{ $transaksi->kasir->nama }}</td>
                                    <td>{{ $transaksi->tgl }}</td>
                                    <td>{{ $transaksi->jumlah }}</td>
                                    <td>{{ $transaksi->jumlah  *  optional($transaksi->produk)->harga }}</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" id="btn-edit-transaksi" data-id="{{ $transaksi->id }}" class="btn btn-primary btn-sm">EDIT</a>
                                        <a href="javascript:void(0)" id="btn-delete-transaksi" data-id="{{ $transaksi->id }}" class="btn btn-danger btn-sm">DELETE</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('transaksi.create') 
    @include('transaksi.edit') 
    @include('transaksi.delete') 
    @endsection
</body>
</html>