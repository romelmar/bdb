<div class="orders-wrap">
    <table class="table table-bordered">
        <thead>
        <?php foreach($fields as $field => $value ): ?>
            <th <?php if($sort_by == $field ) echo "class=\"sort_$sort_order\""; ?> > <?php echo anchor($user_type."/index/$field/".
                    (("asc" == $sort_order && $field == $sort_by )? 'desc' : 'asc').
                    $keyword,$value); ?>
            </th>
        <?php endforeach; ?>
        <th>Aktionen</th>
        </thead>
        <?php foreach($contacts as $contact): ?>
            <tr>
                <?php foreach($fields as $field => $value ): ?>
                    <td><?php
                        if($field == 'date_created' || 'geburtsdatum' == $field) echo  date("d M Y", strtotime( $contact->$field));
                        else if($field =='user_type') echo $user_type[$contact->$field];
                        else echo $contact->$field; ?>
                    </td>
                <?php endforeach; ?>
                <td class="actions">
                    <?php if( ((isset($member_id))? $member_id : NULL) == ((isset($contact->user_id))? $contact->user_id : NULL ) || $user_type == 'admin'): ?>
                        <?php echo anchor($user_type.'/edit_contact/'.$contact->id, '<span class="glyphicon glyphicon-edit"></span>', array('title' => 'bearbeiten', 'class' => 'btn btn-primary btn-small ' )); ?>
                    <?php endif; ?>

                    <?php if($this->uri->segment(2) !='users'): ?>
                        <?php echo anchor($user_type.'/view_contact/'.$contact->id, '<span class="glyphicon glyphicon-eye-open"></span>', array('title' => 'anzeigen', 'class' => 'btn btn-primary btn-small ' )); ?>
                    <?php endif; ?>
                    <?php if( ((isset($member_id))? $member_id : NULL) == ((isset($contact->user_id))? $contact->user_id : NULL ) || $user_type == 'admin'): ?>
                        <?php echo anchor($user_type.'/delete_contact/'.$contact->id, '<span class="glyphicon glyphicon-trash"></span> ', array('title' => 'löschen', 'class' => 'btn btn-danger btn-small ', 'data-confirm' => "Sicher, dass Sie den Datensatz löschen möchten?" )); ?>
                    <?php endif; ?>
                </td>
            </tr>

        <?php endforeach; ?>
    </table>

    <?php echo $pagination; ?>
</div>
