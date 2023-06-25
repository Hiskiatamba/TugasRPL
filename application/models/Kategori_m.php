<?php
class Kategori_m extends CI_Model
{
    var $table = 'kategori'; //nama tabel dari database
    var $column_order = array(null,'kode_kategori','nama_kategori',null); //Sesuaikan dengan field
    var $column_search = array('kode_kategori','nama_kategori'); //field yang diizin untuk pencarian 
    var $order = array('' => 'asc'); // default order 

    private function _get_datatables_query()
    {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function simpandatakategori($kode_kategori,$nama_kategori){
        $simpan =   [
            'kode_kategori' => $kode_kategori,
            'nama_kategori' => $nama_kategori
        ];
        $this->db->insert('kategori',$simpan);
    }

    public function ambildata($kode_kategori){
        return $this->db->get_where('kategori',['kode_kategori' => $kode_kategori]);
    }

    public function update_data_kategori($kode_kategori,$nama_kategori){
        $simpan =   [
            'nama_kategori' => $nama_kategori
        ];
        $this->db->where('kode_kategori', $kode_kategori);
        $this->db->update('kategori',$simpan);
    }

    public function hapus_data_kategori($kode_kategori){
        return $this->db->delete('kategori',['kode_kategori' => $kode_kategori]);
    }
}