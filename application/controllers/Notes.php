<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('note_model');
        $this->load->model('category_model');
    }
    
    // Halaman utama - list semua catatan
    public function index() {
        $data['title'] = 'My Notes';
        $data['notes'] = $this->note_model->get_all_notes();
        $data['categories'] = $this->category_model->get_categories_with_count();
        
        $this->load->view('templates/header', $data);
        $this->load->view('notes/index', $data);
        $this->load->view('templates/footer');
    }
    
    // Form tambah catatan
    public function create() {
        $data['title'] = 'Create New Note';
        $data['categories'] = $this->category_model->get_all_categories();
        
        $this->form_validation->set_rules('title', 'Title', 'required|min_length[3]');
        $this->form_validation->set_rules('content', 'Content', 'required|min_length[10]');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('notes/create', $data);
            $this->load->view('templates/footer');
        } else {
            $note_data = array(
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
                'category_id' => $this->input->post('category_id'),
                'is_important' => $this->input->post('is_important') ? 1 : 0
            );
            
            if ($this->note_model->create_note($note_data)) {
                $this->session->set_flashdata('success', 'Note created successfully!');
                redirect('notes');
            } else {
                $this->session->set_flashdata('error', 'Failed to create note.');
                redirect('notes/create');
            }
        }
    }
    
    // Lihat detail catatan
    public function view($id = NULL) {
        if ($id === NULL) {
            show_404();
        }
        
        $data['note'] = $this->note_model->get_note($id);
        
        if (empty($data['note'])) {
            show_404();
        }
        
        $data['title'] = $data['note']['title'];
        
        $this->load->view('templates/header', $data);
        $this->load->view('notes/view', $data);
        $this->load->view('templates/footer');
    }
    
    // Form edit catatan
    public function edit($id = NULL) {
        if ($id === NULL) {
            show_404();
        }
        
        $data['note'] = $this->note_model->get_note($id);
        
        if (empty($data['note'])) {
            show_404();
        }
        
        $data['title'] = 'Edit Note';
        $data['categories'] = $this->category_model->get_all_categories();
        
        $this->form_validation->set_rules('title', 'Title', 'required|min_length[3]');
        $this->form_validation->set_rules('content', 'Content', 'required|min_length[10]');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('notes/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $note_data = array(
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
                'category_id' => $this->input->post('category_id'),
                'is_important' => $this->input->post('is_important') ? 1 : 0
            );
            
            if ($this->note_model->update_note($id, $note_data)) {
                $this->session->set_flashdata('success', 'Note updated successfully!');
                redirect('notes/view/'.$id);
            } else {
                $this->session->set_flashdata('error', 'Failed to update note.');
                redirect('notes/edit/'.$id);
            }
        }
    }
    
    // Hapus catatan
    public function delete($id = NULL) {
        if ($id === NULL) {
            show_404();
        }
        
        if ($this->note_model->delete_note($id)) {
            $this->session->set_flashdata('success', 'Note deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete note.');
        }
        
        redirect('notes');
    }
    
    // Cari catatan
    public function search() {
        $keyword = $this->input->get('q');
        
        if ($keyword) {
            $data['notes'] = $this->note_model->search_notes($keyword);
            $data['search_term'] = $keyword;
        } else {
            $data['notes'] = array();
            $data['search_term'] = '';
        }
        
        $data['title'] = 'Search Results';
        $data['categories'] = $this->category_model->get_categories_with_count();
        
        $this->load->view('templates/header', $data);
        $this->load->view('notes/search', $data);
        $this->load->view('templates/footer');
    }
    
    // Filter berdasarkan kategori
    public function category($category_id = NULL) {
        if ($category_id === NULL) {
            redirect('notes');
        }
        
        $data['notes'] = $this->note_model->get_notes_by_category($category_id);
        $data['categories'] = $this->category_model->get_categories_with_count();
        $data['title'] = 'Notes by Category';
        
        $this->load->view('templates/header', $data);
        $this->load->view('notes/index', $data);
        $this->load->view('templates/footer');
    }
    
    // Toggle status penting
    public function toggle_important($id = NULL) {
        if ($id === NULL) {
            show_404();
        }
        
        if ($this->note_model->toggle_important($id)) {
            $this->session->set_flashdata('success', 'Note status updated!');
        } else {
            $this->session->set_flashdata('error', 'Failed to update status.');
        }
        
        redirect($this->input->server('HTTP_REFERER'));
    }
}
