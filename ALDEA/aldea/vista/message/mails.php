<script type="text/javascript" src="../js/message.js?rev=<?php echo time();?>"></script>

<div class="col-md-12">
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
         <div class="col-md-3">
         

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Mensajeria Interna</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">

                 <li><a  onclick="loadView('message/created.php')"  ><i class="fa fa-envelope-o"></i> Nuevo </a></li>
                  <li><a  onclick="loadView('message/received.php')" class="active" ><i class="fa fa-envelope" style="color:#f39c12;"></i> Recividos</a></li>
                  <li><a  onclick="loadView('message/sends.php')"  ><i class="fa fa-envelope-open " style="color:#f39c12;"></i> Enviados</a></li>

              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <!-- /.box -->
        </div>
        <div class="col-md-9" id="containes_message">
        </div>

      </div>
    </div>
    <!-- /.box-body -->
  <!-- /.box -->
</div>

<script type="text/javascript">
$(document).ready(function() {
  $('.js-example-basic-single').select2();
  $("#refres_add").hide();
  received();
     
 });
 function received(){
  loadView(`message/received.php`);
}


function edit(id){
  loadView(`message/created.php?id=${id}`);
}

function readMessage(btn,id,is_read){
  loadView(`message/read.php?id=${id}`);
  markRead(id,is_read);
}


</script>