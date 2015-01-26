<?php

    if(!isset($header))  $header  = 'header';
//    if(!isset($sidebar)) $sidebar = 'none';
//    if(!isset($footer))  $footer  = 'footer';
//
   $this->load->view('includes/'.$header);
//   $this->load->view('includes/'.$sidebar);
//   $this->load->view($main_content);
//   $this->load->view('includes/'.$footer);



?>

<table class="table table-bordered">
    <thead>
    <?php foreach($fields as $field => $value ): ?>
        <th <?php if($sort_by == $field ) echo "class=\"sort_$sort_order\""; ?> > <?php echo anchor("admin/display/$field/".
                (("asc" == $sort_order && $field == $sort_by )? 'desc' : 'asc'),$value); ?></th>
    <?php endforeach; ?>
    </thead>
    <?php foreach($contacts as $contact): ?>
    <tr>

        <?php foreach($fields as $field => $value ): ?>
        <td><?php echo $contact->$field; ?></td>
        <?php endforeach; ?>
    </tr>
<?php endforeach; ?>
</table>

<?php echo $pagination; ?>