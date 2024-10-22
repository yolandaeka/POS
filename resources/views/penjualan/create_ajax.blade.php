<form id="form-tambah" action="{{ url('/penjualan/ajax') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <!-- Input Nama Pembeli -->
                <div class="form-group">
                    <label class="control-label col-form-label" for="pembeli">Nama Pembeli</label>
                    <input type="text" name="pembeli" class="form-control" id="pembeli" required>
                </div>

                <!-- Input Tanggal Penjualan -->
                <div class="form-group">
                    <label class="control-label col-form-label" for="penjualan_tanggal">Tanggal Penjualan</label>
                    <input type="datetime-local" name="penjualan_tanggal" class="form-control" id="penjualan_tanggal" required>
                </div>

                <!-- Section for Barang Detail -->
                <h3>Detail Barang</h3>
                <div id="barang-section">
                    <!-- Baris pertama barang -->
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="control-label col-form-label" for="barang_id">Barang</label>
                            <select name="barangs[0][barang_id]" class="form-control" required>
                                <option value="">- Pilih Barang -</option>
                                @foreach ($barang as $item)
                                    <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label col-form-label" for="jumlah">Jumlah</label>
                            <input type="number" name="barangs[0][jumlah]" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label col-form-label" for="harga">Harga</label>
                            <input type="number" name="barangs[0][harga]" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <!-- Tombol Tambah Barang -->
                <button type="button" id="add-barang" class="btn btn-info">Tambah Barang</button>

                <!-- Tombol Simpan -->
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</form>

@push('scripts')
    <script>
        let barangIndex = 1; // Mulai indeks barang dari 1 karena 0 sudah ada di template awal

        // Fungsi untuk menambah baris barang
        document.getElementById('add-barang').addEventListener('click', function() {
            let barangSection = document.getElementById('barang-section');
            let newBarang = `
            <div class="form-group row">
                <div class="col-md-4">
                    <label class="control-label col-form-label" for="barang_id">Barang</label>
                    <select name="barangs[${barangIndex}][barang_id]" class="form-control" required>
                        <option value="">- Pilih Barang -</option>
                        @foreach ($barang as $item)
                            <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="control-label col-form-label" for="jumlah">Jumlah</label>
                    <input type="number" name="barangs[${barangIndex}][jumlah]" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="control-label col-form-label" for="harga">Harga</label>
                    <input type="number" name="barangs[${barangIndex}][harga]" class="form-control" required>
                </div>
            </div>`;
            
            barangSection.insertAdjacentHTML('beforeend', newBarang);
            barangIndex++; // Tingkatkan indeks barang untuk setiap tambahan barang baru
        });


            submitHandler: function(form) {
            var formData = new FormData(form); // Gunakan FormData untuk file upload

            $.ajax({
                url: form.action,
                type: form.method,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status) {
                        // Menampilkan notifikasi berhasil
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        }).then(function() {
                            // Reload halaman atau update data setelah Swal ditutup
                            if (typeof dataTransaksi !== 'undefined') {
                                dataTransaksi.ajax.reload(); // Reload data table jika ada
                            } else {
                                location.reload(); // Reload halaman jika tidak ada dataTransaksi
                            }
                        });
                    } else {
                        // Menampilkan error dari validasi field
                        $('.error-text').text('');
                        $.each(response.msgField, function(prefix, val) {
                            $('#error-' + prefix).text(val[0]);
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan. Silakan coba lagi nanti.'
                    });
                }
            });
            return false;
        },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
    </script>
@endpush
