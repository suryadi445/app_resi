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

        $data['provinsi'] = $this->data_provinsi(); //memanggil data provinsi

        // echo '<pre>';
        // print_r($data_cost);
        // echo '<pre>';



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
        $origin    = htmlspecialchars($this->input->post('kota_awal', true));
        $destination = htmlspecialchars($this->input->post('kota_tujuan', true));
        $courier    = htmlspecialchars($this->input->post('kurir', true));
        $weight    = htmlspecialchars($this->input->post('berat_barang', true));

        $result     = call_cost('https://api.rajaongkir.com/starter/cost', "origin=$origin&destination=$destination&weight=$weight&courier=$courier");

        // $result = json_decode($result, true);

        // print_r($result);

        // $tarif = [];
        foreach ($result as  $hasil) {
            // print_r($hasil);
            $data = [
                "data1" => $hasil['results']
            ];

            foreach ($data as $hasil2) {
                $data2 = [
                    "data2" => $hasil2
                ];

                foreach ($data2 as $hasil3) {
                    $data3 = [
                        "data3" => $hasil3[0]
                    ];

                    foreach ($data3 as $hasil4) {
                        $tarif = [
                            "tarif" => $hasil4['costs']
                        ];
                        echo json_encode($tarif);
                    }
                }
            }
        }
    }
    //end
}
