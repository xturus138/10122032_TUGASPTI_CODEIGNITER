<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Newitem extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('item_model');
    }
    public function index()
    {
        // mencegah user yang belum login untuk mengakses halaman ini
        $this->auth->restrict();

        $this->auth->cek_menu(2);
        $data['daftar_item'] = $this->item_model->select_all()->result();
        $this->menu->tampil_sidebar();
        $this->load->view('new-item', $data);
    }


    // Pagination Table
    public function lihat_item_paging($offset = 0)
    {
        // tentukan jumlah data per halaman
        $perpage = 10;
        // load library pagination
        $this->load->library('pagination');
        // konfigurasi tampilan paging
        $config = array(
            'base_url' => site_url('newitem/lihat_item_paging'),
            'total_rows' => count($this->item_model->select_all()->result()),
            'per_page' => $perpage,
        );
        // inisialisasi pagination dan config
        $this->pagination->initialize($config);
        $limit['perpage'] = $perpage;
        $limit['offset'] = $offset;
        $data['daftar_item'] = $this->item_model->select_all_paging($limit)->result();
        $this->load->view('t-new-item', $data);
    }
    public function lihat_item()
    {
        $data['daftar_item'] = $this->item_model->select_all()->result();
        $this->load->view('t-new-item', $data);
    }
    public function proses_item()
    {
        $method = $this->input->post("method");
        $item = new stdClass();
        if ($method == 'create') {
            $data['kd_model'] = $this->input->post('kd_model');
            $data['nama_model'] = $this->input->post('nama_model');
            $data['deskripsi'] = $this->input->post('deskripsi');
            $kd_model = $this->item_model->insert_item($data);
            $data['kd_model'] = $kd_model;
            $item = $data;
        } else {
            $data['nama_model'] = $this->input->post('nama_model');
            $data['deskripsi'] = $this->input->post('deskripsi');
            $kd_model = $this->input->post('kd_model');
            $this->item_model->update_item($kd_model, $data);
            $data['kd_model'] = $kd_model;
            $item = $data;
        }
        echo json_encode([
            'item' => $item
        ]);
        exit(0);
    }
    public function show_item()
    {

        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $kd_model = $this->input->post("kode");
            $item = $this->item_model->select_by_id($kd_model)->row();
            http_response_code(200);
            echo json_encode([
                'item' => $item,
            ]);
            exit(0);
        }
    }
    public function edit_item($kd_model)
    {
        $data['daftar_item'] = $this->item_model->select_by_id($kd_model)->row();
        $this->load->view('edit_item', $data);
    }
    public function proses_edit_item()
    {
        $data['nama_model'] = $this->input->post('nama_model');
        $data['deskripsi'] = $this->input->post('deskripsi');
        $kd_model = $this->input->post('kd_model');
        $this->item_model->update_item($kd_model, $data);
        redirect(site_url('newitem'));
    }
    public function delete_item($kd_model)
    {
        $this->item_model->delete_item($kd_model);
        redirect(site_url('newitem'));
    }
    // proses untuk mencari item
    public function proses_cari_item()
    {
        $kd_model = $this->input->post('kd_model');
        $data['daftar_item'] = $this->item_model->select_by_kode($kd_model)->result();
        $this->load->view('t-new-item', $data);
    }
}
/* End of file new-item.php */
/* Location: ./application/controllers/new-item.php */