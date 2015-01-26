<div class="orders-wrap">
    <table class="table table-bordered">
        <thead>
        <?php foreach($fields as $field => $value ): ?>
            <?php if(isset($pagination)): ?>
                <th <?php if($sort_by == $field ) echo "class=\"sort_$sort_order\""; ?> > <?php echo anchor("admin/index/$field/".
                        (("asc" == $sort_order && $field == $sort_by )? 'desc' : 'asc'),$value); ?>
                </th>
            <?php else: ?>

                <th> <?php echo  $value; ?></th>
            <?php  endif; ?>

        <?php endforeach; ?>
        <th>Aktionen</th>
        </thead>
        <?php foreach($contacts as $contact): ?>
            <tr>
                <?php foreach($fields as $field => $value ): ?>
                    <td><?php if($field == 'date_created' || 'geburtsdatum' == $field) echo  date("d M Y", strtotime( $contact->$field)); else echo $contact->$field; ?></td>
                <?php endforeach; ?>
                <td class="actions">
                    <?php echo anchor($this->session->userdata('user_type').'/edit_contact/'.$contact->id, '<span class="glyphicon glyphicon-edit"></span>', array('title' => 'bearbeiten', 'class' => 'btn btn-primary btn-small ' )); ?>
                    <?php echo anchor($this->session->userdata('user_type').'/view_contact/'.$contact->id, '<span class="glyphicon glyphicon-eye-open"></span>', array('title' => 'anzeigen', 'class' => 'btn btn-primary btn-small ' )); ?>
                    <?php echo anchor($this->session->userdata('user_type').'/delete_contact/'.$contact->id, '<span class="glyphicon glyphicon-trash"></span> ', array('title' => 'löschen', 'class' => 'btn btn-danger btn-small ' )); ?>
                </td>
            </tr>

        <?php endforeach; ?>
    </table>
    <?php if(isset($pagination))echo $pagination; ?>
</div>


