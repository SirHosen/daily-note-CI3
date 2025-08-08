<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
    
    private $table = 'categories';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Ambil semua kategori
    public function get_all_categories() {
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    
    // Ambil kategori dengan jumlah catatan
    public function get_categories_with_count() {
        $this->db->select('categories.*, COUNT(notes.id) as note_count');
        $this->db->from($this->table);
        $this->db->join('notes', 'notes.category_id = categories.id', 'left');
        $this->db->group_by('categories.id');
        $this->db->order_by('categories.name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    // Tambah kategori
    public function create_category($data) {
        return $this->db->insert($this->table, $data);
    }
    
    // Update kategori
    public function update_category($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    
    // Hapus kategori
    public function delete_category($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}
