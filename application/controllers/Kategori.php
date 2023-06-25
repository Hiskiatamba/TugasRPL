<?php
class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_m');
    }
    public function index()
    {
        $data['admin']   =   $this->db->get_where('admin', ['username_admin' => $this->session->userdata('username_admin')])->row_array();
        if ($this->session->userdata('username_admin') == null) {
            redirect('Admin/login');
        } else {
            $this->load->view('Kategori/tampildata', $data);
        }
    }

    public function ambildata()
    {
        if ($this->input->is_ajax_request() == true) {
            $this->load->model('Kategori_m', 'kategori');
            $list = $this->kategori->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = array();
                // Membuat Tombol Edit Dan Delete
                $tomboledit = "<button id=\"tomboledit\" type=\"button\" class=\"btn btn-outline-info\" tittle=\"Edit Data\" onclick=\"edit('" . $field->kode_kategori . "')\" ><i class=\"fas fa-tags\" ></i></button>";
                $tombolhapus = "<button id=\"tombolhapus\" type=\"button\" class=\"btn btn-outline-danger\" tittle=\"Hapus Data\" onclick=\"hapus('" . $field->kode_kategori . "')\" ><i class=\"fas fa-trash\" ></i></button>";
                $row[] = $no;
                $row[] = $field->kode_kategori;
                $row[] = $field->nama_kategori;
                $row[] = $tomboledit . ' ' . $tombolhapus;
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->kategori->count_all(),
                "recordsFiltered" => $this->kategori->count_filtered(),
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
            $msg    =   [
                'sukses' => $this->load->view('Kategori/modaltambah', '', true)
            ];
            echo json_encode($msg);
        }
    }

    public function simpandatakategori()
    {
        if ($this->input->is_ajax_request() == true) {
            $kode_kategori  =   $this->input->post('kode_kategori', true);
            $nama_kategori  =   $this->input->post('nama_kategori', true);

            $this->form_validation->set_rules(
                'kode_kategori',
                'Kode Kategori',
                'trim|required|is_unique[kategori.kode_kategori]',
                [
                    'required'  => 'Kode Kategori Tidak Boleh Kosong !',
                    'is_unique' => 'Kode Kategori Sudah Ada !'
                ]
            );

            $this->form_validation->set_rules(
                'nama_kategori',
                'Nama Kategori',
                'trim|required',
                [
                    'required'  => 'Nama Kategori Tidak Boleh Kosong !'
                ]
            );

            if ($this->form_validation->run() == true) {
                $this->Kategori_m->simpandatakategori($kode_kategori, $nama_kategori);
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

    public function formedit()
    {
        if ($this->input->is_ajax_request() == true) {
            $kode_kategori  =   $this->input->post('kode_kategori', true);
            $ambildata      =   $this->Kategori_m->ambildata($kode_kategori);

            if ($ambildata->num_rows() > 0) {
                $row    =   $ambildata->row_array();
                $data   =   [
                    'kode_kategori' =>  $kode_kategori,
                    'nama_kategori' =>  $row['nama_kategori']
                ];
            }
            $msg    =   [
                'sukses' => $this->load->view('Kategori/modaledit', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedatakategori()
    {
        if ($this->input->is_ajax_request() == true) {
            $kode_kategori  =   $this->input->post('kode_kategori', true);
            $nama_kategori  =   $this->input->post('nama_kategori', true);

            $this->Kategori_m->update_data_kategori($kode_kategori, $nama_kategori);
            $msg    =   [
                'sukses'    => 'Berhasil Diupdate !'
            ];
            echo json_encode($msg);
        }
    }

    public function hapusdatakategori()
    {
        if ($this->input->is_ajax_request() == true) {
            $kode_kategori  =   $this->input->post('kode_kategori', true);
            $hapus          =   $this->Kategori_m->hapus_data_kategori($kode_kategori);

            if ($hapus) {
                $msg    =   [
                    'sukses'    => 'Kategori Berhasil Dihapus !'
                ];
            }
            echo json_encode($msg);
        }
    }
}
