<h1 class="page-header"> <?php echo $title; ?> </h1>
<?php $this->load->view('includes/notification'); ?>
<?php $this->load->view('includes/notification_reg'); ?>
<?php echo form_open($action,$attributes); ?>

<table class="table table-striped">
    <?php foreach($form_element as $name => $attr ): ?>
        <tr id="<?php echo $name."_".$attr['type']; ?>">
            <td class="label-contact"><?php echo $attr['label']; ?></td>
            <td>
                <?php
                    $attr['attr']['name'] = $name;
                    $attr['attr']['id'] = $name;
                    $dd = set_value($name);
                    $set_day = set_value('day');
                    $set_month = set_value('month');
                    $set_year = set_value('year');

                    if(isset($row)){


                        if(isset($row[0]->$name)){
                            $attr['attr']['value'] = $row[0]->$name;
                            $dd =  $row[0]->$name;
                            $attr['value'] =  $row[0]->$name;

                        }


                        $geburtsdatum_set = (!isset($row[0]->geburtsdatum))? 1 : 0;

                        if(!($geburtsdatum_set)){

                            $date_db = explode('-',$row[0]->geburtsdatum);
                            $set_day = $date_db[2];
                            $set_month = $date_db[1];
                            $set_year = $date_db[0];
                        }
                        if($attr['type'] == 'password') $attr['attr']['value'] ='';
                    }
                    else $attr['attr']['value'] = set_value($name);



                    $day = array(
                        '1' => '1','2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10' => '10',
                        '11' => '11','12' => '12','13' => '13','14' => '14','15' => '15','16' => '16','17' => '17','18' => '18','19' => '19','20' => '20',
                        '21' => '21','22' => '22','23' => '23','24' => '24','25' => '25','26' => '26','27' => '27','28' => '28','29' => '29','30' => '30',
                        '31' => ''
                    );

                    $month = array(
                        '1' => 'January',
                        '2' => 'February',
                        '3' => 'March',
                        '4' => 'April',
                        '5' => 'May',
                        '6' => 'June',
                        '7' => 'July',
                        '8' => 'August',
                        '9' => 'September',
                        '10' => 'October',
                        '11' => 'November',
                        '12' => 'December');

                    for($i=1945,$x=0; $i <= 2014 ; $i++,$x++  ) $year[$i]=$i;



                    if('geburtsdatum' == $name){

                        echo '<div class="row">
                                <div class="col-xs-2">';
                                    echo form_dropdown('day', $day, $set_day ,"class='form-control required'");
                        echo '  </div>
                                <div class="col-xs-2">';
                                    echo form_dropdown('month', $month,  $set_month,"class='form-control'");
                        echo '  </div>
                                <div class="col-xs-2">';
                                    echo form_dropdown('year', $year,  $set_year,"class='form-control  required'");
                        echo '  </div>
                              </div>';


                    }

                    if($attr['type'] == 'hidden') echo form_hidden($name,$attr['value']);
                    if($attr['type'] == 'text') echo form_input($attr['attr']);
                    if($attr['type'] == 'password') echo form_password($attr['attr']);


                    if($attr['type'] == 'textarea') echo form_textarea($attr['attr']);
                    if($attr['type'] == 'select')echo form_dropdown($name, $attr['options'],  $dd,"class='".$attr['attr']['class']."'");
//                print_r($row[0]->name_telefonist); exit;
//                 if('name_telefonist' == $row[0]->$name) echo $dd.'xxxxxxxx'; exit;

//                $this->load->view('datepicker_js',$data['date_id']);
                   if(isset($attr['attr']['placeholder']) && $attr['attr']['placeholder'] == "DD/MM/YYYY") {
                       $data['date_id'] = $name;
                       $this->load->view('datepicker_js',$data);
                }

                    echo form_error($name);
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="2"><button type="submit" class="btn btn-primary btn-large pull-right col-md-3 ">Submit</button></td>
    </tr>

</table>


<?php echo form_close(); ?>
<!---->
<!--<pre>-->
<!--    --><?php //print_r($row); ?>
<!--</pre>-->