<?php
class Admin_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Admin_m');
        $this->load->helper('url', 'file');
    }
    public function set_rules_admin_login()
    {
        $this->form_validation->set_rules(
            'username_login',
            'Username',
            'required|trim',
            [
                'required'      => 'Masukan Username !'
            ]
        );

        $this->form_validation->set_rules(
            'password_login',
            'Password',
            'required|trim|min_length[8]',
            [
                'required'      => 'Masukan Password!',
                'min_length'     => 'Password Kurang Dari 8 Karakter !',
            ]
        );
    }

    public function jumlah_data_barang()
    {
        $query = $this->db->get('barang');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function jumlah_data_barang_masuk()
    {
        $query = $this->db->get('barangmasuk');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function jumlah_data_barang_keluar()
    {
        $query = $this->db->get('barangkeluar');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function jumlah_data_kategori()
    {
        $query = $this->db->get('kategori');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
}