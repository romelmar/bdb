
<?php $this->load->view('includes/notification'); ?>

    <?php
    $fields_login = array(
        array(
            'alt' => 'Username',
            'name' =>  'username_login',
            'id'   =>  'username_login',
            'value' => set_value('username_login'),
            'placeholder' => 'Type your Username here..',
            'type' => 'text',
            'class' => 'form-control'

        ),
        array(
            'alt' => 'Password',
            'name' =>  'password_login',
            'id'   =>  'password_login',
            'placeholder' => 'Type your Password here..',
            'type' => 'password',
            'class' => 'form-control'
        ),
        array(
            'alt' => 'user_type',
            'name' =>  'user_type',
            'id'   =>  'user_type',
            'type' => 'hidden',
            'value' => $uid

        )

    );
    ?>
    <?php
    $attributes = array('class' => 'form-signin');
    echo form_open('login/validate_credentials',$attributes );
    ?>
        <h2 class="form-signin-heading">Please sign in</h2>
        <?php $i=0; foreach($fields_login as $input ): ?>
            <?php echo form_input($input); ?>
            <?php echo form_error($fields_login[$i]['id']); ?>
        <?php $i++; endforeach; ?>

<?php
$data = array(
    'name' => 'submit',
    'id' => 'button',
    'value' => 'Login',
    'type' => 'submit',
    'class' => 'btn btn-info'
);

$data_new = array(
    'name' => 'submit',
    'id' => 'button',
    'value' => 'Sign Up',
    'type' => 'submit',
    'class' => 'btn btn-info btn-large'
);

echo form_submit($data);
echo form_close(); ?>
