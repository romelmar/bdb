<?php $this->load->view('includes/notification'); ?>
<?php $this->load->view('includes/notification_reg'); ?>
<form class="form-horizontal" role="form" id="order-search">
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Search By: </label>
        <div class="col-sm-3">
            <input size="16" type="text" placeholder="Data" name="search_cn" id="search_cn" class="form-control" />
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Search By Datum: </label>
        <div class="col-sm-3">
            <input size="16" type="text" placeholder="Start" name="date_start" id="date_start" class="form-control" />
            <input size="16" type="text" placeholder="End" name="date_end" id="date_end" class="form-control" />
            <button type="button" class="btn btn-primary" id="date_search">Default</button>
            <script type="text/javascript">

                $(function(){
                    $(document).ready(function() {
                        $('#date_start').datepicker({
                            format: 'mm/dd/yyyy'
                        });

                        $('#date_end').datepicker({
                            format: 'mm/dd/yyyy'
                        });
                    });
                });
            </script>
        </div>
    </div>

</form>

<?php    $this->load->view('admin/contacts_results'); ?>

