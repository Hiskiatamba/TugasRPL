<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('template/plugins') ?>/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url('template/plugins') ?>/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<div class="modal fade" id="modaledit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Form Tambah Data Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('Barang/updatedatabarang', ['class' => 'formeditbarang']) ?>
            <div class="pesan" style="display:none"></div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="kode_barang">Kode Barang</label>
                    <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                        placeholder="Masukan Kode Barang" readonly value="<?= $kode_barang ?>">
                </div>
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                        placeholder="Masukan Nama Kategori" value="<?= $nama_barang ?>">
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control select2bs4" style="width: 100%;" name="kategori">
                        <?php
                        if ('<option selected="selected" value=' . $kode_kategori . '>' . $nama_kategori . '</option>') {
                            echo '<option selected="selected" value=' . $kode_kategori . '>' . $nama_kategori . ' (Pilihan Saat Ini)' . '</option>';
                        } ?>
                        <?php foreach ($kategori as $value) { ?>
                        <option value="<?= $value->kode_kategori ?>"><?= $value->nama_kategori ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Masukan Harga Barang"
                        value="<?= $harga ?>">
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="text" class="form-control" id="stok" name="stok" placeholder="Masukan Stok Barang"
                        value="<?= $stok ?>">
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
<!-- Select2 -->
<script src="<?= base_url('template/plugins') ?>/select2/js/select2.full.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });

    $('.formeditbarang').submit(function(e) {
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
                    tampildatabarang();
                    $('#modaledit').modal('hide');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(" Error Occured " + "\n URL: " + options.url + "\n Status: " + xhr
                    .status + " " + xhr.statusText);
            }
        });
        return false;
    });
});
</script>