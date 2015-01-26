<?php

class Member extends CI_Controller
{
    var $menu = array();

    function __construct()
    {
        parent::__construct();

        $this->is_logged_in();

        $this->load->library('form_validation');
        $this->menu = array(
                        array(
                            'icon'  => '',
                            'url'   => 'member',
                            'label' => 'Verzeichnis',
                            'attr'  => array('tabindex' => '-1')
                        ),
                        array(
                            'icon'  => '',
                            'url'   => 'member/add_contact',
                            'label' => 'Kontakt hinzufügen',
                            'attr'  => array('tabindex' => '-1')
                        )

        );
    }

    function is_logged_in(){
         $is_logged_in = $this->session->userdata('is_logged_in');
        $is_admin = $this->session->userdata('user_type');
        if('admin' == $is_admin)redirect('admin');

        if(!isset($is_logged_in) || $is_logged_in != TRUE){
            $this->session->set_userdata('target',current_url());
            $notify = notify('Error:','Please login to access your page request.','danger fade in');
            $this->session->set_flashdata('notify', $notify);
            redirect('login');
        }
    }

    function logout(){
        $this->session->unset_userdata('is_logged_in');
        $notify = notify('','You have successfully Logged out.','info fade in');
        $this->session->set_flashdata('notify', $notify);
        redirect('login');
    }

    function index ($sort_by ='date_created', $sort_order = 'desc',$key="keyword", $offset = 0){

//        echo $this->session->userdata('user_type'); exit;
        $data['member_id'] = $this->session->userdata('user_id');
        $data['user_type'] = ($this->session->userdata('user_type') != 'admin')? 'member' : 'admin';


        $limit = 100;

        if($this->uri->segment(5)) $data['keyword'] = '/'.$this->uri->segment(5);
        else $data['keyword'] ='';

        $customer_name = $this->input->post('name');
        $data['fields'] = sort_fields();

        $this->load->model('contact_model');
        $contact = new $this->contact_model();
        $results = $contact->search2($limit,$offset,$sort_by, $sort_order,$key);
        $data['contacts'] = $results['rows'];
        $data['num_results'] = $results['num_rows'];

        //pagination
        $config = array();
        $config['base_url'] = site_url($data['user_type']."/index/$sort_by/$sort_order/$key");
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
        $config['base_url'] = site_url($data['user_type']."/index/$sort_by/$sort_order/$key");
        $config['total_rows'] = $data['num_results'];
        $config['per_page'] = $limit;
        $config['uri_segment'] = 6;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['sort_order'] = $sort_order;
        $data['sort_by'] = $sort_by;

        //pagination
        $data['menu'] = $this->menu;
        $this->load->model('user_model');
        $data['user'] = new $this->user_model();
        $this->load->view('admin/contacts_results',$data);

    }
    function date_search(){
        $data['title'] = 'search';
        $data['fields'] = sort_fields();

        $date_start = NULL;
        $date_end = NULL;

        $dummy = $this->input->post('date_start');
        if(strlen($dummy)>0) $date_start = date("Y-m-d", strtotime($dummy));

        $dummy = $this->input->post('date_end');
        if(strlen($dummy)>0) $date_end = date("Y-m-d", strtotime($dummy));


        $this->load->model('user_model');
        $data['user'] = new $this->user_model();

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
        $data['member_id'] = $this->session->userdata('user_id');
        $data['user_type'] = ($this->session->userdata('user_type') != 'admin')? 'member' : 'admin';
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
        $data['action'] = $data['user_type'].'/create_contact';
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
//        $data['form_element']['user_id']['type'] = 'select';
//
////        $rows = $user->getUsers();
////        foreach($rows as $i => $val){
////            $data['form_element']['user_id']['options'][$rows[$i]->id] = $rows[$i]->name_telefonist;
////        }
////        $data['form_element']['user_id']['label'] = 'Name Telefonist';

        $this->load->model('contact_model');
        $contact = new $this->contact_model();
        $data['row'] = $contact->getData(array('id' =>$this->uri->segment(3)));
        $data['menu'] = $this->menu;

        foreach($this->menu as $k => $v) $class[$k] = '';
        $class[1] = 'active';

        $data['class'] = $class;
        $data['sidebar'] = 'sidebar-admin';

        $data['attributes'] = array('id' => 'add-contact','class' => 'form-horizontal');
        $data['action'] = 'member/update_contact/'.$this->uri->segment(3);
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

        if ($this->form_validation->run('member/create_contact') == FALSE)
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
            redirect('member/edit_contact/'.$this->uri->segment(3));
        }
    }

    function delete_contact(){
        $data['member_id'] = $this->session->userdata('user_id');
        $data['user_type'] = ($this->session->userdata('user_type') != 'admin')? 'member' : 'admin';
            $this->load->model('contact_model');
            $this->db->delete('contact_list', array('id' => $this->uri->segment(3)));

            $notify = notify('Warning!', ' Contact details has been Deleted.', 'warning');
            $this->session->set_flashdata('notify', $notify);
            redirect( $data['user_type']);
    }

    function create_contact(){
        $data['member_id'] = $this->session->userdata('user_id');
        $data['user_type'] = ($this->session->userdata('user_type') != 'admin')? 'member' : 'admin';
        if ($this->form_validation->run('member/create_contact') == FALSE){
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
            redirect( $data['user_type']);
        }
    }
//-------------------------------- End Contacts ---------------------------------------




}