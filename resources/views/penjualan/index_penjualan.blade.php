@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary" style="margin-left: 10px; margin-right:10px">
        <div class="card-header">
            <h3 class="card-title">Stok Barang</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/penjualan/import') }}')" class="btn btn-info">Import Stok</button>
                <a href="{{ url('/penjualan/export_excel') }}" class="btn btn-primary"><i class="fa fa-fileexcel"></i> Export Stok Excel</a>
                <a href="{{ url('/penjualan/export_pdf') }}" class="btn btn-warning"><i class="fa fa-filepdf"></i> Export Stok PDF</a>
                <button onclick="modalAction('{{ url('/penjualan/create_ajax') }}')" class="btn btn-success">Tambah Data</button>
            </div>
        </div>
        <div class="card-body">
            <!-- untuk Filter data -->
            <div id="filter" class="form-horizontal filter-date p-2 border-bottom mb-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-sm row text-sm mb-0">
                            <label class="col-1 control-label col-form-label">Filter:</label>
                            <div class="col-3">
                                <select class="form-control" id="user_id" name="user_id" required>
                                    <option value="">- Semua -</option>
                                    @foreach ($user as $item)
                                        <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">User</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-bordered table-sm table-striped table-hover" id="table-penjualan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Staff</th>
                        <th>Nama Pembeli</th>
                        <th>Penjualan Kode</th>
                        <th>Tanggal Penjualan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static" data-keyboard="false"
        data-width="75%"></div>
@endsection
@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        var tablePenjualan;

        $(document).ready(function() {
            tableStok = $('#table-penjualan').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ url('penjualan/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.user_id = $('#user_id').val();
                    }
                },

                columns: [
                {
                // nomor urut dari laravel datatable addIndexColumn() data: "DT_RowIndex",
                data: "DT_RowIndex",
                className: "text-center",
                orderable: false,
                searchable: false
                },
                {
                    data: "user.nama",
                    className: "text-center",
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "pembeli",
                    className: "text-center",
                    orderable: true,
                    searchable: true
                }, {
                    data: "penjualan_kode",
                    className: "text-center",
                    orderable: true,
                    searchable: true
                }, {
                    data: "penjualan_tanggal",
                    className: "text-center",
                    orderable: true,
                    searchable: false,
                }, {
                    data: "aksi",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }]
            });
            $('#table-penjualan_filter input').unbind().bind().on('keyup', function(e) {
                if (e.keyCode == 13) { // enter key
                    tablePenjualan.search(this.value).draw();
                }
            });
            
            $('#user_id').on('change', function() {
                tablePenjualan.ajax.reload();
            });
           
        });
    </script>
    @endpush
