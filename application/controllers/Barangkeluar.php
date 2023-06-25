<?php
class Barangkeluar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barangkeluar_m');
    }
    public function index()
    {
        $data['admin']   =   $this->db->get_where('admin', ['username_admin' => $this->session->userdata('username_admin')])->row_array();
        if ($this->session->userdata('username_admin') == null) {
            redirect('Admin/login');
        } else {
            $this->load->view('Barang_keluar/tampil_data_barang_keluar', $data);
        }
    }

    public function ambildata()
    {
        if ($this->input->is_ajax_request() == true) {
            $this->load->model('Barangkeluar_m', 'barangkeluar');
            $list = $this->barangkeluar->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = array();
                // Membuat Tombol Edit Dan Delete
                $tombolhapus = "<button id=\"tombolhapus\" type=\"button\" class=\"btn btn-outline-danger\" tittle=\"Hapus Data\" onclick=\"hapus('".$field->id_bk."')\" ><i class=\"fas fa-trash\" ></i></button>";
                $row[] = $no;
                $row[] = $field->tanggal_keluar;
                $row[] = $field->kode_barang;
                $row[] = $field->nama_barang;
                $row[] = $field->nama_kategori;
                $row[] = $field->jumlah_bk;
                $row[] = $tombolhapus;
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->barangkeluar->count_all(),
                "recordsFiltered" => $this->barangkeluar->count_filtered(),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    public function formtambah()
    {
        if ($this->input->is_ajax_request() == true) {
            $data['barang']   = $this->Barangkeluar_m->ambildata_barang()->result();

            $msg    =   [
                'sukses' => $this->load->view('barang_keluar/modaltambah', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    public function tampil_data_barang(){
        if ($this->input->is_ajax_request() == true) {
            $id_barang  =   $this->input->post('id_barang',true);

            $data   =   $this->Barangmasuk_m->ambildata_selectbarang($id_barang);
            if($data->num_rows()>0){

                $row    =   $data->row_array();
                $data_barang   =   [
                    'kode_barang'   =>  $id_barang,
                    'nama_barang'   =>  $row['nama_barang'],
                    'nama_kategori' =>  $row['nama_kategori'],
                    'kode_kategori' =>  $row['kode_kategori']
                ];
            }
            echo json_encode($data_barang);
        }
    }

    public function simpandatabarangkeluar()
    {
        if ($this->input->is_ajax_request() == true) {
            
            $tanggal_keluar  =   $this->input->post('tanggal_keluar',true);
            $kode_barang    =   $this->input->post('kode_barang',true);
            $kode_kategori  =   $this->input->post('kode_kategori',true);
            $jumlah_bk      =   $this->input->post('jumlah_bk',true);

            $this->form_validation->set_rules(
                'jumlah_bk',
                'Jumlah Barang Masuk',
                'trim|required',
                [
                    'required'  => 'Jumlah Barang Masuk Tidak Boleh Kosong !'
                ]
            );

            if ($this->form_validation->run() == true) {
                $this->Barangkeluar_m->simpandatabarang_keluar($tanggal_keluar,$kode_barang,$kode_kategori,$jumlah_bk);
                    $msg    =   [
                        'sukses'    => 'Berhasil Disimpan !'
                    ];
            } else {
                $msg    =   [
                    'error' => '<div class="alert alert-danger" role="alert">' . validation_errors() . '
                    </div>'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapusdatabarangkeluar(){
        if ($this->input->is_ajax_request() == true) {
            $id_bk    =   $this->input->post('id_bk', true);
            $hapus    =   $this->Barangkeluar_m->hapus_data_barang_keluar($id_bk);
            
            if($hapus){
                $msg    =   [
                    'sukses'    => 'Barang Berhasil Dihapus !'
                ];
            }
            echo json_encode($msg);
        }
    }
}