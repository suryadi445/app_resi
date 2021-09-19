<div class="container border p-3 mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col">
                    <h3 class="text-center">Cek Ongkir</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="alert alert-danger text-capitalize d-none" role="alert">
                        Data tidak boleh ada yang kosong
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col">
                                <h4 class="text-center text-capitalize">alamat pengirim</h4>
                                <label for="provinsi">Provinsi</label>
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
                                <label for="kota">Kabupaten/Kota</label>
                                <select class="custom-select shadow mb-3" name="kota" id="kota">
                                    <option selected class="option_kota">Kabupaten/Kota</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="kurir">Kurir</label>
                                <select class="custom-select mb-3 shadow" name="kurir" id="kurir">
                                    <!-- <option selected>Pilih Kurir</option> -->
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
                                    <input type="number" class="form-control shadow" id="barang">
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
                                <label for="provinsi_tujuan">Provinsi</label>
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
                                <label for="kota_tujuan">Kabupaten/Kota</label>
                                <select class="custom-select shadow mb-3" name="kota_tujuan" id="kota_tujuan">
                                    <option selected class="option_kota">Kabupaten/Kota</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-primary" id="hitung">Hitung biaya</button>
                            </div>
                        </div>
                        <button class="btn btn-primary d-none" type="button" disabled id="loading">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                        <div class="row mt-3">
                            <div class="col">
                                <table class="table shadow text-center" id="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Kurir</th>
                                            <th scope="col">Jenis Layanan</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Estimasi Sampai</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablerow">
                                        <!-- looping js -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>