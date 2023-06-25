<?php
class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_m');
    }
    public function index()
    {
        $data['admin']   =   $this->db->get_where('admin', ['username_admin' => $this->session->userdata('username_admin')])->row_array();
        if ($this->session->userdata('username_admin') == null) {
            redirect('Admin/login');
        } else {
            $this->load->view('Barang/tampil_data_barang', $data);
        }
    }

    public function ambildata()
    {
        if ($this->input->is_ajax_request() == true) {
            $this->load->model('Barang_m', 'barang');
                           //ganti
            $list = $this->barang->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = array();
                // Membuat Tombol Edit Dan Delete
                $tomboledit = "<button id=\"tomboledit\" type=\"button\" class=\"btn btn-outline-info\" tittle=\"Edit Data\" onclick=\"edit('".$field->kode_barang."')\" ><i class=\"fas fa-tags\" ></i></button>";
                $tombolhapus = "<button id=\"tombolhapus\" type=\"button\" class=\"btn btn-outline-danger\" tittle=\"Hapus Data\" onclick=\"hapus('".$field->kode_barang."')\" ><i class=\"fas fa-trash\" ></i></button>";
                $row[] = $no;
                $row[] = $field->kode_barang;
                $row[] = $field->nama_barang;
                $row[] = $field->nama_kategori;
                $row[] = 'Rp. '.$field->harga.',-';
                $row[] = $field->stok;
                $row[] = $tomboledit.' '.$tombolhapus;
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->barang->count_all(),
                "recordsFiltered" => $this->barang->count_filtered(),
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
            $data['kategori']   = $this->Barang_m->ambildata_kategori()->result();

            $msg    =   [
                'sukses' => $this->load->view('Barang/modaltambah', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    public function simpandatabarang()
    {
        if ($this->input->is_ajax_request() == true) {
            $kode_barang    =   $this->input->post('kode_barang',true);
            $nama_barang    =   $this->input->post('nama_barang',true);
            $kategori       =   $this->input->post('kategori',true);
            $harga          =   $this->input->post('harga',true);
            $stok           =   $this->input->post('stok',true);

            $this->form_validation->set_rules(
                'kode_barang',
                'Kode Barang',
                'trim|required|is_unique[barang.kode_barang]',
                [
                    'required'  => 'Kode Barang Tidak Boleh Kosong !',
                    'is_unique' => 'Kode Barang Sudah Ada !'
                ]
            );

            $this->form_validation->set_rules(
                'nama_barang',
                'Nama Barang',
                'trim|required',
                [
                    'required'  => 'Nama Barang Tidak Boleh Kosong !'
                ]
            );

            $this->form_validation->set_rules(
                'harga',
                'Harga',
                'trim|required',
                [
                    'required'  => 'Harga Barang Tidak Boleh Kosong !'
                ]
            );

            $this->form_validation->set_rules(
                'stok',
                'Stok',
                'trim|required',
                [
                    'required'  => 'Stok Barang Tidak Boleh Kosong !'
                ]
            );

            if ($this->form_validation->run() == true) {
                $this->Barang_m->simpandatabarang($kode_barang,$nama_barang,$kategori,$harga,$stok);
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

    public function formedit(){
        if ($this->input->is_ajax_request() == true) {

            $kode_barang    =   $this->input->post('kode_barang',true);
            $ambildata     =   $this->Barang_m->ambildata($kode_barang);

            if($ambildata->num_rows()>0){

                $row    =   $ambildata->row_array();
                $data   =   [
                    'kode_barang'   =>  $kode_barang,
                    'nama_barang'   =>  $row['nama_barang'],
                    'nama_kategori' =>  $row['nama_kategori'],
                    'kode_kategori' =>  $row['kode_kategori'],
                    'kategori'      =>  $this->Barang_m->ambildata_kategori()->result(),
                    'harga'         =>  $row['harga'],
                    'stok'          =>  $row['stok'],
                ];
            }
            $msg    =   [
                'sukses' => $this->load->view('Barang/modaledit',$data, true)
            ];
            echo json_encode($msg);
        }
    }   

    public function updatedatabarang()
    {
        if ($this->input->is_ajax_request() == true) {
            $kode_barang    =   $this->input->post('kode_barang',true);
            $nama_barang    =   $this->input->post('nama_barang',true);
            $kategori       =   $this->input->post('kategori',true);
            $harga          =   $this->input->post('harga',true);
            $stok           =   $this->input->post('stok',true);

                $this->Barang_m->update_data_barang($kode_barang,$nama_barang,$kategori,$harga,$stok);
                    $msg    =   [
                        'sukses'    => 'Berhasil Diupdate !'
                    ];
            echo json_encode($msg);
        }
    }

    public function hapusdatabarang(){
        if ($this->input->is_ajax_request() == true) {
            $kode_barang  =   $this->input->post('kode_barang', true);
            $hapus          =   $this->Barang_m->hapus_data_barang($kode_barang);
            
            if($hapus){
                $msg    =   [
                    'sukses'    => 'Barang Berhasil Dihapus !'
                ];
            }
            echo json_encode($msg);
        }
    }
}