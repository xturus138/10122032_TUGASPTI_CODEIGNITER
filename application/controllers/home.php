<?php if (!defined('BASEPATH'))
    exit('No direct script access
allowed');
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    // Default controller
    public function index()
    {
        // Apakah user sudah login?
        if ($this->auth->is_logged_in() == false) {
            // Jika belum arahkan ke form login.
            $this->signin();
        } else {
            // Jika sudah, tampilkan halaman web sesuai hak akses.
            $this->menu->tampil_sidebar();
            // Untuk kebutuhan widget di dashboard
            $this->load->model('usermodel');
            $data['user1'] = $this->usermodel->select_all(1);
            $data['user2'] = $this->usermodel->select_all(2);
            $this->load->view('main_page', $data);
        }
    }
    public function signin()
    {
        $this->load->view('login_form');
    }
    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $success = $this->auth->do_login($username, $password);
        if ($success) {
            // lemparkan ke halaman index user
            redirect(site_url('dashboard'));
        } else {
            $data['login_info'] = "Username atau password salah. Silahkan
masukkan kombinasi yang benar!";
            $this->load->view('login_form', $data);
        }
    }
    function logout()
    {
        if ($this->auth->is_logged_in() == true) {
            // jika dia memang sudah login, destroy session
            $this->auth->do_logout();
        }
        // larikan ke halaman utama
        redirect('login');
    }
}