<?php

class DosenSOP extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        //cek login dan role
        is_logged_in();

        $this->load->model('M_dosensop');
    }

    public function index()
    {
        $sess['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $query = $this->M_dosensop->getSop();
        $data['sop'] = $query->result_array();

        $this->load->view('template/header', $sess);
        $this->load->view('dosen/sop/index', $data);
        $this->load->view('template/footer');
    }

    public function detail($id_sop)
    {
        //data dari session
        $sess['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $query = $this->M_dosensop->getSingleSop('id_sop', $id_sop);
        $data['sop'] = $query->row_array();

        $this->load->view('template/header', $sess);
        $this->load->view('dosen/sop/detail', $data);
        $this->load->view('template/footer');
    }
}
