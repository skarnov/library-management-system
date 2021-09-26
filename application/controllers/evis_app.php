<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Evis_app extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        $admin_id = $this->session->userdata('admin_id');
        if ($admin_id == NULL)
        {
            redirect('evis_login', 'refresh');
        }
    }

    public function index()
    {
        $data = array();
        $data['title'] = 'Evis App Dashboard';
        $data['book_info'] = $this->evis_app_model->select_all_book_info();
        $data['reader_info'] = $this->evis_app_model->select_all_reader_info();
        $data['category_info'] = $this->evis_app_model->select_all_category_info();
        $data['allocation_info'] = $this->evis_app_model->select_all_allocation_info();
        $data['dashboard'] = $this->load->view('dashboard', $data, true);
        $this->load->view('admin', $data);
    }
    
    public function logout() 
    {
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('admin_name');
        $sdata['exception'] = 'You are successfully Logout ';
        $this->session->set_userdata($sdata);
        redirect('evis_login');
    }
    
    public function add_admin() 
    {
        $data = array();
        $data['title'] = 'Add Admin';
        $data['dashboard'] = $this->load->view('add_admin', $data, true);
        $this->load->view('admin', $data);
    }
    
    public function save_admin() 
    {
        $this->form_validation->set_rules('admin_password', 'Password', 'trim|required|min_length[6]|max_length[250]|matches[conform_password]|xss_clean');
        $this->form_validation->set_rules('conform_password', 'Password Confirmation', 'trim|required');
        if ($this->form_validation->run() == False) 
        {
            $data = array();
            $data['title'] = 'Add Admin';
            $data['dashboard'] = $this->load->view('add_admin', $data, true);
            $this->load->view('admin', $data);
        } 
        else
        {
            $data = array();
            $data['admin_name'] = $this->input->post('admin_name', true);
            /**START IMAGE RESIZE**/
            $config['upload_path'] = 'img/admin_image/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10240';
            $config['max_width'] = '5000';
            $config['max_height'] = '5000';
            $error = '';
            $fdata = array();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('admin_image')) {
                $error = $this->upload->display_errors();
                echo $error;
                exit();
            } else {
                $fdata = $this->upload->data();
                $up['main'] = $config['upload_path'] . $fdata['file_name'];
            }
            $config['image_library'] = 'gd2';
            $config['new_image'] = 'img/admin_image/';
            $config['source_image'] = $up['main'];
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['overwrite'] = TRUE;
            $config['maintain_ratio'] = true;
            $config['width'] = '270';
            $config['height'] = '329';
            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            if (!$this->image_lib->resize()) {
                $error = $this->image_lib->display_errors();
                echo $error;
                exit();
            } else {
                $index = 'admin_image';
                $data[$index] = $config['new_image'] . $fdata['raw_name'] . '_thumb' . $fdata['file_ext'];
            }
            /**END IMAGE RESIZE**/
            $data['admin_email'] = $this->input->post('admin_email', true);
            $data['admin_password'] = $this->input->post('admin_password', true);
            $data['admin_level'] = $this->input->post('admin_level', true);
            $data['admin_status'] = $this->input->post('admin_status', true);
            $this->evis_app_model->save_admin_info($data);
            if ($data['admin_status'] == '1')
            {
                $sdata = array();
                $sdata['message'] = 'Admin Active';
                $this->session->set_userdata($sdata);
            }
            if ($data['admin_status'] == '0')
            {
                $sdata = array();
                $sdata['message'] = 'Admin Info Saved';
                $this->session->set_userdata($sdata);
            }
            redirect('evis_app/add_admin');
        }
    }
    
    public function manage_admin()
    {
        $data = array();
        $data['title'] = 'Manage Admin';
        $config['base_url'] = base_url() . 'evis_app/manage_admin/';
        $config['total_rows'] = $this->db->count_all('tbl_admin');
        $config['per_page'] = '8';
        /**STYLE PAGINATION**/
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /**END STYLE PAGINATION**/
        $this->pagination->initialize($config);
        $data['all_admin'] = $this->evis_app_model->select_all_admin($config['per_page'], $this->uri->segment(3));
        $data['dashboard'] = $this->load->view('manage_admin', $data, true);
        $this->load->view('admin', $data);
    }

    public function deactive_admin($admin_id)
    {
        $this->evis_app_model->deactive_admin_by_id($admin_id);
        redirect('evis_app/manage_admin');
    }

    public function active_admin($admin_id)
    {
        $this->evis_app_model->active_admin_by_id($admin_id);
        redirect('evis_app/manage_admin');
    }

    public function edit_admin($admin_id)
    {
        $data = array();
        $data['title'] = 'Edit Admin';
        $data['admin_info'] = $this->evis_app_model->select_admin_by_id($admin_id);
        $data['dashboard'] = $this->load->view('edit_admin', $data, true);
        $sdata = array();
        $sdata['message'] = 'Update Admin Information Successfully';
        $this->session->set_userdata($sdata);
        $this->load->view('admin', $data);
    }
    
    public function update_admin()
    {
        $this->evis_app_model->update_admin_info();
        redirect('evis_app/manage_admin');
    }

    public function delete_admin($admin_id) 
    {
        $this->evis_app_model->delete_admin_by_id($admin_id);
        redirect('evis_app/manage_admin');
    }
    
    public function add_book() 
    {
        $data = array();
        $data['title'] = 'Add Book';
        $data['all_category'] = $this->evis_app_model->select_all_edit_category();
        $data['all_author'] = $this->evis_app_model->select_all_edit_author();
        $data['all_publisher'] = $this->evis_app_model->select_all_edit_publisher();
        $data['dashboard'] = $this->load->view('add_book', $data, true);
        $this->load->view('admin', $data);
    }
    
    public function save_book() 
    {
        $data = array();
        $data['book_name'] = $this->input->post('book_name', true);
        $data['book_year'] = $this->input->post('book_year', true);
        $data['author_id'] = $this->input->post('author_id', true);
        /**START IMAGE RESIZE**/
        $config['upload_path'] = 'img/book_image/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '10240';
        $config['max_width'] = '5000';
        $config['max_height'] = '5000';
        $error = '';
        $fdata = array();
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('book_image')) {
            $error = $this->upload->display_errors();
            echo $error;
            exit();
        } else {
            $fdata = $this->upload->data();
            $up['main'] = $config['upload_path'] . $fdata['file_name'];
        }
        $config['image_library'] = 'gd2';
        $config['new_image'] = 'img/book_image/';
        $config['source_image'] = $up['main'];
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['overwrite'] = TRUE;
        $config['maintain_ratio'] = true;
        $config['width'] = '270';
        $config['height'] = '329';
        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        if (!$this->image_lib->resize()) {
            $error = $this->image_lib->display_errors();
            echo $error;
            exit();
        } else {
            $index = 'book_image';
            $data[$index] = $config['new_image'] . $fdata['raw_name'] . '_thumb' . $fdata['file_ext'];
        }
        /**END IMAGE RESIZE**/
        $data['book_country'] = $this->input->post('book_country', true);
        $data['book_edition'] = $this->input->post('book_edition', true);
        $data['category_id'] = $this->input->post('category_id', true);
        $data['publisher_id'] = $this->input->post('publisher_id', true);
        $data['book_language'] = $this->input->post('book_language', true);
        $data['book_availability'] = $this->input->post('book_availability', true);
        $this->evis_app_model->save_book_info($data);
        if ($data['book_availability'] == '1')
        {
            $sdata = array();
            $sdata['message'] = 'Book Published';
            $this->session->set_userdata($sdata);
        }
        if ($data['book_availability'] == '0')
        {
            $sdata = array();
            $sdata['message'] = 'Book Info Saved';
            $this->session->set_userdata($sdata);
        }
        redirect('evis_app/add_book');

    }
    
    public function manage_book()
    {
        $data = array();
        $data['title'] = 'Manage Book';
        $config['base_url'] = base_url() . 'evis_app/manage_book/';
        $config['total_rows'] = $this->db->count_all('tbl_book');
        $config['per_page'] = '8';
        /**STYLE PAGINATION**/
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /**END STYLE PAGINATION**/
        $this->pagination->initialize($config);
        $data['all_book'] = $this->evis_app_model->select_all_book($config['per_page'], $this->uri->segment(3));
        $data['dashboard'] = $this->load->view('manage_book', $data, true);
        $this->load->view('admin', $data);
    }
    
    public function book_search()
    {
        $text = $this->input->post('text', true);
        $data = array();
        $data['title'] = 'Book Search';
        $data['search_book'] = $this->evis_app_model->search_book($text);
        $data['dashboard'] = $this->load->view('search_book', $data, true);
        $this->load->view('admin', $data); 
    }

    public function view_book($book_id,$category_name,$author_name,$publisher_name)
    {
        $data = array();
        $data['title'] = 'View Book';
        $data['category_name'] = $category_name;
        $data['author_name'] = $author_name;
        $data['publisher_name'] = $publisher_name;
        $data['book_info'] = $this->evis_app_model->select_book_by_id($book_id);
        $data['dashboard'] = $this->load->view('view_book', $data, true);
        $this->load->view('admin', $data);
    }

    public function edit_book($book_id)
    {
        $data = array();
        $data['title'] = 'Edit Book';
        $data['all_category'] = $this->evis_app_model->select_all_edit_category();
        $data['all_author'] = $this->evis_app_model->select_all_edit_author();
        $data['all_publisher'] = $this->evis_app_model->select_all_edit_publisher();
        $data['book_info'] = $this->evis_app_model->select_book_by_id($book_id);
        $data['dashboard'] = $this->load->view('edit_book', $data, true);
        $sdata = array();
        $sdata['message'] = 'Update Book Information Successfully';
        $this->session->set_userdata($sdata);
        $this->load->view('admin', $data);
    }
    
    public function update_book()
    {
        $this->evis_app_model->update_book_info();
        redirect('evis_app/manage_book');
    }

    public function delete_book($book_id) 
    {
        $this->evis_app_model->delete_book_by_id($book_id);
        redirect('evis_app/manage_book');
    }
    
    public function add_category() 
    {
        $data = array();
        $data['title'] = 'Add Category';
        $data['dashboard'] = $this->load->view('add_category', $data, true);
        $this->load->view('admin', $data);
    }
    
    public function save_category() 
    {
        $this->evis_app_model->save_category_info();
        $sdata = array();
        $sdata['message'] = 'Category Saved';
        $this->session->set_userdata($sdata);
        redirect('evis_app/add_category');
    }
    
    public function manage_category()
    {
        $data = array();
        $data['title'] = 'Manage Category';
        $config['base_url'] = base_url() . 'evis_app/manage_category/';
        $config['total_rows'] = $this->db->count_all('tbl_category');
        $config['per_page'] = '8';
        /**STYLE PAGINATION**/
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /**END STYLE PAGINATION**/
        $this->pagination->initialize($config);
        $data['all_category'] = $this->evis_app_model->select_all_category($config['per_page'], $this->uri->segment(3));
        $data['dashboard'] = $this->load->view('manage_category', $data, true);
        $this->load->view('admin', $data);
    }

    public function deactive_category($category_id)
    {
        $this->evis_app_model->deactive_category_by_id($category_id);
        redirect('evis_app/manage_category');
    }

    public function active_category($category_id)
    {
        $this->evis_app_model->active_category_by_id($category_id);
        redirect('evis_app/manage_category');
    }

    public function edit_category($category_id)
    {
        $data = array();
        $data['title'] = 'Edit Category';
        $data['category_info'] = $this->evis_app_model->select_category_by_id($category_id);
        $data['dashboard'] = $this->load->view('edit_category', $data, true);
        $sdata = array();
        $sdata['message'] = 'Update Category Information Successfully';
        $this->session->set_userdata($sdata);
        $this->load->view('admin', $data);
    }
    
    public function update_category()
    {
        $this->evis_app_model->update_category_info();
        redirect('evis_app/manage_category');
    }

    public function delete_category($category_id) 
    {
        $this->evis_app_model->delete_category_by_id($category_id);
        redirect('evis_app/manage_category');
    }

    public function add_author() 
    {
        $data = array();
        $data['title'] = 'Add Author';
        $data['dashboard'] = $this->load->view('add_author', $data, true);
        $this->load->view('admin', $data);
    }
    
    public function save_author() 
    {
        $this->evis_app_model->save_author_info();
        $sdata = array();
        $sdata['message'] = 'Author Saved';
        $this->session->set_userdata($sdata);
        redirect('evis_app/add_author');
    }
    
    public function manage_author()
    {
        $data = array();
        $data['title'] = 'Manage Author';
        $config['base_url'] = base_url() . 'evis_app/manage_author/';
        $config['total_rows'] = $this->db->count_all('tbl_author');
        $config['per_page'] = '8';
        /**STYLE PAGINATION**/
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /**END STYLE PAGINATION**/
        $this->pagination->initialize($config);
        $data['all_author'] = $this->evis_app_model->select_all_author($config['per_page'], $this->uri->segment(3));
        $data['dashboard'] = $this->load->view('manage_author', $data, true);
        $this->load->view('admin', $data);
    }

    public function deactive_author($author_id)
    {
        $this->evis_app_model->deactive_author_by_id($author_id);
        redirect('evis_app/manage_author');
    }

    public function active_author($author_id)
    {
        $this->evis_app_model->active_author_by_id($author_id);
        redirect('evis_app/manage_author');
    }

    public function edit_author($author_id)
    {
        $data = array();
        $data['title'] = 'Edit Author';
        $data['author_info'] = $this->evis_app_model->select_author_by_id($author_id);
        $data['dashboard'] = $this->load->view('edit_author', $data, true);
        $sdata = array();
        $sdata['message'] = 'Update Author Information Successfully';
        $this->session->set_userdata($sdata);
        $this->load->view('admin', $data);
    }
    
    public function update_author()
    {
        $this->evis_app_model->update_author_info();
        redirect('evis_app/manage_author');
    }

    public function delete_author($author_id) 
    {
        $this->evis_app_model->delete_author_by_id($author_id);
        redirect('evis_app/manage_author');
    }
   
    public function add_publisher() 
    {
        $data = array();
        $data['title'] = 'Add Publisher';
        $data['dashboard'] = $this->load->view('add_publisher', $data, true);
        $this->load->view('admin', $data);
    }
    
    public function save_publisher() 
    {
        $this->evis_app_model->save_publisher_info();
        $sdata = array();
        $sdata['message'] = 'Publisher Saved';
        $this->session->set_userdata($sdata);
        redirect('evis_app/add_publisher');
    }
    
    public function manage_publisher()
    {
        $data = array();
        $data['title'] = 'Manage Publisher';
        $config['base_url'] = base_url() . 'evis_app/manage_publisher/';
        $config['total_rows'] = $this->db->count_all('tbl_publisher');
        $config['per_page'] = '8';
        /**STYLE PAGINATION**/
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /**END STYLE PAGINATION**/
        $this->pagination->initialize($config);
        $data['all_publisher'] = $this->evis_app_model->select_all_publisher($config['per_page'], $this->uri->segment(3));
        $data['dashboard'] = $this->load->view('manage_publisher', $data, true);
        $this->load->view('admin', $data);
    }

    public function deactive_publisher($publisher_id)
    {
        $this->evis_app_model->deactive_publisher_by_id($publisher_id);
        redirect('evis_app/manage_publisher');
    }

    public function active_publisher($publisher_id)
    {
        $this->evis_app_model->active_publisher_by_id($publisher_id);
        redirect('evis_app/manage_publisher');
    }

    public function edit_publisher($publisher_id)
    {
        $data = array();
        $data['title'] = 'Edit Publisher';
        $data['publisher_info'] = $this->evis_app_model->select_publisher_by_id($publisher_id);
        $data['dashboard'] = $this->load->view('edit_publisher', $data, true);
        $sdata = array();
        $sdata['message'] = 'Update Publisher Information Successfully';
        $this->session->set_userdata($sdata);
        $this->load->view('admin', $data);
    }
    
    public function update_publisher()
    {
        $this->evis_app_model->update_publisher_info();
        redirect('evis_app/manage_publisher');
    }

    public function delete_publisher($publisher_id) 
    {
        $this->evis_app_model->delete_publisher_by_id($publisher_id);
        redirect('evis_app/manage_publisher');
    }
    
    public function add_reader() 
    {
        $data = array();
        $data['title'] = 'Add Reader';
        $data['dashboard'] = $this->load->view('add_reader', $data, true);
        $this->load->view('admin', $data);
    }
    
    public function save_reader() 
    {
        $this->evis_app_model->save_reader_info();
        $sdata = array();
        $sdata['message'] = 'Reader Saved';
        $this->session->set_userdata($sdata);
        redirect('evis_app/add_reader');
    }
    
    public function manage_reader()
    {
        $data = array();
        $data['title'] = 'Manage Reader';
        $config['base_url'] = base_url() . 'evis_app/manage_reader/';
        $config['total_rows'] = $this->db->count_all('tbl_reader');
        $config['per_page'] = '8';
        /**STYLE PAGINATION**/
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /**END STYLE PAGINATION**/
        $this->pagination->initialize($config);
        $data['all_reader'] = $this->evis_app_model->select_all_reader($config['per_page'], $this->uri->segment(3));
        $data['dashboard'] = $this->load->view('manage_reader', $data, true);
        $this->load->view('admin', $data);
    }

    public function deactive_reader($reader_id)
    {
        $this->evis_app_model->deactive_reader_by_id($reader_id);
        redirect('evis_app/manage_reader');
    }

    public function active_reader($reader_id)
    {
        $this->evis_app_model->active_reader_by_id($reader_id);
        redirect('evis_app/manage_reader');
    }

    public function edit_reader($reader_id)
    {
        $data = array();
        $data['title'] = 'Edit Reader';
        $data['reader_info'] = $this->evis_app_model->select_reader_by_id($reader_id);
        $data['dashboard'] = $this->load->view('edit_reader', $data, true);
        $sdata = array();
        $sdata['message'] = 'Update Reader Information Successfully';
        $this->session->set_userdata($sdata);
        $this->load->view('admin', $data);
    }
    
    public function update_reader()
    {
        $this->evis_app_model->update_reader_info();
        redirect('evis_app/manage_reader');
    }

    public function delete_reader($reader_id) 
    {
        $this->evis_app_model->delete_reader_by_id($reader_id);
        redirect('evis_app/manage_reader');
    }

    public function add_allocate() 
    {
        $data = array();
        $data['title'] = 'Add Allocate';
        $data['all_reader'] = $this->evis_app_model->select_all_edit_reader();
        $data['all_book'] = $this->evis_app_model->select_all_edit_book();
        $data['dashboard'] = $this->load->view('add_allocate', $data, true);
        $this->load->view('admin', $data);
    }
    
    public function save_allocate() 
    {
        $this->evis_app_model->save_allocate_info();
        $sdata = array();
        $sdata['message'] = 'Allocate Saved';
        $this->session->set_userdata($sdata);
        redirect('evis_app/add_allocate');
    }
    
    public function manage_allocation()
    {
        $data = array();
        $data['title'] = 'Manage Allocate';
        $config['base_url'] = base_url() . 'evis_app/manage_allocate/';
        $config['total_rows'] = $this->db->count_all('tbl_allocate');
        $config['per_page'] = '8';
        /**STYLE PAGINATION**/
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /**END STYLE PAGINATION**/
        $this->pagination->initialize($config);
        $data['all_allocate'] = $this->evis_app_model->select_all_allocate($config['per_page'], $this->uri->segment(3));
        $data['dashboard'] = $this->load->view('manage_allocate', $data, true);
        $this->load->view('admin', $data);
    }
    
    public function not_allocate($reader_id)
    {
        $this->evis_app_model->not_allocate_by_id($reader_id);
        redirect('evis_app/manage_allocation');
    }

    public function done_allocate($reader_id)
    {
        $this->evis_app_model->done_allocate_by_id($reader_id);
        redirect('evis_app/manage_allocation');
    }

    public function edit_allocate($allocate_id)
    {
        $data = array();
        $data['title'] = 'Edit Allocate';
        $data['all_reader'] = $this->evis_app_model->select_all_edit_reader();
        $data['all_book'] = $this->evis_app_model->select_all_edit_book();
        $data['allocate_info'] = $this->evis_app_model->select_allocate_by_id($allocate_id);
        $data['dashboard'] = $this->load->view('edit_allocate', $data, true);
        $sdata = array();
        $sdata['message'] = 'Update Allocate Information Successfully';
        $this->session->set_userdata($sdata);
        $this->load->view('admin', $data);
    }
    
    public function update_allocate()
    {
        $this->evis_app_model->update_allocate_info();
        redirect('evis_app/manage_allocation');
    }

    public function delete_allocate($allocate_id) 
    {
        $this->evis_app_model->delete_allocate_by_id($allocate_id);
        redirect('evis_app/manage_allocation');
    }
    
    public function licence() 
    {
        $data = array();
        $data['title'] = 'Licence';
        $data['dashboard'] = $this->load->view('licence', $data, true);
        $this->load->view('admin', $data);
    }
    
    public function about() 
    {
        $data = array();
        $data['title'] = 'About';
        $data['dashboard'] = $this->load->view('about', $data, true);
        $this->load->view('admin', $data);
    }
}