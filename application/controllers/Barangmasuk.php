<?php
class Barangmasuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barangmasuk_m');
    }
    public function index()
    {
        $data['admin']   =   $this->db->get_where('admin', ['username_admin' => $this->session->userdata('username_admin')])->row_array();
        if ($this->session->userdata('username_admin') == null) {
            redirect('Admin/login');
        } else {
            $this->load->view('Barang_masuk/tampil_data_barang_masuk', $data);
        }
    }

    public function ambildata()
    {
        if ($this->input->is_ajax_request() == true) {
            $this->load->model('Barangmasuk_m', 'barangmasuk');
            $list = $this->barangmasuk->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = array();
                // Membuat Tombol Edit Dan Delete
                $tombolhapus = "<button id=\"tombolhapus\" type=\"button\" class=\"btn btn-outline-danger\" tittle=\"Hapus Data\" onclick=\"hapus('".$field->id_bm."')\" ><i class=\"fas fa-trash\" ></i></button>";
                $row[] = $no;
                $row[] = $field->tanggal_masuk;
                $row[] = $field->kode_barang;
                $row[] = $field->nama_barang;
                $row[] = $field->nama_kategori;
                $row[] = $field->jumlah_bm;
                $row[] = $tombolhapus;
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->barangmasuk->count_all(),
                "recordsFiltered" => $this->barangmasuk->count_filtered(),
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
            $data['barang']   = $this->Barangmasuk_m->ambildata_barang()->result();

            $msg    =   [
                'sukses' => $this->load->view('barang_masuk/modaltambah', $data, true)
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

    public function simpandatabarangmasuk()
    {
        if ($this->input->is_ajax_request() == true) {
            
            $tanggal_masuk  =   $this->input->post('tanggal_masuk',true);
            $kode_barang    =   $this->input->post('kode_barang',true);
            $kode_kategori  =   $this->input->post('kode_kategori',true);
            $jumlah_bm      =   $this->input->post('jumlah_bm',true);

            $this->form_validation->set_rules(
                'jumlah_bm',
                'Jumlah Barang Masuk',
                'trim|required',
                [
                    'required'  => 'Jumlah Barang Masuk Tidak Boleh Kosong !'
                ]
            );

            if ($this->form_validation->run() == true) {
                $this->Barangmasuk_m->simpandatabarang_masuk($tanggal_masuk,$kode_barang,$kode_kategori,$jumlah_bm);
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

    public function hapusdatabarangmasuk(){
        if ($this->input->is_ajax_request() == true) {
            $id_bm    =   $this->input->post('id_bm', true);
            $hapus    =   $this->Barangmasuk_m->hapus_data_barang_masuk($id_bm);
            
            if($hapus){
                $msg    =   [
                    'sukses'    => 'Barang Berhasil Dihapus !'
                ];
            }
            echo json_encode($msg);
        }
    }
}