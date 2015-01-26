<?php

class Contact_model extends CI_Model
{
    var $table = 'contact_list';

    function search2($limit, $offset,$sort_by, $sort_order, $keyword){

        $sort_order = ("desc" == $sort_order)? "desc" : "asc";
        $sort_columns = array('status','anrede', 'name', 'vorname', 'telefonnummer', 'geburtsdatum', 'beruf', 'postleitzahl', 'date_created', 'name_telefonist');
        $sort_by = (in_array($sort_by,$sort_columns)) ? $sort_by : 'date_created';
        //  results query
        if('admin' == $this->session->userdata('user_type') || 'enhanced' == $this->session->userdata('user_type'))
            $q = $this->db->select("
                                    {$this->table}.id,
                                    {$this->table}.user_id,
                                    {$this->table}.anrede,
                                    {$this->table}.name,
                                    {$this->table}.vorname,
                                    {$this->table}.telefonnummer,
                                    {$this->table}.geburtsdatum,
                                    {$this->table}.beruf,
                                    {$this->table}.postleitzahl,
                                    {$this->table}.date_created,
                                    {$this->table}.status,
                                    CONCAT(firstname,' ',lastname) AS name_telefonist", FALSE)
                ->from($this->table)
                ->join('users', "{$this->table}.user_id in(users.id)")
                ->limit($limit,$offset)
                ->order_by($sort_by,$sort_order);

        else
            $q = $this->db->select("
                                    {$this->table}.id,
                                    {$this->table}.user_id,
                                    {$this->table}.anrede,
                                    {$this->table}.name,
                                    {$this->table}.vorname,
                                    {$this->table}.telefonnummer,
                                    {$this->table}.geburtsdatum,
                                    {$this->table}.beruf,
                                    {$this->table}.postleitzahl,
                                    {$this->table}.date_created,
                                    {$this->table}.status,
                                    CONCAT(firstname,' ',lastname) AS name_telefonist", FALSE)
                ->from($this->table)
                ->join('users', "{$this->table}.user_id in(users.id)")
                ->where(array('user_id' => $this->session->userdata('user_id')))
                ->limit($limit,$offset)
                ->order_by($sort_by,$sort_order);

                if($keyword !='keyword') $q->like("CONCAT(
                                UPPER(anrede), ' ',
                                UPPER(name), ' ',
                                UPPER(vorname), ' ',
                                UPPER(telefonnummer), ' ',
                                UPPER(geburtsdatum), ' ',
                                UPPER(beruf), ' ',
                                UPPER(strabe_hausnummer), ' ',
                                UPPER(postleitzahl), ' ',
                                UPPER(ort), ' ',
                                UPPER(wann_angerufen), ' ',
                                UPPER(name_telefonist_terminvereinbarung), ' ',
                                UPPER(gesetzlich_privat), ' ',
                                UPPER(wo_versichert), ' ',
                                UPPER(beitrag), ' ',
                                UPPER(hohe_der_selbstbeteiligung), ' ',
                                UPPER(wie_lange_dort_versichert), ' ',
                                UPPER(geburtsjahr_kinder_ehefrau), ' ',
                                UPPER(welche_krankheiten), ' ',
                                UPPER(welche_medikamente), ' ',
                                UPPER(grund_fur_aufenthalt), ' ',
                                UPPER(welche), ' ',
                                UPPER(contact_list.status), ' ',
                                UPPER(zusatzinformationen), ' ',
                                UPPER(CONCAT(`users`.firstname,' ',`users`.lastname) ))",strtoupper(rawurldecode($keyword)));

//        echo '<pre>';
//        print_r($q);
//        echo '</pre>';
//        exit;
        $ret['rows'] = $q->get()->result();

        //  count query
        if('admin' == $this->session->userdata('user_type') || 'enhanced' == $this->session->userdata('user_type'))
            $q = $this->db->select('COUNT(*) as count', FALSE)
                ->from($this->table)
                ->join('users', "{$this->table}.user_id in(users.id)");
        else
            $q = $this->db->select('COUNT(*) as count', FALSE)
                ->from($this->table)
                ->join('users', "{$this->table}.user_id in(users.id)")
                ->where(array('user_id' => $this->session->userdata('user_id')));
        if($keyword !='keyword') $q->like("CONCAT(
                                UPPER(anrede), ' ',
                                UPPER(name), ' ',
                                UPPER(vorname), ' ',
                                UPPER(telefonnummer), ' ',
                                UPPER(geburtsdatum), ' ',
                                UPPER(beruf), ' ',
                                UPPER(strabe_hausnummer), ' ',
                                UPPER(postleitzahl), ' ',
                                UPPER(ort), ' ',
                                UPPER(wann_angerufen), ' ',
                                UPPER(name_telefonist_terminvereinbarung), ' ',
                                UPPER(gesetzlich_privat), ' ',
                                UPPER(wo_versichert), ' ',
                                UPPER(beitrag), ' ',
                                UPPER(hohe_der_selbstbeteiligung), ' ',
                                UPPER(wie_lange_dort_versichert), ' ',
                                UPPER(geburtsjahr_kinder_ehefrau), ' ',
                                UPPER(welche_krankheiten), ' ',
                                UPPER(welche_medikamente), ' ',
                                UPPER(grund_fur_aufenthalt), ' ',
                                UPPER(welche), ' ',
                                UPPER(contact_list.status), ' ',
                                UPPER(zusatzinformationen), ' ',
                                UPPER(CONCAT(`users`.firstname,' ',`users`.lastname) ))",strtoupper(rawurldecode($keyword)));
        $tmp = $q->get()->result();
        $ret['num_rows'] = $tmp[0]->count;

        return $ret;
    }

    function getData($query = NULL, $sortBy=NULL ){
        if(isset($query)) $this->db->where($query);

        if(isset($sortBy))
            $this->db->order_by($sortBy, $this->uri->segment(5));

        $query = $this->db->get( $this->table );
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

    function getSearchDate($start = '', $end = ''){
        if('' != $start) $this->db->where("date_created >=", $start );
        if('' != $end )$this->db->where("date_created <=", $end);

        if('admin' != $this->session->userdata('user_type'))
            $this->db->where(array('user_id' => $this->session->userdata('user_id')));
        $q = $this->db->select("
                                    {$this->table}.id,
                                    {$this->table}.anrede,
                                    {$this->table}.name,
                                    {$this->table}.vorname,
                                    {$this->table}.telefonnummer,
                                    {$this->table}.geburtsdatum,
                                    {$this->table}.beruf,
                                    {$this->table}.postleitzahl,
                                    {$this->table}.date_created,
                                    {$this->table}.status,
                                    CONCAT(firstname,' ',lastname) AS name_telefonist", FALSE)
            ->from($this->table)
            ->join('users', "{$this->table}.user_id in(users.id)");
        return $q->get()->result();

    }

}