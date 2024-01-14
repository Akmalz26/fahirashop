<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wedding Dream - SantriKoding.com</title>
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
                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-create-produk">TAMBAH</a>
                    <h6 class="mb-4">Responsive Table</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">image</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-produks">
                                @foreach($produks as $produk)
                                <tr id="index_{{ $produk->id }}">
                                <td>{{ $produk->nama }}</td>
                                    <td>{{ $produk->deskripsi }}</td>
                                    <td>
                                        <img src="{{ asset('image/' . $produk->image) }}" class="img-fluid" width="150px">
                                    </td>
                                    <td>{{ $produk->harga }}</td>
                                    <td>{{ $produk->stok }}</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" id="btn-edit-produk" data-id="{{ $produk->id }}" class="btn btn-primary btn-sm">EDIT</a>
                                        <a href="javascript:void(0)" id="btn-delete-produk" data-id="{{ $produk->id }}" class="btn btn-danger btn-sm">DELETE</a>
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
    <!-- Table End -->
    @include('produk.create')
    @include('produk.edit')
    @include('produk.delete')
    @endsection
</body>
</html>