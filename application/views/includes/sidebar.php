<div class="span3">
    <div class="well sidebar-nav">
        <ul class="nav nav-list">
            <li class="nav-header">Product Categories </li>
            <?php $i=0; foreach($navs as $row): ?>
            <li class="<?php echo ${"cat_".$row->id}; ?>">  <?php echo anchor("site/category/".$row->id,  $row->name ); ?> </li>
            <?php $i++; endforeach; ?>
            <li class="nav-header">Search </li>
            <li> <br /> </li>
            <li >
                <?php echo form_open('site/search'); ?>
                    <?php echo form_input(array('name' => 'search', 'id' => 'search')); ?>
                <?php echo form_close(); ?>
            </li>
            <li class="nav-header">Can't Find a Book?</li>
            <li><br />
                <p>Please fill up the form to suggest a book that you can't find.</p>
                <div>
                    <?php echo form_open('site/suggest_a_book'); ?>

                    <div class="control-group">
                        <div class="controls ">
                            <div class="  padding-hack">
                                <?php echo form_input(array('name' => 'suggest_title','placeholder' => 'Title', 'id' => 'suggest_title' )); ?>
                                <?php echo form_error('suggest_title'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls ">
                            <div class="  padding-hack">
                                <?php echo form_input(array('name' => 'suggest_author','placeholder' => 'Author','id' => 'suggest_author' )); ?>
                                <?php echo form_error('suggest_author'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls ">
                            <div class="  padding-hack">
                                <textarea id="suggest_desc" name="suggest_desc" rows="5" style="width: 100%;" placeholder="Description" ></textarea>
                                <?php echo form_error('suggest_desc'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls ">
                            <div class="  padding-hack">
                                <?php echo form_input(array('name' => 'submit', 'type' => 'submit', 'value' => 'Submit', 'class' => 'btn btn-info btn-large'));?>
                            </div>
                        </div>
                    </div>



                    <?php echo form_close(); ?>
                </div>

            </li>

        </ul>
    </div><!--/.well -->
</div><!--/span-->
<!--------------------------------  main content wrap ---------------->
<div class="span9">
    <div class="row-fluid">
        <div class="span12">
            <div id="search-div" ></div>




