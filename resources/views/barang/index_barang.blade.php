@extends('layouts.template')

@section('content')

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('barang/create') }}">Tambah</a>
        </div>
    </div>
<div class="card-body">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success')}}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error')}}</div>
    @endif

    <div class="row">
        <div class="col-md-12">
        <div class="form-group-now">
            <label for="filter" class="col-1 control-label col-form-label">Filter</label>
            <div class="col-3">
                <select name="kategori_id" id="kategori_id" class="form-control" required>
                    <option value="">- Semua -</option>
                    @foreach ($kategori as $item )
                        <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama}}</option>
                    @endforeach
                </select>
                <br>
            </div>
        </div>
        </div>
    </div>
    <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Kategori</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Aksi</th></tr>
        </thead>
    </table>
</div>
</div>
</div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    $(document).ready(function() {
        var dataUser = $('#table_barang').DataTable({
         // serverSide: true, jika ingin menggunakan server side processing
        serverSide: true,
        ajax: {
            "url": "{{ url('barang/list') }}",
            "dataType": "json",
            "type": "POST",
            "data": function(d){
                d.kategori_id = $('#kategori_id').val();
            }
            },
        columns: [
            {
                // nomor urut dari laravel datatable addIndexColumn() data: "DT_RowIndex",
                data: "DT_RowIndex",
                className: "text-center",
                orderable: false,
                searchable: false
            },{
                data: "barang.kategori_nama",
                className: "",
                // orderable: true, jika ingin kolom ini bisa diurutkan
                orderable: false,
                // searchable: true, jika ingin kolom ini bisa dicari 
                searchable:false
            },{
                data: "barang_kode",
                className: "",
                orderable: true,
                searchable: true
            },{
                // mengambil data level hasil dari ORM berelasi
                data: "barang_nama",
                className: "",
                orderable: false,
                searchable: false
            },
            {
                // mengambil data level hasil dari ORM berelasi
                data: "harga_beli",
                className: "",
                orderable: false,
                searchable: false
            },
            {
                // mengambil data level hasil dari ORM berelasi
                data: "harga_jual",
                className: "",
                orderable: false,
                searchable: false
            },
            {
                data: "aksi", 
                className: "",
                orderable: false, 
                searchable: false
            }
        ]       
    });

    $('#kategori_id').on('change', function(){
        dataUser.ajax.reload();
    })
});
</script>
@endpush
