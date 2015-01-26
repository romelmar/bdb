<?php
/**
 * Created by JetBrains PhpStorm.
 * User: romel
 * Date: 11/24/12
 * Time: 9:12 PM
 * To change this template use File | Settings | File Templates.
 */
class User_model extends CI_Model
{
    var  $table = 'users';
    var  $user_type = 'member';
    var  $user_id;

    function getUsers($id = 'all'){
        $q = $this->db->select("id, CONCAT(firstname,' ',lastname) AS name_telefonist", FALSE)
            ->from($this->table);

        if($id != 'all'){
            $q->where(array('id' => $id));
            return $q->get()->row()->name_telefonist;

        }

        return $q->get()->result();
    }



    function search2($limit, $offset,$sort_by, $sort_order, $keyword){

        $sort_order = ("desc" == $sort_order)? "desc" : "asc";
        $sort_columns = array( '*');

        $sort_by = (in_array($sort_by,$sort_columns)) ? $sort_by : 'firstname';
        //  results query
        if('admin' == $this->session->userdata('user_type'))
            $q = $this->db->select('*')
                ->from($this->table)
                ->limit($limit,$offset)
                ->order_by($sort_by,$sort_order);
        else
            $q = $this->db->select('*')
                ->from($this->table)
                ->where(array('user_id' => $this->session->userdata('user_id')))
                ->limit($limit,$offset)
                ->order_by($sort_by,$sort_order);

        $ret['rows'] = $q->get()->result();

        //  count query
        if('admin' == $this->session->userdata('user_type'))
            $q = $this->db->select('COUNT(*) as count', FALSE)
                ->from($this->table);
        else
            $q = $this->db->select('COUNT(*) as count', FALSE)
                ->from($this->table)
                ->where(array('user_id' => $this->session->userdata('user_id')));

        $tmp = $q->get()->result();
        $ret['num_rows'] = $tmp[0]->count;

        return $ret;
    }


     function validate($u_type){
         $this->db->where('username',$this->input->post('username_login'));
         $this->db->where('password',md5($this->input->post('password_login')));
         $this->db->where('status','activated');

         $query = $this->db->get('users');

         if( 1 == $query->num_rows){

             $res = $query->result();

             if(0 == $res[0]->user_type){
                 $this->user_type = 'admin';
             }
             else if(2 == $res[0]->user_type){
                 $this->user_type = 'enhanced';
             }


             $this->user_id = $res[0]->id;
             return $query->num_rows;
         }
     }


    function is_activated($u_type){
        $registered = 0;

        $this->db->where('username',$this->input->post('username_login'));
        $this->db->where('password',md5($this->input->post('password_login')));
        $this->db->where('user_type',$u_type);
        $query = $this->db->get('users');

        if( 1 == $query->num_rows){ $registered = 1;}

        return $registered;
    }

    function create_user($new_user_data){

        $insert = $this->db->insert('users',$new_user_data);

        return $insert;
    }

    function email_exist($email){
        $this->db->where('email',$email);
        $query = $this->db->get( $this->table );

        return $query->num_rows;

    }

    function username_exist($username){
        $this->db->where('username',$username);
        $query = $this->db->get( $this->table );

        return $query->num_rows;

    }

    function logout(){
        $this->session->unset_userdata('is_logged_in');
    }

    function getData($id){
        $this->db->where('id',$id);
        $query = $this->db->get( $this->table );
        return $query->result();
    }

    function activate($hash, $data){
        $this->db->where('hash', $hash);
        $this->db->update( $this->table , $data );
        return $this->db->affected_rows();

    }


    function get_telefonist(){
        $this->db->select("id, CONCAT(firstname, ' ', lastname) AS full_name", FALSE);
        $query = $this->db->get_where($this->table);
        return $query->result();
    }

//----------------------------------------------------------

    function getAll(){
        $query = $this->db->get($this->table);
        return $query->result();
    }



    function add($data){
        $this->db->insert($this->table ,$data);
        return;
    }

    function update($id,$data){
        $this->db->where('id', $id);
        $this->db->update( $this->table , $data );
        return;
    }

    function search($name = '' ){
        $query = $this->db->query("
                    SELECT *
                    FROM
                        `handme_hmdbs`.`suppliers`
                            WHERE CONCAT(suppliers.`firstname`,' ', suppliers.`lastname`) LIKE '%{$name}%'
                    ");
        return $query->result();
    }


    function getFieldDB($field, $id){
        $this->db->select($field);
        $query = $this->db->get_where($this->table, array('id' => $id));
        return $query->result();
    }

}