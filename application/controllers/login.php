<?php

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

    }

    function index()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');

//        echo $this->session->userdata('user_type'); exit;
        if($is_logged_in){
            if('' != $this->session->userdata('user_type'))
             redirect('admin');
        }

        $config['base_url'] = base_url();
        $data['uid'] = 1;
        $data['main_content'] = 'login';
        $this->load->view('template',$data);
    }

    function admin()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
//        if($is_logged_in){
//             redirect('admin');
//        }
        $data['uid'] = 0;
        $config['base_url'] = base_url();
        $data['main_content'] = 'login';
        $this->load->view('template',$data);
    }


    function validate_credentials(){


        if ($this->form_validation->run() == FALSE)
        {

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger fade in"><button class="close" data-dismiss="alert" type="button">×</button>', '</div>');

            $this->index();
        }
        else {



            $this->load->model('user_model');
            $valid = $this->user_model->validate($this->input->post('user_type'));
//            echo 'here'.$valid; exit;
            if($valid){
                $data = array(
                    'username' => $this->input->post('username_login'),
                    'is_logged_in' => true,
                    'user_type' => $this->user_model->user_type,
                    'user_id'   => $this->user_model->user_id,
                );

                $this->session->set_userdata($data);


                if('admin' == $data['user_type']){

                    $target = $this->session->userdata('target');
                    if($target){ $this->session->unset_userdata('target');
                        redirect($target);  }
                    else redirect('admin/index');
                }
                else{


                    $target = $this->session->userdata('target');
                    if($target){

                        $this->session->unset_userdata('target');
                        $notify = notify('Welcome! ',$this->session->userdata('username'),'success');
                        $this->session->set_flashdata('notify', $notify);
                        redirect($target);

                    }
                    else  {
                        redirect('member');
                    }
                }

            }

            else {

                if($this->user_model->is_activated($this->input->post('user_type'))){
                    $notify = notify('Oops! ',' It seems that yor account is not yet activated. Please go to your email and click on the activation link.','warning');
                    $this->session->set_flashdata('notify', $notify);
                    redirect('login');
                }

                else {
                    $notify = notify('Error:','Incorrect Username or Password.','danger');
                    $this->session->set_flashdata('notify', $notify);
                    redirect('login');
                }

            }
        }
    }


    function create_member(){
        if ($this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger fade in"><button class="close" data-dismiss="alert" type="button">×</button>', '</div>');
            $this->index();
        }
        else
        {
            $insert_fields= $this->input->post();
            unset($insert_fields['submit']);
            unset($insert_fields['password2']);

            $insert_fields['password'] = md5($insert_fields['password']);

            $this->load->model('user_model');
            $user = new $this->user_model();

            if($user->email_exist($this->input->post('email'))){
                $notify = notify('Oops! ','Email is found on the database. Please use a different email', 'warning');
                $this->session->set_flashdata('notify_reg', $notify);
                $this->session->set_flashdata('post', $insert_fields );
                redirect('login');
            }

            if($user->username_exist($this->input->post('username'))){
                $notify = notify('Oops! ','Username is already in use. Please select a different username', 'warning');
                $this->session->set_flashdata('notify_reg', $notify);
                $this->session->set_flashdata('post', $insert_fields );

                redirect('login');
            }



            $name = '';
            $password = '';

            $hash = md5( rand(0,1000) );
            $insert_fields['hash'] = $hash;
            $recepient = $this->input->post('email');
            $subject = 'HandMeDown Bookstore - Membership Confirmation';
            $msg =  '
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below. If the url does not work, copy and paste it in the address bar.
------------------------
Username: '.$this->input->post('username').'
Password: ******
------------------------
Please click this link to activate your account:
http://handmedownbookstore.com/login/verify/'.$hash.'

';

            if($user->create_user($insert_fields)){
                $this->_sendEmail($recepient, $subject, $msg);
                $notify = notify('Congratulations! ','A confirmation link is being sent to your Email.', 'success');
                $this->session->set_flashdata('notify', $notify);
                redirect('login');
            }

        }

    }

    function verify(){
        $this->load->model('user_model');
        $user = new $this->user_model();
        $data = array(
            'status' => 'activated',
            'hash' => null
        );

        if('' != $this->uri->segment(3) && $user->activate( $this->uri->segment(3), $data )){
            $notify = notify('Congratulations! ','Your Membership is now activated. You can now login and shop :)', 'success');
            $this->session->set_flashdata('notify', $notify);
            redirect('login');
        }

        else {
            $notify = notify('Oops ! ','Your account could not be activated. Please recheck the link or contact the system administrator.');
            $this->session->set_flashdata('notify', $notify);
            redirect('login');

        }

    }

    function _sendEmail($recepient, $subject = '', $msg = '')
    {
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->from('hmdbookstore@gmail.com','HandMeDown Bookstore');
        $this->email->to($recepient);
        $this->email->subject($subject);
        $this->email->message($msg);

        if($this->email->send()){
            $notify = notify('Congratulations! ','A confirmation link has been sent to your Email.');
            $this->session->set_flashdata('notify', $notify);
        }
        else show_error($this->email->print_debugger());
    }
}