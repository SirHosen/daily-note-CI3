<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Note_model extends CI_Model {
    
    private $table = 'notes';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Ambil semua catatan dengan kategori
    public function get_all_notes($limit = null, $offset = null) {
        $this->db->select('notes.*, categories.name as category_name, categories.color as category_color');
        $this->db->from($this->table);
        $this->db->join('categories', 'categories.id = notes.category_id', 'left');
        $this->db->order_by('notes.created_at', 'DESC');
        
        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    // Ambil catatan berdasarkan ID
    public function get_note($id) {
        $this->db->select('notes.*, categories.name as category_name');
        $this->db->from($this->table);
        $this->db->join('categories', 'categories.id = notes.category_id', 'left');
        $this->db->where('notes.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    // Tambah catatan baru
    public function create_note($data) {
        return $this->db->insert($this->table, $data);
    }
    
    // Update catatan
    public function update_note($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    
    // Hapus catatan
    public function delete_note($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
    
    // Cari catatan
    public function search_notes($keyword) {
        $this->db->select('notes.*, categories.name as category_name, categories.color as category_color');
        $this->db->from($this->table);
        $this->db->join('categories', 'categories.id = notes.category_id', 'left');
        $this->db->like('notes.title', $keyword);
        $this->db->or_like('notes.content', $keyword);
        $this->db->order_by('notes.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    // Ambil catatan berdasarkan kategori
    public function get_notes_by_category($category_id) {
        $this->db->select('notes.*, categories.name as category_name, categories.color as category_color');
        $this->db->from($this->table);
        $this->db->join('categories', 'categories.id = notes.category_id', 'left');
        $this->db->where('notes.category_id', $category_id);
        $this->db->order_by('notes.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    // Hitung total catatan
    public function count_notes() {
        return $this->db->count_all($this->table);
    }
    
    // Toggle status penting
    public function toggle_important($id) {
        $this->db->set('is_important', '1-is_important', FALSE);
        $this->db->where('id', $id);
        return $this->db->update($this->table);
    }
}
