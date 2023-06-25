<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Admin_m');
        $this->load->helper(array('form', 'url'));
    }
    public function index()
    {
        $data['admin']   =   $this->db->get_where('admin', ['username_admin' => $this->session->userdata('username_admin')])->row_array();
        $data['data_barang']         = $this->Admin_m->jumlah_data_barang();
        $data['data_barang_masuk']    = $this->Admin_m->jumlah_data_barang_masuk();
        $data['data_barang_keluar']   = $this->Admin_m->jumlah_data_barang_keluar();
        $data['data_kategori']       = $this->Admin_m->jumlah_data_kategori();

        if ($this->session->userdata('username_admin') == null) {
            redirect('Admin/login');
        } else {
            $this->load->view('admin/Home', $data);
        }
    }

    private function _login_private_admin()
    {
        $data['admin']   =   $this->db->get_where('admin', ['username_admin' => $this->session->userdata('username_admin')])->row_array();
        if ($this->session->userdata('nama_admin')) {
            $this->session->set_flashdata('sukses', 'Kamu Berhasil Login !');

            redirect('admin/index');
        }

        $username_admin     =   $this->input->post('username_login');
        $password_admin     =   $this->input->post('password_login');

        $data_admin         =   $this->db->get_where('admin', ['username_admin' => $username_admin])->row_array();
        if ($data_admin) {
            if (password_verify($password_admin, $data_admin['password_admin'])) {
                $data_admin = ['username_admin' => $data_admin['username_admin']];
                $this->session->set_flashdata('error', 'Username Atau Password Salah !');

                $this->session->set_userdata($data_admin);

                redirect('admin/index');
            } else {
                $this->session->set_flashdata('error', 'Username Atau Password Salah !');
                redirect('Admin/login');
            }
        } else {
            $this->session->set_flashdata('error', 'Username Atau Password Salah !');
            redirect('Admin/login');
        }
    }
    public function login()
    {


        $data['admin']   =   $this->db->get_where('admin', ['username_admin' => $this->session->userdata('username_admin')])->row_array();
        if ($this->session->userdata('username_admin')) {
            redirect('admin/index');
        }

        $this->Admin_m->set_rules_admin_login();

        if ($this->form_validation->run() == false) {
            $this->load->view('login');
        } else {
            $this->_login_private_admin();
        }
    }

    public function data_barang()
    {
        $data['admin']   =   $this->db->get_where('admin', ['username_admin' => $this->session->userdata('username_admin')])->row_array();

        if ($this->session->userdata('username_admin') == null) {
            redirect('Admin/login');
        } else {
            $this->load->view('Barang/tampil_data_barang', $data);
        }
    }

    public function data_barang_masuk()
    {
        $data['admin']   =   $this->db->get_where('admin', ['username_admin' => $this->session->userdata('username_admin')])->row_array();

        if ($this->session->userdata('username_admin') == null) {
            redirect('Admin/login');
        } else {
            $this->load->view('Barang_masuk/tampil_data_barang_masuk', $data);
        }
    }

    public function data_barang_keluar()
    {
        $data['admin']   =   $this->db->get_where('admin', ['username_admin' => $this->session->userdata('username_admin')])->row_array();

        if ($this->session->userdata('username_admin') == null) {
            redirect('Admin/login');
        } else {
            $this->load->view('Barang_keluar/tampil_data_barang_keluar', $data);
        }
    }

    public function data_kategori()
    {
        $data['admin']   =   $this->db->get_where('admin', ['username_admin' => $this->session->userdata('username_admin')])->row_array();

        if ($this->session->userdata('username_admin') == null) {
            redirect('Admin/login');
        } else {
            $this->load->view('Kategori/tampildata', $data);
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('username_admin');
        redirect('admin');
    }
}