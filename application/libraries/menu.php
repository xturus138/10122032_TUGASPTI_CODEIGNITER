<?php if (!defined('BASEPATH'))
    exit('No direct script access
allowed');

class Menu
{
    var $CI = NULL;
    function __construct()
    {
        // get CI's object
        $this->CI =& get_instance();
    }
    function tampil_sidebar()
    {
        // load model 'usermodel'
        $this->CI->load->model('usermodel');
        // level untuk user ini
        $level = $this->CI->session->userdata('level');
        // ambil menu dari database sesuai dengan level
        $data['menu'] = $this->CI->usermodel->get_menu_for_level($level);
        $data['level'] = $this->CI->session->userdata('level');
        // tampilkan halaman dashboard dengan data menu
        $this->CI->load->view('sidebar-nav', $data);
    }

}