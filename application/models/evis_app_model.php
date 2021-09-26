<?php

class Evis_app_model extends CI_Model {
    
    public function select_all_book_info()
    {
        $sql = "SELECT COUNT(*) AS all_book FROM tbl_book WHERE book_availability='1' ";
        $query_result = $this->db->query($sql);
        $result=$query_result->row();
        return $result;
    }
    
    public function select_all_reader_info()
    {
        $sql = "SELECT COUNT(*) AS all_reader FROM tbl_reader WHERE reader_status='1' ";
        $query_result = $this->db->query($sql);
        $result=$query_result->row();
        return $result;
    }
    
    public function select_all_category_info()
    {
        $sql = "SELECT COUNT(*) AS all_category FROM tbl_category WHERE category_status='1' ";
        $query_result = $this->db->query($sql);
        $result=$query_result->row();
        return $result;
    }
    
    public function select_all_allocation_info()
    {
        $sql = "SELECT COUNT(*) AS all_allocation FROM tbl_allocate WHERE refund_status='0' ";
        $query_result = $this->db->query($sql);
        $result=$query_result->row();
        return $result;
    }

    public function save_admin_info($data)
    {
        $this->db->insert('tbl_admin',$data);
    }
    
    public function select_all_admin($per_page, $offset)
    {
        if ($offset == NULL) {
            $offset = 0;
        }
        $sql = "SELECT * FROM tbl_admin LIMIT $offset,$per_page ";
        $query_result = $this->db->query($sql);
        $result = $query_result->result();
        return $result;
    }
    
    public function deactive_admin_by_id($admin_id)
    {
        $this->db->set('admin_status',0);
        $this->db->where('admin_id',$admin_id);
        $this->db->update('tbl_admin');
    }
    
    public function active_admin_by_id($admin_id)
    {
        $this->db->set('admin_status',1);
        $this->db->where('admin_id',$admin_id);
        $this->db->update('tbl_admin');
    }
    
    public function select_admin_by_id($admin_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_admin');
        $this->db->where('admin_id',$admin_id);
        $query_result=$this->db->get();
        $result=$query_result->row();
        return $result;
    }
    
    public function update_admin_info()
    {
        $data=array();
        $data['name'] = $this->input->post('name', true);
        $data['address'] = $this->input->post('address', true);
        $data['location'] = $this->input->post('location', true);
        $data['mobile_number'] = $this->input->post('mobile_number', true);
        $data['email'] = $this->input->post('email', true);
        $data['password'] = $this->input->post('password', true);
        $data['status'] = $this->input->post('status', true);
        $admin_id=$this->input->post('admin_id',true);
        $this->db->where('admin_id',$admin_id);
        $this->db->update('tbl_admin',$data);
    }
    
    public function delete_admin_by_id($admin_id)
    {
        $this->db->where('admin_id',$admin_id);
        $this->db->delete('tbl_admin');
    }
    
    public function select_all_edit_category()
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('category_status',1);
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;
    }
    
    public function select_all_edit_author()
    {
        $this->db->select('*');
        $this->db->from('tbl_author');
        $this->db->where('author_status',1);
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;
    }
    
    public function select_all_edit_publisher()
    {
        $this->db->select('*');
        $this->db->from('tbl_publisher');
        $this->db->where('publisher_status',1);
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;
    }
    
    public function save_book_info($data)
    {
        $this->db->insert('tbl_book',$data);
    }
    
    public function select_all_book($per_page, $offset)
    {
        if ($offset == NULL) {
            $offset = 0;
        }
        $sql = "SELECT * FROM tbl_book AS b,tbl_category AS c,tbl_author AS a,tbl_publisher AS p WHERE b.category_id=c.category_id AND b.author_id=a.author_id AND b.publisher_id=p.publisher_id LIMIT $offset,$per_page ";
        $query_result = $this->db->query($sql);
        $result = $query_result->result();
        return $result;
    }
    
    public function search_book($text)
    {	
        $sql = "SELECT * FROM tbl_book AS b,tbl_category AS c,tbl_author AS a,tbl_publisher AS p WHERE b.category_id=c.category_id AND b.author_id=a.author_id AND b.publisher_id=p.publisher_id AND b.book_name LIKE '%$text%' ";
        $result = $this->db->query($sql)->result();
        return $result;
    }
    
    public function select_book_by_id($book_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_book');
        $this->db->where('book_id',$book_id);
        $query_result=$this->db->get();
        $result=$query_result->row();
        return $result;
    }

    public function update_book_info()
    {
        $data=array();
        $data['book_name'] = $this->input->post('book_name', true);
        $data['book_year'] = $this->input->post('book_year', true);
        $data['author_id'] = $this->input->post('author_id', true);
        $data['book_country'] = $this->input->post('book_country', true);
        $data['book_edition'] = $this->input->post('book_edition', true);
        $data['category_id'] = $this->input->post('category_id', true);
        $data['publisher_id'] = $this->input->post('publisher_id', true);
        $data['book_language'] = $this->input->post('book_language', true);
        $data['book_availability'] = $this->input->post('book_availability', true);
        $book_id=$this->input->post('book_id',true);
        $this->db->where('book_id',$book_id);
        $this->db->update('tbl_book',$data);
    }
    
    public function delete_book_by_id($book_id)
    {
        $this->db->where('book_id',$book_id);
        $this->db->delete('tbl_book');
    }
    
    public function save_category_info()
    {
        $data = array();
        $data['category_name'] = $this->input->post('category_name', true);
        $data['category_status'] = $this->input->post('category_status', true);
        $this->db->insert('tbl_category',$data);
    }
    
    public function select_all_category()
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;
    }
    
    public function deactive_category_by_id($category_id)
    {
        $this->db->set('category_status',0);
        $this->db->where('category_id',$category_id);
        $this->db->update('tbl_category');
    }
    
    public function active_category_by_id($category_id)
    {
        $this->db->set('category_status',1);
        $this->db->where('category_id',$category_id);
        $this->db->update('tbl_category');
    }
    
    public function select_category_by_id($category_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('category_id',$category_id);
        $query_result=$this->db->get();
        $result=$query_result->row();
        return $result;
    }
    
    public function update_category_info()
    {
        $data=array();
        $data['category_name'] = $this->input->post('category_name', true);
        $data['category_status'] = $this->input->post('category_status', true);
        $category_id=$this->input->post('category_id',true);
        $this->db->where('category_id',$category_id);
        $this->db->update('tbl_category',$data);
    }
    
    public function delete_category_by_id($category_id)
    {
        $this->db->where('category_id',$category_id);
        $this->db->delete('tbl_category');
    }
    
    public function save_author_info()
    {
        $data = array();
        $data['author_name'] = $this->input->post('author_name', true);
        $data['author_status'] = $this->input->post('author_status', true);
        $this->db->insert('tbl_author',$data);
    }
    
    public function select_all_author($per_page, $offset)
    {
        if ($offset == NULL) {
            $offset = 0;
        }
        $sql = "SELECT * FROM tbl_author LIMIT $offset,$per_page ";
        $query_result = $this->db->query($sql);
        $result = $query_result->result();
        return $result;
    }
    
    public function deactive_author_by_id($author_id)
    {
        $this->db->set('author_status',0);
        $this->db->where('author_id',$author_id);
        $this->db->update('tbl_author');
    }
    
    public function active_author_by_id($author_id)
    {
        $this->db->set('author_status',1);
        $this->db->where('author_id',$author_id);
        $this->db->update('tbl_author');
    }
    
    public function select_author_by_id($author_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_author');
        $this->db->where('author_id',$author_id);
        $query_result=$this->db->get();
        $result=$query_result->row();
        return $result;
    }
    
    public function update_author_info()
    {
        $data=array();
        $data['author_name'] = $this->input->post('author_name', true);
        $data['author_status'] = $this->input->post('author_status', true);
        $author_id=$this->input->post('author_id',true);
        $this->db->where('author_id',$author_id);
        $this->db->update('tbl_author',$data);
    }
    
    public function delete_author_by_id($author_id)
    {
        $this->db->where('author_id',$author_id);
        $this->db->delete('tbl_author');
    }
    
    public function save_publisher_info()
    {
        $data = array();
        $data['publisher_name'] = $this->input->post('publisher_name', true);
        $data['publisher_status'] = $this->input->post('publisher_status', true);
        $this->db->insert('tbl_publisher',$data);
    }
    
    public function select_all_publisher($per_page, $offset)
    {
        if ($offset == NULL) {
            $offset = 0;
        }
        $sql = "SELECT * FROM tbl_publisher LIMIT $offset,$per_page ";
        $query_result = $this->db->query($sql);
        $result = $query_result->result();
        return $result;
    }
    
    public function deactive_publisher_by_id($publisher_id)
    {
        $this->db->set('publisher_status',0);
        $this->db->where('publisher_id',$publisher_id);
        $this->db->update('tbl_publisher');
    }
    
    public function active_publisher_by_id($publisher_id)
    {
        $this->db->set('publisher_status',1);
        $this->db->where('publisher_id',$publisher_id);
        $this->db->update('tbl_publisher');
    }
    
    public function select_publisher_by_id($publisher_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_publisher');
        $this->db->where('publisher_id',$publisher_id);
        $query_result=$this->db->get();
        $result=$query_result->row();
        return $result;
    }
    
    public function update_publisher_info()
    {
        $data=array();
        $data['publisher_name'] = $this->input->post('publisher_name', true);
        $data['publisher_status'] = $this->input->post('publisher_status', true);
        $publisher_id=$this->input->post('publisher_id',true);
        $this->db->where('publisher_id',$publisher_id);
        $this->db->update('tbl_publisher',$data);
    }
    
    public function delete_publisher_by_id($publisher_id)
    {
        $this->db->where('publisher_id',$publisher_id);
        $this->db->delete('tbl_publisher');
    }
    
    public function save_reader_info()
    {
        $data = array();
        $data['reader_library_no'] = $this->input->post('reader_library_no', true);
        $data['reader_name'] = $this->input->post('reader_name', true);
        $data['reader_email'] = $this->input->post('reader_email', true);
        $data['reader_password'] = $this->input->post('reader_password', true);
        $data['reader_mobile'] = $this->input->post('reader_mobile', true);
        $data['reader_address'] = $this->input->post('reader_address', true);
        $data['reader_status'] = $this->input->post('reader_status', true);
        $this->db->insert('tbl_reader',$data);
    }
    
    public function select_all_reader($per_page, $offset)
    {
        if ($offset == NULL) {
            $offset = 0;
        }
        $sql = "SELECT * FROM tbl_reader LIMIT $offset,$per_page ";
        $query_result = $this->db->query($sql);
        $result = $query_result->result();
        return $result;
    }
    
    public function deactive_reader_by_id($reader_id)
    {
        $this->db->set('reader_status',0);
        $this->db->where('reader_id',$reader_id);
        $this->db->update('tbl_reader');
    }
    
    public function active_reader_by_id($reader_id)
    {
        $this->db->set('reader_status',1);
        $this->db->where('reader_id',$reader_id);
        $this->db->update('tbl_reader');
    }
    
    public function select_reader_by_id($reader_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_reader');
        $this->db->where('reader_id',$reader_id);
        $query_result=$this->db->get();
        $result=$query_result->row();
        return $result;
    }
    
    public function update_reader_info()
    {
        $data=array();
        $data['reader_library_no'] = $this->input->post('reader_library_no', true);
        $data['reader_name'] = $this->input->post('reader_name', true);
        $data['reader_email'] = $this->input->post('reader_email', true);
        $data['reader_password'] = $this->input->post('reader_password', true);
        $data['reader_mobile'] = $this->input->post('reader_mobile', true);
        $data['reader_address'] = $this->input->post('reader_address', true);
        $data['reader_status'] = $this->input->post('reader_status', true);
        $reader_id=$this->input->post('reader_id',true);
        $this->db->where('reader_id',$reader_id);
        $this->db->update('tbl_reader',$data);
    }
    
    public function delete_reader_by_id($reader_id)
    {
        $this->db->where('reader_id',$reader_id);
        $this->db->delete('tbl_reader');
    }
    
    public function select_all_edit_reader()
    {
        $this->db->select('*');
        $this->db->from('tbl_reader');
        $this->db->where('reader_status',1);
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;
    }
    
    public function select_all_edit_book()
    {
        $this->db->select('*');
        $this->db->from('tbl_book');
        $this->db->where('book_availability',1);
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;
    }
    
    public function save_allocate_info()
    {
        $data = array();
        $data['reader_id'] = $this->input->post('reader_id', true);
        $data['book_id'] = $this->input->post('book_id', true);
        $data['allocate_start_date'] = $this->input->post('allocate_start_date', true);
        $data['allocate_end_date'] = $this->input->post('allocate_end_date', true);
        $this->db->insert('tbl_allocate',$data);
    }
    
    public function select_all_allocate($per_page, $offset)
    {
        if ($offset == NULL) {
            $offset = 0;
        }
        $sql = "SELECT * FROM tbl_allocate AS a, tbl_reader AS r, tbl_book AS b WHERE r.reader_id=a.reader_id AND b.book_id=a.book_id LIMIT $offset,$per_page ";
        $query_result = $this->db->query($sql);
        $result = $query_result->result();
        return $result;
    }
    
    public function not_allocate_by_id($allocate_id)
    {
        $this->db->set('refund_status',0);
        $this->db->where('allocate_id',$allocate_id);
        $this->db->update('tbl_allocate');
    }
    
    public function done_allocate_by_id($allocate_id)
    {
        $this->db->set('refund_status',1);
        $this->db->where('allocate_id',$allocate_id);
        $this->db->update('tbl_allocate');
    }
    
    public function select_allocate_by_id($allocate_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_allocate');
        $this->db->where('allocate_id',$allocate_id);
        $query_result=$this->db->get();
        $result=$query_result->row();
        return $result;
    }
    
    public function update_allocate_info()
    {
        $data=array();
        $data['reader_id'] = $this->input->post('reader_id', true);
        $data['book_id'] = $this->input->post('book_id', true);
        $data['allocate_start_date'] = $this->input->post('allocate_start_date', true);
        $data['allocate_end_date'] = $this->input->post('allocate_end_date', true);
        $data['refund_status'] = $this->input->post('refund_status', true);
        $allocate_id=$this->input->post('allocate_id',true);
        $this->db->where('allocate_id',$allocate_id);
        $this->db->update('tbl_allocate',$data);
    }
    
    public function delete_allocate_by_id($allocate_id)
    {
        $this->db->where('allocate_id',$allocate_id);
        $this->db->delete('tbl_allocate');
    }
}