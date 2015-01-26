<div class="span9">
    <div class="row-fluid">
        <div class="span12">
            <h1 class="page-header"><?php echo $title; ?> </h1>

            <div class="row-fluid">
                <div class="span6">
                    <?php $this->load->view('includes/notification'); ?>
                    <?php
                        $fields_login = array(
                            array(
                                'alt' => 'Username',
                                'name' =>  'username_login',
                                'id'   =>  'username_login',
                                'value' => set_value('username_login'),
                                'placeholder' => 'Type your Username here..',
                                'type' => 'text'

                            ),
                            array(
                                'alt' => 'Password',
                                'name' =>  'password_login',
                                'id'   =>  'password_login',
                                'placeholder' => 'Type your Password here..',
                                'type' => 'password'
                            ),
                            array(
                                'alt' => 'user_type',
                                'name' =>  'user_type',
                                'id'   =>  'user_type',
                                'type' => 'hidden',
                                'value' => 1

                            )

                        );
                    ?>

                    <div class="form-wrap well">
                        <h4>Login</h4>
                        <?php
                        echo form_open('login/validate_credentials');
                       ?>
                        <?php foreach($fields_login as $input ):?>
                        <div class="control-group">
                            <div class="controls <?php if(isset($input['class'])) echo $input['class']; ?>">
                                <?php echo form_input($input); ?>
                                <?php echo form_error('username_login'); ?>
                            </div>
                        </div>
                        <?php endforeach; ?>

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
                        echo form_close();

                        ?>
                    </div>


                </div>
                <div class="span6">
                    <?php $this->load->view('includes/notification_reg'); ?>
                    <?php $post = $this->session->flashdata('post'); ?>
                    <?php echo $this->session->flashdata('firstname'); ?>
                    <div class="form-wrap well">
                        <h4>Sign Up</h4>
                        <?php

                        $fields = array(
                            array(
                                'alt' => 'Firstname',
                                'name' =>  'firstname',
                                'id'   =>  'firstname',
                                'value' => set_value('firstname', $post['firstname']),
                                'placeholder' => 'Type your Firstname'
                            ),
                            array(
                                'alt' => 'Lastname',
                                'name' =>  'lastname',
                                'id'   =>  'lastname',
                                'value' => set_value('lastname', $post['lastname']),
                                'placeholder' => 'Type your Lastname'
                            ),
                            array(
                                'alt'  => 'Contact Number',
                                'name'  => 'contactNo',
                                'id'    => 'contactNo',
                                'value' => set_value('contactNo', $post['contactNo']),
                                'placeholder' => 'Type your Contact Number'
                            ),
                            array(
                                'alt'  => 'Address',
                                'name'  => 'address',
                                'id'    => 'address',
                                'value' => set_value('address', $post['address']),
                                'placeholder' => 'Type your Address'
                            ),
                            array(
                                'alt'  => 'Email',
                                'name'  => 'email',
                                'id'    => 'email',
                                'value' => set_value('email', $post['email']),
                                'placeholder' => 'Type a Valid Email'
                            )
                        );

                        $login_info = array(
                            array(
                                'alt' => 'Username',
                                'name' =>  'username',
                                'id'   =>  'username',
                                'value' => set_value('username', $post['username']),
                                'placeholder' => 'Type your Username'
                            ),
                            array(
                                'alt' => 'Password',
                                'type' => 'password',
                                'name' =>  'password',
                                'id'   =>  'password',
                                'value' => set_value('password'),
                                'placeholder' => 'Type your Password'
                            ),
                            array(
                                'alt' => 'Confirm Password',
                                'type' => 'password',
                                'name' =>  'password2',
                                'id'   =>  'password2',
                                'value' => set_value('password2'),
                                'placeholder' => 'Confirm Password'
                            )

                        );


                       ?>
                        <?php  echo form_open('login/create_member'); ?>
                        <fieldset>
                            <legend> Personal Information </legend>



                        <?php foreach($fields as $input ):?>
                        <div class="control-group">
                            <div class="controls <?php if(isset($input['class'])) echo $input['class']; ?>">
                                <?php echo form_input($input); ?>
                                <?php echo form_error($input['id']); ?>
                            </div>
                        </div>
                        <?php endforeach; ?>

                        </fieldset>
                        <br />
                        <fieldset>
                            <legend> Login Info</legend>
                            <?php foreach($login_info as $input ):?>
                            <div class="control-group">
                                <div class="controls <?php if(isset($input['class'])) echo $input['class']; ?>">
                                    <?php echo form_input($input); ?>
                                    <?php echo form_error($input['id']); ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <p>
                                <em> By clicking Sign Up, you agree to our <?php echo anchor('site/terms_and_agreement','TERMS AND CONDITIONS '); ?> and that you have read our <?php echo anchor('site/general_terms_of_use','General TERMS OF USE'); ?>.</em>
                            </p>

                            <?php echo form_submit($data_new); ?>

                        </fieldset>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>


        </div><!--/span-->
    </div><!--/row-->
</div><!--/span-->
