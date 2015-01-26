<?php

function notify($bold='', $msg='', $type='error'){

    $class = 'alert-'.$type;

    $notice ='';
    $notice .='<div class="alert '.$class.' fade in">';
    $notice .='<button type="button" class="close" data-dismiss="alert">×</button>';
    $notice .= '<strong>' . $bold . '</strong>' . " " . $msg;
    $notice .='</div>';

    return $notice;
}

function is_fade_field($list,$field){
    return in_array($field, $list);
}

function sort_fields(){
    $fields = array(
        'status' => 'status',
        'anrede' => 'Anrede',
        'name' => 'Name',
        'vorname' => 'Vorname',
        'telefonnummer' => 'Telefonnummer',
        'geburtsdatum' => 'Geburtsdatum',
        'beruf' => 'Beruf',
        'postleitzahl' => 'Postleitzahl',
        'date_created' => 'Datum',
        'name_telefonist' => 'Telefonist'
    );

    return $fields;
}
function sort_fields_user(){
    $fields = array(
        'user_type' => 'User Type',
        'firstname' => 'Name',
        'lastname' => 'Vorname',
        'email' => 'Email',
        'address' => 'Address',
        'contactNo' => 'Kontakt No',
        'username' => 'Username',
    );

    return $fields;
}

function user_input_fields(){
    $fields = array(
        'id' => array(
            'label' => 'id',
            'type' => 'hidden',
            'value' => ''),

        'user_type' => array(
            'label' => 'Caller Type:',
            'type' => 'select',
            'options' => array('1' => 'Caller','2' => 'Enhanced caller'),
            'attr' => array('class'=>'form-control required')),

        'firstname' => array(
            'label' => 'Name:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'lastname' => array(
            'label' => 'Vorname:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'email' => array(
            'label' => 'Email:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'address' => array(
            'label' => 'Address:',
            'type' => 'text',
            'attr' => array('class'=>'form-control')),

        'contactNo' => array(
            'label' => 'Telefonnummer:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'username' => array(
            'label' => 'Username:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'password' => array(
            'label' => 'Password:',
            'type' => 'password',
            'attr' => array('class'=>'form-control required')),

        'password2' => array(
            'label' => 'Confirm Password:',
            'type' => 'password',
            'attr' => array('class'=>'form-control required'))

    );

    return $fields;
}

function contact_input_fields($curr_date, $fullname){

    $fields = array(
        'anrede' => array(
            'label' => 'Anrede:',
            'type' => 'select',
            'options' => array('Herr' => 'Herr' ,'Frau' => 'Frau'),
            'attr' => array('class'=>'form-control  required')),
        'name' => array(
            'label' => 'Name:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'vorname' => array(
            'label' => 'Vorname:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),
        'email' => array(
            'label' => 'Email:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),
        'telefonnummer' => array(
            'label' => 'Telefonnummer:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'geburtsdatum' => array(
            'label' => 'Geburtsdatum:',
            'type' => 'hidden',
            'value' => ''),

        'beruf' => array(
            'label' => 'Beruf:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'strabe_hausnummer' => array(
            'label' => 'Straße Hausnummer:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'postleitzahl' => array(
            'label' => 'Postleitzahl:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'ort' => array(
            'label' => 'Ort:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'wann_angerufen' => array(
            'label' => 'Wann angerufen?:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required','placeholder' =>"DD/MM/YYYY")),

        'user_id' => array(
            'label' => 'Name Telefonist',
            'type' => 'hidden',
            'attr' => array('class'=>'form-control')),

        'name_telefonist_terminvereinbarung' => array(
            'label' => 'Name Telefonist Terminvereinbarung:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'gesetzlich_privat' => array(
            'label' => 'Gesetzlich // Privat:',
            'type' => 'select',
            'options' => array('Gesetzlich' => 'Gesetzlich','Privat' => 'Privat'),
            'attr' => array('class'=>'form-control required')),

        'wo_versichert' => array(
            'label' => 'Wo versichert?:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'beitrag' => array(
            'label' => 'Beitrag:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'hohe_der_selbstbeteiligung' => array(
            'label' => 'Höhe der Selbstbeteiligung:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'wie_lange_dort_versichert' => array(
            'label' => 'Wie lange dort versichert?:',
            'type' => 'select',
            'options' => array('0-3 Jahre' => '0-3 Jahre','4-10 Jahre' => '4-10 Jahre', '10 - Jahre' =>'10 - Jahre'),
            'attr' => array('class'=>'form-control required')),

        'kunde_alleine_versichert' => array(
            'label' => 'Kunde alleine versichert:',
            'type' => 'select',
            'options' => array('Nein','Ja'),
            'attr' => array('class'=>'form-control')),

        'geburtsjahr_kinder_ehefrau' => array(
            'label' => 'Geburtsjahr Kinder & Ehefrau:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'chronische_krankheiten' => array(
            'label' => 'Chronische Krankheiten:',
            'type' => 'select',
            'options' => array('Nein','Ja'),
            'attr' => array('class'=>'form-control required')),

        'welche_krankheiten' => array(
            'label' => 'Welche Krankheiten?:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'einnahme_von_medikamenten' => array(
            'label' => 'Einnahme von Medikamenten?',
            'type' => 'select',
            'options' => array('Nein','Ja'),
            'attr' => array('class'=>'form-control required')),

        'welche_medikamente' => array(
            'label' => 'Welche Medikamente?:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'gewicht_angemessen' => array(
            'label' => 'Gewicht angemessen?',
            'type' => 'select',
            'options' => array('Nein','Ja'),
            'attr' => array('class'=>'form-control required')),

        'krankenhausaufenthalt_letzte_5_Jahre' => array(
            'label' => 'Krankenhausaufenthalt letzte 5 Jahre? ',
            'type' => 'select',
            'options' => array('Nein','Ja'),
            'attr' => array('class'=>'form-control required')),

        'grund_fur_aufenthalt' => array(
            'label' => 'Grund für Aufenthalt?:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'operationen_geplant' => array(
            'label' => 'Operationen geplant?',
            'type' => 'select',
            'options' => array('Nein','Ja'),
            'attr' => array('class'=>'form-control required')),

        'welche' => array(
            'label' => 'Welche?:',
            'type' => 'text',
            'attr' => array('class'=>'form-control required')),

        'status' => array(
            'label' => 'Status:',
            'type' => 'select',
            'options' => array(
                '1. Anrufen - Neu - Interessenten anrufen für Terminvereinbarung' =>'1. Anrufen - Neu - Interessenten anrufen für Terminvereinbarung',
                '2. Anrufen - Neu - Terminvereinbarung nicht möglich, Interessent nicht erreicht' =>'2. Anrufen - Neu - Terminvereinbarung nicht möglich, Interessent nicht erreicht',
                '3. Fertig - Termin vereinbart' =>'3. Fertig - Termin vereinbart',
                '4. Anrufen - Termin muss verschoben werden, bitte anrufen' =>'4. Anrufen - Termin muss verschoben werden, bitte anrufen',
                '5. uninteressant - Terminvereinbarung nicht möglich, möchte Vergleich per Email' =>'5. uninteressant - Terminvereinbarung nicht möglich, möchte Vergleich per Email',
                '6. uninteressant - Terminvereinbarung nicht möglich, möchte Vergleich per Post' =>'6. uninteressant - Terminvereinbarung nicht möglich, möchte Vergleich per Post',
                '7. Storno - Terminvereinbarung nicht möglich, generell kein Interesse' =>'7. Storno - Terminvereinbarung nicht möglich, generell kein Interesse',
                '8. Storno - Angaben von Telefonist nicht korrekt' =>'8. Storno - Angaben von Telefonist nicht korrekt',
                '8.1. Storno - Mindestbeitrag nicht erreicht' =>'8.1. Storno - Mindestbeitrag nicht erreicht',
                '8.2. Storno - Interessent ist krank' =>'8.2. Storno - Interessent ist krank',
                '8.3. Storno - Familie mitversichert' =>'8.3. Storno - Familie mitversichert',
                '9. unklar - Besondere Situation, Erklärung im Freifeld' =>'9. unklar - Besondere Situation, Erklärung im Freifeld'
            ),

            'attr' => array('class'=>'form-control required')),
        'status2' => array(
            'label' => 'Status aktive Kundenbeziehung:',
            'type' => 'select',
            'options' => array(
                '',
                '1. Kranken abgeschlossen, Zusatzgeschäft unwahrscheinlich',
                '2. Kranken abgeschlossen, Zusatzgeschäft möglich'
            ),

            'attr' => array('class'=>'form-control required')),

        'zusatzinformationen' => array(
            'label' => 'Zusatzinformationen:',
            'type' => 'textarea',
            'attr' => array('class'=>'form-control required')),

        'date_created' => array(
            'label' => '',
            'type' => 'hidden',
            'value' => $curr_date)
    );


    return $fields;
}

