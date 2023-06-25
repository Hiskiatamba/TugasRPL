<div class="modal fade" id="modaledit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Form Tambah Data Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('Kategori/updatedatakategori',['class' => 'formeditkategori']) ?>
            <div class="pesan" style="display:none"></div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="kode_kategori">Kode Kategori</label>
                    <input type="text" class="form-control" id="kode_kategori" name="kode_kategori"
                        placeholder="Masukan Kode Kategori" readonly value="<?= $kode_kategori ?>">
                </div>
                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                        placeholder="Masukan Nama Kategori" value="<?= $nama_kategori ?>">
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
    $('.formeditkategori').submit(function(e) {
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
                        title: 'Data Kategori',
                        text: response.sukses
                    })
                    tampildatakategori();
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