<div class="modal fade" id="modaltambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Form Tambah Data Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('Barangmasuk/simpandatabarangmasuk',['class' => 'formtambahbarangmasuk']) ?>
            <div class="pesan" style="display:none"></div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control select2bs4" style="width: 100%;" id="barang" name="barang">
                        <option selected="selected">- Pilih Kategori -</option>
                        <?php foreach ($barang as $value) { ?>
                        <option value="<?= $value->kode_barang ?>"><?= $value->nama_barang ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_masuk">Tanggal Barang Masuk</label>
                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk">
                </div>
                <div class="form-group">
                    <label for="kode_barang">Kode Barang</label>
                    <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                        placeholder="Kode Barang" readonly>
                </div>
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                        placeholder="Nama Barang" readonly>
                </div>
                <div class="form-group">
                    <label for="nama_kategori">Kategori</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                        placeholder="Kategori" readonly>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" id="kode_kategori" name="kode_kategori"
                        placeholder="Kategori" readonly>
                </div>
                <div class="form-group">
                    <label for="jumlah_bm">Jumlah Barang Masuk</label>
                    <input type="text" class="form-control" id="jumlah_bm" name="jumlah_bm"
                        placeholder="Jumlah Barang Masuk">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
$(document).ready(function() {
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });

    $('.formtambahbarangmasuk').submit(function(e) {
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    $('.pesan').html(response.error).show();
                }

                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Barang',
                        text: response.sukses
                    })
                    tampildatabarangmasuk();
                    $('#modaltambah').modal('hide');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(" Error Occured " + "\n URL: " + options.url + "\n Status: " + xhr
                    .status + " " + xhr.statusText);
            }
        });
        return false;
    });

    $('#barang').change(function(e) {
        var id_barang = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('Barangmasuk/tampil_data_barang') ?>",
            data: {
                id_barang: id_barang
            },
            dataType: "JSON",
            success: function(response) {
                $('#kode_barang').val(response.kode_barang);
                $('#nama_barang').val(response.nama_barang);
                $('#nama_kategori').val(response.nama_kategori);
                $('#kode_kategori').val(response.kode_kategori);
            }
        });
    });


});
</script>