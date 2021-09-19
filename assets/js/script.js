$(document).ready(function() {

    //=================================================================================================//

    // menghapus select option yang sudah dipilih pada id kota
    $('#provinsi').on('click', function() {
        var selectList = $("#kota");
        selectList.find('option').not(':first').remove();
    })

    $('#provinsi_tujuan').on('click', function() {
        var selectList = $("#kota_tujuan");
        selectList.find('option').not(':first').remove();
    })

    $('select, input').click(function(){
        $('.hasil').remove()//menghapus hasil ongkir sebelumnya
    })
    //=================================================================================================// 

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

    //=================================================================================================//

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
                var obj = JSON.parse(response);
                $.each(obj, function(key, value) {
                    $('#kota_tujuan').append('<option value="' + value.id_kota + '">' + value.kota + '</option>')
                })
            }
        })
    })

    //==================================================================================================//

    // hitung harga ongkir
    $('#hitung').on('click', function() {
        var kota_awal = $('select[name=kota] option').filter(':selected').val();
        var kota_tujuan = $('select[name=kota_tujuan] option').filter(':selected').val();
        var kurir = $('select[name=kurir] option').filter(':selected').val();
        var berat_barang = $('#barang').val()

        if (kota_awal == '' || kota_awal == 'Kabupaten/Kota' || kota_tujuan == '' || kota_tujuan == 'Kabupaten/Kota' || kurir == '' || berat_barang == '') {
            $('.alert').removeClass('d-none')
            return false
        } else {

            $('#loading').removeClass('d-none');
            $('#hitung').addClass('d-none');

            $.ajax({
                url: 'home/data_cost',
                type: 'post',
                data: {
                    kota_awal: kota_awal,
                    kota_tujuan: kota_tujuan,
                    kurir: kurir,
                    berat_barang: berat_barang
                },
                success: function(response) {
                    var obj = JSON.parse(response);

                    $('#loading').addClass('d-none') //menampilkan button loading
                    $('#hitung').removeClass('d-none'); //memunculkan button hitung
                    $('.alert').addClass('d-none') //menghapus class alert
                    $('#barang').val('')//menghapus input berat barang

                    $.each(obj, function(key, value) {
                        var tarif = value
                        $.each(tarif, function(key, value1) {
                            var service = value1.service
                            var description = value1.description
                            var harga = value1.cost[0].value;
                            var estimasi = value1.cost[0].etd;

                            $('#table').find('tbody')
                                .append($('<tr>')
                                    .append($('<td class="text-uppercase hasil">')
                                        .text(kurir)
                                    )
                                    .append($('<td  class="hasil">')
                                        .text(service)
                                    ).append($('<td  class="hasil">')
                                        .text(description)
                                    )
                                    .append($('<td  class="hasil">')
                                        .text(harga)
                                    )
                                    .append($('<td  class="hasil">')
                                        .text(estimasi + ' hari')
                                    )
                                )
                        })
                    })
                }
            })
        }
    })


    //==================================================================================================//

    // menonaktifkan select option pada opton kabupaten/kota
    // $('.option_kota').attr('disabled', 'disabled')

    //==================================================================================================//


}) //end jquery
