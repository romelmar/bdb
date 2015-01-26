    </div>
</div><!--/.fluid-container-->

<div class="container">
    <div class="footer"></div>
</div>
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->



<!--        <script src="--><?php //echo base_url(); ?><!--assets/js/jquery.js"></script>-->
<!--        <script src="--><?php //echo base_url(); ?><!--assets/js/google-code-prettify/prettify.js"></script>-->
<!--        <script src="--><?php //echo base_url(); ?><!--assets/js/bootstrap-transition.js"></script>-->
<!--        <script src="--><?php //echo base_url(); ?><!--assets/js/bootstrap-alert.js"></script>-->
<!--        <script src="--><?php //echo base_url(); ?><!--assets/js/bootstrap-modal.js"></script>-->
<!--        <script src="--><?php //echo base_url(); ?><!--assets/js/bootstrap-dropdown.js"></script>-->
<!--        <script src="--><?php //echo base_url(); ?><!--assets/js/bootstrap-scrollspy.js"></script>-->
<!--        <script src="--><?php //echo base_url(); ?><!--assets/js/bootstrap-tab.js"></script>-->
<!--        <script src="--><?php //echo base_url(); ?><!--assets/js/bootstrap-tooltip.js"></script>-->
<!--        <script src="--><?php //echo base_url(); ?><!--assets/js/bootstrap-popover.js"></script>-->
<!--        <script src="--><?php //echo base_url(); ?><!--assets/js/bootstrap-button.js"></script>-->
<!--        <script src="--><?php //echo base_url(); ?><!--assets/js/bootstrap-collapse.js"></script>-->
<!--        <script src="--><?php //echo base_url(); ?><!--assets/js/bootstrap-carousel.js"></script>-->
<!--        <script src="--><?php //echo base_url(); ?><!--assets/js/bootstrap-typeahead.js"></script>-->
<!--        <script src="--><?php //echo base_url(); ?><!--assets/js/bootstrap-affix.js"></script>-->
<!--        <script src="--><?php //echo base_url(); ?><!--assets/js/application.js"></script>-->

<?php if(isset($js[0])): ?>
    <?php foreach($js as $k => $v ): ?>
        <script src="<?php echo base_url(); ?>assets/js/<?php echo $v; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>


<!--        --><?php //$this->output->enable_profiler(TRUE);?>


 <script type="text/javascript">

     $(function(){
         $(document).ready(function() {

//---------------------------------Search-by-Date
             $('#date_start').datepicker({
                 format: 'mm/dd/yyyy'
             });

             $('#date_end').datepicker({
                 format: 'mm/dd/yyyy'
             });

<!--------------------------------- Multi input date field -------------------------             -->
             geburtsdatum = $( "select[name='year']").val() +"-"+$( "select[name='day']").val() +"-"+ $( "select[name='month']").val();
             $("input[name='geburtsdatum']").val(geburtsdatum );

             $( "select[name='day']" ).change(function() {
                 geburtsdatum = $( "select[name='year']").val() +"-"+$( "select[name='day']").val() +"-"+ $( "select[name='month']").val();
                 $("input[name='geburtsdatum']").val(geburtsdatum );
             });

             $( "select[name='month']" ).change(function() {
                 geburtsdatum = $( "select[name='year']").val() +"-"+$( "select[name='day']").val() +"-"+ $( "select[name='month']").val();
                 $("input[name='geburtsdatum']").val(geburtsdatum );
             });

             $( "select[name='year']" ).change(function() {
                 geburtsdatum = $( "select[name='year']").val() +"-"+$( "select[name='day']").val() +"-"+ $( "select[name='month']").val();
                 $("input[name='geburtsdatum']").val(geburtsdatum );
             });



             $('a[data-confirm]').click(function(ev) {
                 var href = $(this).attr('href');
                 if (!$('#dataConfirmModal').length) {
                     $('body').append('<div class="modal fade" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header">               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>                <h4 class="modal-title" id="myModalLabel">Security Question </h4>            </div>            <div class="modal-body">                ...            </div>            <div class="modal-footer">                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>                <a class="btn btn-primary" id="dataConfirmOK">OK</a>            </div>        </div>    </div>                        ');
                 }
                 $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
                 $('#dataConfirmOK').attr('href', href);
                 $('#dataConfirmModal').modal({show:true});
                 return false;
             });


             $('#dp2').datepicker({
                 format: 'mm/dd/yyyy'
             });
             $( document ).on( "keyup", "#order-search input", function() {
                 $('.orders-wrap').html(ajax_image);
                 var name = $("#order-search #search_cn").val();
                 var book_title = $("#order-search #search_bt").val();
                 var request = $.ajax({
                     url: "<?php echo base_url(); ?>index.php/<?php if($this->session->userdata('user_type') !='admin' ) echo 'member'; else echo $this->session->userdata('user_type'); ?>/order_search",
                     type: "POST",
                     data: {name: name},
                     dataType: "html"
                 });
                 request.done(function(msg) {
                     $(".orders-wrap").html( msg );
                 });

             });

             $('#date_search').click(function(){
                     var date_start = $("#date_start").val();
                     var date_end = $("#date_end").val();

                     var request = $.ajax({
                         url: "<?php echo base_url(); ?>index.php/<?php echo $this->session->userdata('user_type'); ?>/date_search",
                         type: "POST",
                         data: {date_start: date_start, date_end: date_end},
                         dataType: "html"
                     });
                     request.done(function(msg) {
                         $(".orders-wrap").html( msg );
                     });
                 }
             );


             $( document ).on( "keyup", "#product-search input", function() {
                 $('.products-wrap').html(ajax_image);
                 var author =     $("#product-search #search_a").val();
                 var book_title = $("#product-search #search_t").val();
                 var request = $.ajax({
                     url: "<?php echo base_url(); ?>index.php/admin/product_search",
                     type: "POST",
                     data: {name: author, book_title: book_title},
                     dataType: "html"
                 });
                 request.done(function(msg) {
                     $('.products-wrap').html( msg );
                 });

             });

             $( document ).on( "keyup", "#supplier-search input", function() {
                 $('.supplier-wrap').html(ajax_image);
                 var supp_name =     $("#supplier-search #search_sn").val();

//                 alert(supp_name);
                 var request = $.ajax({
                     url: "<?php echo base_url(); ?>index.php/admin/supplier_search",
                     type: "POST",
                     data: {name: supp_name},
                     dataType: "html"
                 });
                 request.done(function(msg) {
                     $('.supplier-wrap').html( msg );
                 });

             });



             $( document ).on( "keyup", "#stock-search input", function() {
                 $('.stock-wrap').html(ajax_image);

                 var title =     $("#stock-search #search_t").val();

                 var request = $.ajax({
                     url: "<?php echo base_url(); ?>index.php/admin/stock_search",
                     type: "POST",
                     data: {title: title},
                     dataType: "html"
                 });
                 request.done(function(msg) {
                     $('.stock-wrap').html( msg );
                 });

             });



             var ajax_image = '' +
                     '<img src="<?php echo base_url()."skin/ajax-loader.gif";?>" />';


             $( document ).on( "keyup", "#search", function() {
                 $('#search-div').html(ajax_image);
                 var fields = $(this).val();
                 var request = $.ajax({
                     url: "<?php echo base_url(); ?>index.php/site/search",
                     type: "POST",
                     data: {key: fields},
                     dataType: "html"
                 });
                 request.done(function(msg) {
                     $("#search-div").html( msg );
                 });
             });


//
//             $( document ).on( "hover", ".gallery .item", function() {
//                 $('.gallery '+"#"+this.id+' .caption').slideToggle();
//             });

             $("#search_cn").keyup( myAjax(".orders-wrap","", path ) );



             function myAjax(container, inputs, path ){

                 $(container).html(ajax_image);
                 if($(inputs).length > 1)  var fields = $(inputs).serializeArray();
                 else if($(inputs).length == 1) var fields = $(this).val();

                 var request = $.ajax({
                     url: "<?php echo base_url(); ?>index.php/" + path,
                     type: "POST",
                     data: {key: fields},
                     dataType: "html"
                 });
                 request.done(function(msg) {
                     $(container).html( msg );
                 });
             }

         });
     });
 </script>

</body>
</html>

