{{-- halaman view produk --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                {{-- tombol untuk modal tambah --}}
                <a href="#" class="btn btn-sm btn-success mb-4 text-white" data-bs-toggle="modal"
                    data-bs-target="#tambah">Tambah</a>
                <table class="table table-bordered border-2">
                    <tr class="text-center text-white bg-dark">
                        <td>No</td>
                        <td>Produk</td>
                        <td>Foto</td>
                        <td>Harga</td>
                        <td>Kategori</td>
                        <td>Deskripsi</td>
                        <td>Action</td>
                    </tr>
                    @foreach ($data as $d)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->namaProduk }}</td>
                            <td><img src="{{ asset('Storage/' . $d->foto) }}" alt="" width="50px"></td>
                            <td>{{ $d->harga }}</td>
                            <td>{{ $d->category->namaKategori }}</td>
                            <td>{{ $d->descProduk }}</td>
                            <td>
                                {{-- tombol untuk modal edit --}}
                                <a href="#" class="btn btn-sm btn-primary text-white" data-bs-toggle="modal"
                                    data-bs-target="#edit{{ $d->id }}">Edit</a>

                                {{-- tombol untuk modal hapus --}}
                                <a href="#" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal"
                                    data-bs-target="#hapus{{ $d->id }}">Delete</a>
                            </td>
                        </tr>

                        {{-- modal hapus produk --}}
                        <div class="modal fade" id="hapus{{ $d->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <b>{{ $d->namaProduk }}</b>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('produk.destroy', $d->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-sm text-white btn-danger">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- modal ubah produk --}}
                        <div class="modal fade" id="edit{{ $d->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('produk.update', $d->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="mb-3">
                                                <label class="col-form-label">Produk</label>
                                                <input type="text" class="form-control" name="namaProduk"
                                                    value="{{ $d->namaProduk }}">
                                                <label class="col-form-label">Harga</label>
                                                <input type="number" class="form-control" name="harga"
                                                    value="{{ $d->harga }}">
                                                <label class="col-form-label">Deskripsi</label>
                                                <input type="text" class="form-control" name="descProduk"
                                                    value="{{ $d->descProduk }}">
                                                <img src="{{ asset('Storage/' . $d->foto) }}" alt=""
                                                    width="100px">
                                                <label class="col-form-label">Foto</label>
                                                <input type="file" class="form-control" name="foto"
                                                    value="{{ $d->foto }}" readonly>
                                                @if (Auth::user()->role == 'admin')
                                                    <label class="col-form-label">Kondisi</label>
                                                    <select name="kondisi" id="" class="form-control">
                                                        <option value="aktif">Aktif</option>
                                                        <option value="nonaktif">Non Aktif</option>
                                                    </select>
                                                @else
                                                    <input type="hidden" value="aktif" name="kondisi">
                                                @endif
                                                <label class="col-form-label">Kategori</label>
                                                <select name="category_id" id="" class="form-control">
                                                    <option value="{{ $d->category_id }}">Kategori tidak diubah</option>
                                                    @foreach ($join as $j)
                                                        <option value="{{ $j->id }}">{{ $j->namaKategori }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" value="Edit" class="btn btn-sm text-white btn-primary">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </table>

                {{-- modal tambah produk --}}
                <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="col-form-label">Produk</label>
                                        <input type="text" class="form-control" name="namaProduk" required>
                                        <label class="col-form-label">Harga</label>
                                        <input type="number" class="form-control" name="harga" required>
                                        <label class="col-form-label">Deskripsi</label>
                                        <input type="text" class="form-control" name="descProduk" required>
                                        <label class="col-form-label">Foto</label>
                                        <input type="file" class="form-control" name="foto" required>
                                        @if (Auth::user()->role == 'admin')
                                            <label class="col-form-label">Kondisi</label>
                                            <select name="kondisi" id="" class="form-control">
                                                <option value="aktif">Aktif</option>
                                                <option value="nonaktif">Non Aktif</option>
                                            </select>
                                        @else
                                            <input type="hidden" value="aktif" name="kondisi">
                                        @endif
                                        <label class="col-form-label">Kategori</label>
                                        <select name="category_id" id="" class="form-control" required>
                                            @foreach ($join as $j)
                                                <option value="{{ $j->id }}">{{ $j->namaKategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" value="Tambah" class="btn btn-sm text-white btn-success">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
