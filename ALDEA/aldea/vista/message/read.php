<?php
$messageId = isset($_GET['id']) ? $_GET['id'] : null;
?>

<!-- Box Comment -->
<div class="box box-war">
  <div class="box-header with-border">
    <div class="user-block">
      <img class="img-circle" src="../imagenes/default.png" alt="User Image">
      <span class="username"><a href="#" class="sender_name"></a></span>
      <span class="description date-time"></span>
    </div>
    <!-- /.user-block -->
    <div class="box-tools" style="margin-top: -40px;">
      <div class="box-tools pull-right" style="margin-left: auto;">
        <div class="btn-group btn-group-action" style="display: flex;"></div>
      </div>
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="attachment-block clearfix" style="border-radius: 5px;">
        <h4 class="attachment-heading modalSubject" style="color:#010514;margin:4px;font-weight:bold;text-transform: uppercase; ;"></h4>
    </div>

     <ol style="color: #3e8dc7bd;" id="modalRecipients">
    </ol>
    <!-- post text -->
    <p class="modalContent"></p>
    <!-- Attachment -->
    <div class="attachment-block clearfix">
      <div class="attachment-pushed">
       <div class="files_list"></div>
      </div>
    </div>
  </div>
  <!-- /.box-footer -->
  <div class="box-footer">
  </div>
</div>




<script type="text/javascript">
  $(document).ready(async function() {
    const messageId = <?php echo json_encode($messageId); ?>;
    if (messageId) {
      try {
        const response = await fetch(`../controlador/message/read.php?id=${messageId}`);
        const result = await response.json();
        if (result.status && result.data) {
          readMessageForm(result.data);
        }
      } catch (error) {
        console.error('Error al verificar el mensaje:', error);
      }
    } else {
      loadRecipients('', []);
    }
  });
</script>