<?php

class Admin extends CI_Controller
{
    var $menu = array();

    function __construct()
    {
        parent::__construct();

        $this->is_logged_in_admin();

        $this->load->library('form_validation');

        $this->menu = array(
                        array(
                            'icon'  => '',
                            'url'   => 'admin',
                            'label' => 'Verzeichnis',
                            'attr'  => array(
                                        'tabindex' => '-1'
                            )
                        ),
                        array(
                            'icon'  => '',
                            'url'   => 'admin/add_contact',
                            'label' => 'Kontakt hinzufügen',
                            'attr'  => array(
                                        'tabindex' => '-1'
                            )
                        ),
                        array(
                            'icon'  => '',
                            'url'   => 'admin/users',
                            'label' => 'Benutzer',
                            'attr'  => array(
                                        'tabindex' => '-1'
                            )
                        ),
                        array(
                            'icon'  => '',
                            'url'   => 'admin/add_user',
                            'label' => 'Benutzer hinzufügen',
                            'attr'  => array(
                                'tabindex' => '-1'
                            )
                        ),
                        array(
                            'icon'  => '',
                            'url'   => 'admin/export/users',
                            'label' => 'Export Users',
                            'attr'  => array(
                                'tabindex' => '-1'
                            )
                        ),
                        array(
                            'icon'  => '',
                            'url'   => 'admin/export/contact_list',
                            'label' => 'Export Contacts',
                            'attr'  => array(
                                'tabindex' => '-1'
                            )
                        )

        );

    }

    function is_logged_in_admin(){

        $is_logged_in = $this->session->userdata('is_logged_in');
        $is_admin = $this->session->userdata('user_type');

        if($is_logged_in && 'admin' != $is_admin){

            $notify = notify('Error:','Please login as Administrator access your page request.');
            $this->session->set_flashdata('notify', $notify);
            //$this->session->sess_destroy();
            redirect($this->session->userdata('user_type'));
        }
        if(!isset($is_logged_in) || $is_logged_in != TRUE ){
            $this->session->set_userdata('target',current_url());
            $notify = notify('Error:','Please login to access your page request.','danger fade in');
            $this->session->set_flashdata('notify', $notify);
            redirect('login/admin');
        }
    }


    function logout(){
        $this->session->unset_userdata('is_logged_in');
        $notify = notify('','You have successfully Logged out.','info fade in');
        $this->session->set_flashdata('notify', $notify);
        redirect('login');
    }




    function index ($sort_by ='date_created', $sort_order = 'desc',$key="keyword", $offset = 0){
        $limit = 100;
        $data['member_id'] = $this->session->userdata('user_id');
        $data['user_type'] = ($this->session->userdata('user_type') != 'admin')? 'member' : 'admin';

        if($this->uri->segment(5)) $data['keyword'] = '/'.$this->uri->segment(5);
        else $data['keyword'] ='';

        $data['fields'] = sort_fields();

        $this->load->model('contact_model');
        $contact = new $this->contact_model();
        $results = $contact->search2($limit,$offset,$sort_by, $sort_order,$key);
        $data['contacts'] = $results['rows'];
        $data['num_results'] = $results['num_rows'];

        //pagination
        $config = array();
        $config['base_url'] = site_url($this->session->userdata('user_type')."/index/$sort_by/$sort_order/$key");
        $config['total_rows'] = $data['num_results'];
        $config['per_page'] = $limit;
        $config['uri_segment'] = 6;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['sort_order'] = $sort_order;
        $data['sort_by'] = $sort_by;

        $data['menu'] = $this->menu;

        foreach($this->menu as $k => $v) $class[$k] = '';
        $class[0] = 'active';

        $data['class'] = $class;
        $data['sidebar'] = 'sidebar-admin';
        $data['main_content'] = 'admin/contacts';
        $this->load->view('template',$data);
    }

    function order_search($sort_by ='date_created', $sort_order = 'desc',$key="keyword", $offset = 0){
        $limit = 100;
        $data['member_id'] = $this->session->userdata('user_id');
        $data['user_type'] = ($this->session->userdata('user_type') != 'admin')? 'member' : 'admin';

        $customer_name = $this->input->post('name');
        $key = $data['keyword'] = '/'.$customer_name;

        $data['fields'] = sort_fields();

        $this->load->model('contact_model');
        $contact = new $this->contact_model();

        $results = $contact->search2($limit,$offset,$sort_by, $sort_order,$customer_name);
        $data['contacts'] = $results['rows'];
        $data['num_results'] = $results['num_rows'];

        $config = array();
        $config['base_url'] = site_url($this->session->userdata('user_type')."/index/$sort_by/$sort_order/$key");
        $config['total_rows'] = $data['num_results'];
        $config['per_page'] = $limit;
        $config['uri_segment'] = 6;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['sort_order'] = $sort_order;
        $data['sort_by'] = $sort_by;

        //pagination
        $data['menu'] = $this->menu;
        $this->load->view('admin/contacts_results',$data);

    }


    function date_search(){
        $data['member_id'] = $this->session->userdata('user_id');
        $data['user_type'] = ($this->session->userdata('user_type') != 'admin')? 'member' : 'admin';

        $data['title'] = 'search';
        $data['fields'] = sort_fields();

        $date_start = NULL;
        $date_end = NULL;

        $dummy = $this->input->post('date_start');
        if(strlen($dummy)>0) $date_start = date("Y-m-d", strtotime($dummy));

        $dummy = $this->input->post('date_end');
        if(strlen($dummy)>0) $date_end = date("Y-m-d", strtotime($dummy));

        $this->load->model('contact_model');
        $contact = new $this->contact_model();

        $data['contacts'] = $contact->getSearchDate($date_start ,$date_end );

        if( 0 == sizeof($data['contacts'])) $this->load->view('admin/no_result');
        else $this->load->view('admin/name_search_result',$data);
    }



//-------------------------------- Contacts ---------------------------------------
    function add_contact(){
        date_default_timezone_set('UTC');
        $curr_date = date('Y-m-d');

        $data['title'] = 'Kontakt hinzufügen';

        $this->load->model('user_model');
        $user = new $this->user_model();
        $user_name = $user->getFieldDB(array('firstname','lastname'),$this->session->userdata('user_id'));

        $fullname = $user_name[0]->firstname."  ". $user_name[0]->lastname;

        $data['form_element'] = contact_input_fields($curr_date,$fullname);


        $data['menu'] = $this->menu;

        foreach($this->menu as $k => $v) $class[$k] = '';
        $class[1] = 'active';

        $data['class'] = $class;
        $data['sidebar'] = 'sidebar-admin';

        $data['attributes'] = array('id' => 'add-contact','class' => 'form-horizontal');
        $data['action'] = 'admin/create_contact';
        $data['main_content'] = 'admin/generate_form';
        $this->load->view('template',$data);
    }


    function add_user(){
        $data['title'] = 'Add User';

        $data['form_element'] = user_input_fields();

        $data['menu'] = $this->menu;

        foreach($this->menu as $k => $v) $class[$k] = '';
        $class[3] = 'active';

        $data['class'] = $class;
        $data['sidebar'] = 'sidebar-admin';

        $data['attributes'] = array('id' => 'add-contact','class' => 'form-horizontal');
        $data['action'] = $this->session->userdata('user_type').'/create_user';
        $data['main_content'] = 'admin/generate_form';
        $this->load->view('template',$data);
    }

    function edit_contact(){
        $data['title'] = 'Kontakt hinzufügen';

        $this->load->model('user_model');
        $user = new $this->user_model();
        $user_name = $user->getFieldDB(array('firstname','lastname'),$this->session->userdata('user_id'));

        $fullname = $user_name[0]->firstname."  ". $user_name[0]->lastname;

        $data['form_element'] = contact_input_fields('',$fullname);
        $data['form_element']['user_id']['type'] = 'select';

        $rows = $user->getUsers();
        foreach($rows as $i => $val){
            $data['form_element']['user_id']['options'][$rows[$i]->id] = $rows[$i]->name_telefonist;
        }
        $data['form_element']['user_id']['label'] = 'Name Telefonist';


        $this->load->model('contact_model');
        $contact = new $this->contact_model();
        $data['row'] = $contact->getData(array('id' =>$this->uri->segment(3)));
        $data['menu'] = $this->menu;

        foreach($this->menu as $k => $v) $class[$k] = '';
        $class[0] = 'active';

        $data['class'] = $class;
        $data['sidebar'] = 'sidebar-admin';

        $data['attributes'] = array('id' => 'add-contact','class' => 'form-horizontal');
        $data['action'] = $this->session->userdata('user_type').'/update_contact/'.$this->uri->segment(3);
        $data['main_content'] = 'admin/generate_form';
        $this->load->view('template',$data);
    }

    function view_contact(){

        $data['date_fields'] = array('geburtsdatum','wann_angerufen');

        $data['title'] = 'Contacts';
        $this->load->model('contact_model');
        $contact = new $this->contact_model();

        $this->load->model('user_model');
        $data['user'] = $user = new $this->user_model();
        $user_name = $user->getFieldDB(array('firstname','lastname'),$this->session->userdata('user_id'));

        $fullname = $user_name[0]->firstname."  ". $user_name[0]->lastname;
        $data['form_element'] = contact_input_fields('',$fullname);
        $data['form_element']['geburtsdatum']['type'] = 'text';
        $data['form_element']['status']['type'] = 'text';
        $data['form_element']['user_id']['type'] = 'text';

        $data['row'] = $contact->getData(array('id' =>$this->uri->segment(3)));
        $data['menu'] = $this->menu;

        foreach($this->menu as $k => $v) $class[$k] = '';
        $class[0] = 'active';

        $data['class'] = $class;
        $data['sidebar'] = 'sidebar-admin';


        $data['attributes'] = array('id' => 'update-contact');

        $data['main_content'] = 'admin/view_contact';
        $this->load->view('template',$data);
    }


    function update_contact(){

        if ($this->form_validation->run('admin/create_contact') == FALSE)
        {
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger fade in"><button class="close" data-dismiss="alert" type="button">×</button>', '</div>');
            $this->edit_contact();
        }
        else
        {
            $this->load->model('contact_model');
            $contact = new $this->contact_model();
            $new_contact = $this->input->post();

            $date = str_replace('/', '-', $new_contact['geburtsdatum']);
            $new_contact['geburtsdatum'] = date('Y-m-d', strtotime($date));
            unset($new_contact['day']);
            unset($new_contact['month']);
            unset($new_contact['year']);

            $date = str_replace('/', '-', $new_contact['wann_angerufen']);
            $new_contact['wann_angerufen'] = date("Y-m-d", strtotime($date));

            $contact->update($this->uri->segment(3),$new_contact);
            $notify = notify('Success!', ' Contact details has been Updated.', 'success');
            $this->session->set_flashdata('notify', $notify);
            redirect('admin/update_contact/'.$this->uri->segment(3));
        }
    }

    function delete_contact(){

            $this->load->model('contact_model');
            $contact = new $this->contact_model();
            $new_contact = $this->input->post();

            $this->db->delete('contact_list', array('id' => $this->uri->segment(3)));

            $notify = notify('Warning!', ' Contact details has been Deleted.', 'warning');
            $this->session->set_flashdata('notify', $notify);
            redirect('admin');

    }

    function create_contact(){

        if ($this->form_validation->run('admin/create_contact') == FALSE)
        {
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger fade in"><button class="close" data-dismiss="alert" type="button">×</button>', '</div>');

            $this->add_contact();
        }
        else
        {
            $this->load->model('contact_model');
            $contact = new $this->contact_model();
            $new_contact = $this->input->post();

            unset($new_contact['day']);
            unset($new_contact['month']);
            unset($new_contact['year']);

            $new_contact['geburtsdatum'] = date("Y-m-d", strtotime($new_contact['geburtsdatum']));
            $new_contact['wann_angerufen'] = date("Y-m-d", strtotime($new_contact['wann_angerufen']));

            $new_contact['user_id'] =  $this->session->userdata('user_id');

            $contact->add($new_contact);
            $notify = notify('',' Successfully added','success fade in ');
            $this->session->set_flashdata('notify', $notify);
            redirect('admin');
        }
    }

    function users ($sort_by ='date_created', $sort_order = 'desc',$key="keyword", $offset = 0){
        $data['title'] = 'Users';
        $data['user_type'] = array('Admin','Caller','Enhanced caller');
        $limit = 100;
        $customer_name = $this->input->post('name');
        if($this->uri->segment(5)) $data['keyword'] = '/'.$this->uri->segment(5);
        else $data['keyword'] ='';

        $data['fields'] = sort_fields_user();

        $this->load->model('user_model');
        $user = new $this->user_model();
        $results = $user->search2($limit,$offset,$sort_by, $sort_order,$key);
        $data['contacts'] = $results['rows'];
        $data['num_results'] = $results['num_rows'];

        //pagination
        $config = array();
        $config['base_url'] = site_url($this->session->userdata('user_type')."/index/$sort_by/$sort_order/$key");
        $config['total_rows'] = $data['num_results'];
        $config['per_page'] = $limit;
        $config['uri_segment'] = 6;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['sort_order'] = $sort_order;
        $data['sort_by'] = $sort_by;

        $data['menu'] = $this->menu;
        $this->load->model('user_model');
        $data['user'] = new $this->user_model();

        foreach($this->menu as $k => $v) $class[$k] = '';
        $class[2] = 'active';

        $data['class'] = $class;
        $data['sidebar'] = 'sidebar-admin';
        $data['main_content'] = 'admin/member_list';
        $this->load->view('template',$data);
    }



    function edit_user(){
        $data['title'] = 'Edit User';
        $data['form_element'] = user_input_fields();
        $this->load->model('user_model');
        $user = new $this->user_model();
        $data['row'] = $user->getData($this->uri->segment(3));
        $data['form_element'] = user_input_fields();

        $data['menu'] = $this->menu;

        foreach($this->menu as $k => $v) $class[$k] = '';
        $class[3] = 'active';

        $data['class'] = $class;
        $data['sidebar'] = 'sidebar-admin';

        $data['attributes'] = array('id' => 'add-contact','class' => 'form-horizontal');
        $data['action'] = $this->session->userdata('user_type').'/update_user/'.$this->uri->segment(3);
        $data['main_content'] = 'admin/generate_form';
        $this->load->view('template',$data);
    }

    function update_user(){


        if ($this->form_validation->run('admin/update_user') == FALSE)
        {
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger fade in"><button class="close" data-dismiss="alert" type="button">×</button>', '</div>');
            $this->edit_user();
        }
        else
        {
            $this->load->model('user_model');
            $contact = new $this->user_model();
            $insert_fields= $this->input->post();
            unset($insert_fields['submit']);
            unset($insert_fields['password2']);

            $insert_fields['password'] = md5($insert_fields['password']);

            $contact->update($this->uri->segment(3),$insert_fields);
            $notify = notify('Success!', ' Contact details has been Updated.', 'success');
            $this->session->set_flashdata('notify', $notify);
            redirect('admin/edit_user/'.$this->uri->segment(3));
        }
    }


    function create_user(){
        if ($this->form_validation->run() == FALSE){
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger fade in"><button class="close" data-dismiss="alert" type="button">×</button>', '</div>');
            $this->add_user();
        }
        else {
            $insert_fields= $this->input->post();
            unset($insert_fields['submit']);
            unset($insert_fields['password2']);

            $insert_fields['password'] = md5($insert_fields['password']);
            $insert_fields['hash'] = '';
            $insert_fields['status'] = 'activated';

            $this->load->model('user_model');
            $user = new $this->user_model();

            if($user->email_exist($this->input->post('email'))){
                $notify = notify('Oops! ','Email is found on the database. Please use a different email', 'warning');
                $this->session->set_flashdata('notify_reg', $notify);
                $this->session->set_flashdata('post', $insert_fields );
                redirect('admin/create_user');
            }

            if($user->username_exist($this->input->post('username'))){
                $notify = notify('Oops! ','Username is already in use. Please select a different username', 'warning');
                $this->session->set_flashdata('notify_reg', $notify);
                $this->session->set_flashdata('post', $insert_fields );
                redirect('admin/create_user');
            }

            if($user->create_user($insert_fields)){
                $notify = notify('','User Successfully added.', 'success');
                $this->session->set_flashdata('notify', $notify);
                redirect('admin/create_user');
            }
        }
    }

    function delete_user(){
        $this->db->delete('users', array('id' => $this->uri->segment(3)));

        $notify = notify('Warning!', ' User details has been Deleted.', 'warning');
        $this->session->set_flashdata('notify', $notify);
        redirect('admin/users');

    }
//-------------------------END Member -----------------------------------------

    function export($table_name){
        $this->is_logged_in_admin();
        $query = $this->db->get($table_name);

        if(!$query)
            return false;

        // Starting the PHPExcel library
        $this->load->library('excel');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

        $objPHPExcel->setActiveSheetIndex(0);

        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field){
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }

        // Fetching the table data
        $row = 2;
        foreach($query->result() as $data){
            $col = 0;
            foreach ($fields as $field){
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }

            $row++;
        }

        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$table_name.'_'.date('dMy').'.xls"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');
    }
}


