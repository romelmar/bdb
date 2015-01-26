<h1 class="page-header"> <?php echo $title; ?> </h1>

<div class="table table-responsive table-bordered"
    <table class="table table-hover">
        <colgroup>
            <col class="col-xs-4">
            <col class="col-xs-7">
        </colgroup>
        <tbody>
        <?php foreach($form_element as $name => $attr ): ?>
            <?php if($attr['type'] != 'hidden'): ?>

            <tr>
                <td class="bold"><?php echo $attr['label']; ?></td>
                <td>
                    <?php
                    if($attr['type'] == 'select' && $name != 'gesetzlich_privat' && $name != 'wie_lange_dort_versichert'){
                        if($row[0]->$name == 0)echo 'Nein';
                        else echo 'Ja';
                    }
                   else {
                       if(is_fade_field($date_fields,$name)) echo date("d M Y", strtotime( $row[0]->$name));
                       else {
                            if($name =='user_id'){
                                print_r($user->getUsers($row[0]->$name));
                            }
                           else echo  $row[0]->$name;
                       }


                   }

                    ?>

                </td>
            </tr>
           <?php endif; ?>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>



