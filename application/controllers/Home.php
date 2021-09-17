<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {

        // $data['provinsi'] = $this->data_provinsi(); //memanggil data provinsi
        $data_cost = $this->data_cost(); //memanggil data provinsi

        echo '<pre>';
        print_r($data_cost);
        echo '<pre>';



        $data['judul']    = 'Home';
        $this->load->view('templates/header', $data);
        $this->load->view('Home/index', $data);
        $this->load->view('templates/footer');
    }

    //mendapatkan data provinsi
    public function data_provinsi()
    {
        $result = call_curl('https://api.rajaongkir.com/starter/province?key=fa49f24f8066436b03d51d12af6288f8');

        $result = json_decode($result, true);

        foreach ($result['rajaongkir']['results'] as $value_provinsi) {
            $provinsi[] = [
                "provinsi" => $value_provinsi
            ];
        }

        return $provinsi;
    }

    public function data_kota()
    {
        $kota    = htmlspecialchars($this->input->post('value_kota', true));
        // $kota    = 5;

        $result     = call_curl('https://api.rajaongkir.com/starter/city?key=fa49f24f8066436b03d51d12af6288f8' . '&province=' . $kota);

        $result = json_decode($result, true);

        $kota = [];
        foreach ($result['rajaongkir']['results']  as $value_kota) {
            $kota[] = [
                "id_kota" => $value_kota['city_id'],
                "kota"     => $value_kota['city_name']
            ];
        }

        echo json_encode($kota);
    }

    public function data_cost()
    {
        // $kota_awal    = htmlspecialchars($this->input->post('kota_awal', true));
        // $kota_tujuan    = htmlspecialchars($this->input->post('kota_tujuan', true));
        // $kurir    = htmlspecialchars($this->input->post('kurir', true));
        // $berat_barang    = htmlspecialchars($this->input->post('berat_barang', true));

        // $result     = call_curl('https://api.rajaongkir.com/starter/cost?key=fa49f24f8066436b03d51d12af6288f8' . '&origin=' . $kota_awal . 'destinatiion=' . $kota_tujuan . '&weight=' . $berat_barang . '&courier=' . $kurir . '&REQUEST=POST');

        // $result = json_decode($result, true);

        // echo '<pre>';
        // print_r($result);
        // echo '</pre>';

        $cost = cost();

        return $cost;
    }
    //end
}
