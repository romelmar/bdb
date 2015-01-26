<?php
$config = array(

//            array(
//                'field'   => 'firstname',
//                'label'   => 'Firstname',
//                'rules'   => 'trim|required'
//            ),
//            array(
//                'field'   => 'lastname',
//                'label'   => 'Lastname',
//                'rules'   => 'trim|required'
//            ),
//            array(
//                'field'   => 'contactNo',
//                'label'   => 'Contact Number',
//                'rules'   => 'trim|required'
//            ),
//            array(
//                'field'   => 'email',
//                'label'   => 'Email',
//                'rules'   => 'trim|required|valid_email'
//            ),
//            array(
//                'field'   => 'username',
//                'label'   => 'Username',
//                'rules'   => 'trim|required'
//            ),
//            array(
//                'field'   => 'password',
//                'label'   => 'Password',
//                'rules'   => 'trim|required|matches[password2]'
//            ),
//            array(
//                'field'   => 'password2',
//                'label'   => 'Confirm Password',
//                'rules'   => 'trim|required'
//            ),

            'admin/create_user' =>
                array(
                    array(
                        'field'   => 'firstname',
                        'label'   => 'Firstname',
                        'rules'   => 'trim|required'
                    ),
                    array(
                        'field'   => 'lastname',
                        'label'   => 'Lastname',
                        'rules'   => 'trim|required'
                    ),
                    array(
                        'field'   => 'contactNo',
                        'label'   => 'Contact Number',
                        'rules'   => 'trim|required'
                    ),
                    array(
                        'field'   => 'email',
                        'label'   => 'Email',
                        'rules'   => 'trim|required|valid_email'
                    ),
                    array(
                        'field'   => 'address',
                        'label'   => 'Address',
                        'rules'   => 'trim'
                    ),
                    array(
                        'field'   => 'username',
                        'label'   => 'Username',
                        'rules'   => 'trim|required'
                    ),
                    array(
                        'field'   => 'password',
                        'label'   => 'Password',
                        'rules'   => 'trim|required|matches[password2]'
                    ),
                    array(
                        'field'   => 'password2',
                        'label'   => 'Confirm Password',
                        'rules'   => 'trim|required'
                    )
                ),

            'admin/update_user' =>
                array(
                    array(
                        'field'   => 'firstname',
                        'label'   => 'Firstname',
                        'rules'   => 'trim|required'
                    ),
                    array(
                        'field'   => 'lastname',
                        'label'   => 'Lastname',
                        'rules'   => 'trim|required'
                    ),
                    array(
                        'field'   => 'contactNo',
                        'label'   => 'Contact Number',
                        'rules'   => 'trim|required'
                    ),
                    array(
                        'field'   => 'email',
                        'label'   => 'Email',
                        'rules'   => 'trim|required|valid_email'
                    ),
                    array(
                        'field'   => 'address',
                        'label'   => 'Address',
                        'rules'   => 'trim'
                    ),
                    array(
                        'field'   => 'username',
                        'label'   => 'Username',
                        'rules'   => 'trim|required'
                    ),
            array(
                'field'   => 'password2',
                'label'   => 'Confirm Password',
                'rules'   => 'trim|required'
            )
                ),



            'login/validate_credentials' =>
                array(
                    array(
                        'field'   => 'username_login',
                        'label'   => 'Username',
                        'rules'   => 'trim|required'
                    ),
                    array(
                        'field'   => 'password_login',
                        'label'   => 'Password',
                        'rules'   => 'trim|required'
                    )
                ),


            'admin/create_contact' =>
                array(
                    array(
                        'field'   => 'anrede',
                        'label'   => 'anrede',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'name',
                        'label'   => 'name',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'vorname',
                        'label'   => 'vorname',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'email',
                        'label'   => 'Email',
                        'rules'   => 'trim'
                    ),
                    array(
                        'field'   => 'telefonnummer',
                        'label'   => 'telefonnummer',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'geburtsdatum',
                        'label'   => 'geburtsdatum',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'beruf',
                        'label'   => 'beruf',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'ort',
                        'label'   => 'ort',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'wann_angerufen',
                        'label'   => 'wann_angerufen',
                        'rules'   => 'trim|required'
                    ),

//                    array(
//                        'field'   => 'name_telefonist',
//                        'label'   => 'name_telefonist',
//                        'rules'   => 'trim|required'
//                    ),

                    array(
                        'field'   => 'gesetzlich_privat',
                        'label'   => 'gesetzlich_privat',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'wo_versichert',
                        'label'   => 'wo_versichert',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'hohe_der_selbstbeteiligung',
                        'label'   => 'hohe_der_selbstbeteiligung',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'wie_lange_dort_versichert',
                        'label'   => 'wie_lange_dort_versichert',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'kunde_alleine_versichert',
                        'label'   => 'kunde_alleine_versichert',
                        'rules'   => 'trim|required'
                    ),



                    array(
                        'field'   => 'chronische_krankheiten',
                        'label'   => 'chronische_krankheiten',
                        'rules'   => 'trim|required'
                    ),


                    array(
                        'field'   => 'einnahme_von_medikamenten',
                        'label'   => 'einnahme_von_medikamenten',
                        'rules'   => 'trim|required'
                    ),



                    array(
                        'field'   => 'gewicht_angemessen',
                        'label'   => 'gewicht_angemessen',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'krankenhausaufenthalt_letzte_5_Jahre',
                        'label'   => 'krankenhausaufenthalt_letzte_5_Jahre',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'operationen_geplant',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'day',
                        'label'   => 'day',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'month',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'year',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'strabe_hausnummer',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'postleitzahl',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'name_telefonist_terminvereinbarung',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'geburtsjahr_kinder_ehefrau',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'welche_krankheiten',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'welche_medikamente',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'grund_fur_aufenthalt',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'welche',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'zusatzinformationen',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    )

                ),


            'member/create_contact' =>
                array(
                    array(
                        'field'   => 'anrede',
                        'label'   => 'anrede',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'name',
                        'label'   => 'name',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'vorname',
                        'label'   => 'vorname',
                        'rules'   => 'trim|required'
                    ),
                    array(
                        'field'   => 'email',
                        'label'   => 'Email',
                        'rules'   => 'trim'
                    ),
                    array(
                        'field'   => 'telefonnummer',
                        'label'   => 'telefonnummer',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'geburtsdatum',
                        'label'   => 'geburtsdatum',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'beruf',
                        'label'   => 'beruf',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'ort',
                        'label'   => 'ort',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'wann_angerufen',
                        'label'   => 'wann_angerufen',
                        'rules'   => 'trim|required'
                    ),

//                    array(
//                        'field'   => 'name_telefonist',
//                        'label'   => 'name_telefonist',
//                        'rules'   => 'trim|required'
//                    ),

                    array(
                        'field'   => 'gesetzlich_privat',
                        'label'   => 'gesetzlich_privat',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'wo_versichert',
                        'label'   => 'Wo versichert',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'beitrag',
                        'label'   => 'Beitrag',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'hohe_der_selbstbeteiligung',
                        'label'   => 'hohe_der_selbstbeteiligung',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'wie_lange_dort_versichert',
                        'label'   => 'wie_lange_dort_versichert',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'kunde_alleine_versichert',
                        'label'   => 'kunde_alleine_versichert',
                        'rules'   => 'trim|required'
                    ),



                    array(
                        'field'   => 'chronische_krankheiten',
                        'label'   => 'chronische_krankheiten',
                        'rules'   => 'trim|required'
                    ),


                    array(
                        'field'   => 'einnahme_von_medikamenten',
                        'label'   => 'einnahme_von_medikamenten',
                        'rules'   => 'trim|required'
                    ),



                    array(
                        'field'   => 'gewicht_angemessen',
                        'label'   => 'gewicht_angemessen',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'krankenhausaufenthalt_letzte_5_Jahre',
                        'label'   => 'krankenhausaufenthalt_letzte_5_Jahre',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'operationen_geplant',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim|required'
                    ),

                    array(
                        'field'   => 'day',
                        'label'   => 'day',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'month',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'year',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'strabe_hausnummer',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'postleitzahl',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'name_telefonist_terminvereinbarung',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'geburtsjahr_kinder_ehefrau',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'welche_krankheiten',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'welche_medikamente',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'grund_fur_aufenthalt',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'welche',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    ),

                    array(
                        'field'   => 'zusatzinformationen',
                        'label'   => 'operationen_geplant',
                        'rules'   => 'trim'
                    )

                )


);