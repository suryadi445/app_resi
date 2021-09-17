<div class="container border p-3 mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col">
                    <h3 class="text-center">Cek Ongkir</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col">
                                <h4 class="text-center text-capitalize">alamat pengirim</h4>
                                <select class="custom-select shadow mb-3" name="provinsi" id="provinsi">
                                    <option>Provinsi</option>
                                    <?php foreach ($provinsi as $value_provinsi) : ?>
                                        <option value="<?= $value_provinsi['provinsi']['province_id'] ?>" class="kota"><?= $value_provinsi['provinsi']['province'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select class="custom-select shadow mb-3" name="kota" id="kota">
                                    <option selected>Kabupaten/Kota</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select class="custom-select mb-3 shadow" name="kurir" id="kurir">
                                    <option selected>Pilih Kurir</option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">POS INDONESIA</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="berat">Berat barang</label>
                                    <input type="number" class="form-control" id="barang">
                                    <small class="form-text text-muted">Barang dalam satuan gram(1kg = 1000gr)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- alamat tujuan -->
                <div class="col-md-6">
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col">
                                <h4 class="text-center text-capitalize">alamat tujuan</h4>
                                <select class="custom-select shadow mb-3" name="provinsi_tujuan" id="provinsi_tujuan">
                                    <option>Provinsi</option>
                                    <?php foreach ($provinsi as $value_provinsi) : ?>
                                        <option value="<?= $value_provinsi['provinsi']['province_id'] ?>" class="kota"><?= $value_provinsi['provinsi']['province'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <select class="custom-select shadow mb-3" name="kota_tujuan" id="kota_tujuan">
                                    <option selected>Kabupaten/Kota</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-primary" id="hitung">Hitung biaya</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="ongkir">Harga Ongkir</label>
                                    <input type="text" class="form-control" id="ongkir">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        // menghapus select option yang sudah dipilih pada id kota
        // $('#provinsi, #provinsi_tujuan').on('click', function() {
        //     $('#kota option').remove();
        // })
        //=== === === === === === === === === === === === === === === === === === === === === === === === 
        // alamat pengirim
        $('#provinsi').on('change', function() {
            var value_kota = this.value;
            $.ajax({
                url: 'home/data_kota',
                type: 'post',
                data: {
                    value_kota
                },
                success: function(response) {
                    var kota = JSON.parse(response);
                    // console.log(kota);
                    $.each(kota, function(key, value) {
                        $('#kota').append('<option value="' + value.id_kota + '">' + value.kota + '</option>')
                    })
                }
            })
        })

        // alamat tujuan
        $('#provinsi_tujuan').on('change', function() {
            var value_kota = this.value;
            $.ajax({
                url: 'home/data_kota',
                type: 'post',
                data: {
                    value_kota
                },
                success: function(response) {
                    var kota = JSON.parse(response);
                    console.log(kota);
                    $.each(kota, function(key, value) {
                        $('#kota_tujuan').append('<option value="' + value.id_kota + '">' + value.kota + '</option>')
                    })
                }
            })
        })

        //=== === === === === === === === === === === === === === === === === === === === === === === === 
        $('#hitung').on('click', function() {
            var kota_awal = $('select[name=kota] option').filter(':selected').val();
            var kota_tujuan = $('select[name=kota_tujuan] option').filter(':selected').val();
            var kurir = $('select[name=kurir] option').filter(':selected').val();
            var berat_barang = $('#barang').val()

            $.ajax({
                url: 'home/cost',
                type: 'post',
                data: {
                    kota_awal: kota_awal,
                    kota_tujuan: kota_tujuan,
                    kurir: kurir,
                    berat_barang: berat_barang
                },
                success: function(response) {
                    console.log(response);
                }
            })
        })
    })
</script>