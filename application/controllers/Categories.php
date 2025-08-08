<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('category_model');
    }
    
    // Halaman manajemen kategori
    public function index() {
        $data['title'] = 'Manage Categories';
        $data['categories'] = $this->category_model->get_categories_with_count();
        
        $this->load->view('templates/header', $data);
        $this->load->view('categories/index', $data);
        $this->load->view('templates/footer');
    }
    
    // Tambah kategori (AJAX)
    public function create() {
        $this->form_validation->set_rules('name', 'Category Name', 'required|min_length[2]');
        
        if ($this->form_validation->run() === TRUE) {
            $data = array(
                'name' => $this->input->post('name'),
                'color' => $this->input->post('color')
            );
            
            if ($this->category_model->create_category($data)) {
                $this->session->set_flashdata('success', 'Category created successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to create category.');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
        }
        
        redirect('categories');
    }
    
    // Hapus kategori
    public function delete($id = NULL) {
        if ($id === NULL) {
            show_404();
        }
        
        if ($this->category_model->delete_category($id)) {
            $this->session->set_flashdata('success', 'Category deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete category.');
        }
        
        redirect('categories');
    }
}
