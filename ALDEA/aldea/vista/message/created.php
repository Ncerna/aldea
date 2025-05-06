<?php
$messageId = isset($_GET['id']) ? $_GET['id'] : null;
?>

<div class="box box-warning">
  <div class="box-body">

<h4 style="text-align:center; font-size:1.5em;">
  <i class="fa fa-inbox" style="color:#f39c12; margin-right:10px;" aria-hidden="true"></i>
  Nuevo mensaje
</h4>


    <div class="form-group">
      <label for="send_type">Tipo de Envío:</label>
      <select class="form-control" name="send_type" id="send_type" onchange="changeSendType(this.value)">
         <option value="" >-----seleciones tipo-----</option>
        <option value="1" >Individual</option>
        <option value="2">Masivo</option>
      </select>
    </div>

    <div class="form-group" id="individual-recipients">
      <label for="recipient_id">Para: </label>
      <select id="recipient_id" class="js-example-basic-single form-control" style="width:100%;" >
      
      </select>
    </div>

    <div class="form-group" id="mass-recipients" style="display: none;">
      <label for="recipient_ids">Selecciona los Destinatarios (puedes seleccionar varios):</label>
      <div class="checkbox-container" id="students" >
      </div>
    </div>

    <div class="form-group">
      <input class="form-control" placeholder="Asunto:" id="subject" value="Asunto de ejemplo" autocomplete="off">
    </div>

    <div class="form-group">
      <label for="content">Contenido:</label>
      <textarea class="form-control" id="content" placeholder="Este es el contenido del mensaje" rows="3" autocomplete="off"></textarea>
    </div>

    <div class="form-group">
      <i class="fa fa-paperclip"></i>
      <label for="attachments">Archivos adjuntos:</label>
      <input type="file" id="attachments" name="attachments[]" multiple onchange="loadFiles(event)">
      <p class="help-block">Max. 10MB</p>
    </div>

    <div class="form-group">
      <div class="files_list"></div>
    </div>
  </div>

  <div class="box-footer">
    <div class="pull-right">
      <button type="button" class="btn btn-default" onclick="received()">
        <i class="fa fa-pencil"></i> cancelar
      </button>
      <button type="submit" class="btn btn-primary" onclick="sendMessage(this)">
        <i class="fa fa-fw fa-send"></i> Send
      </button>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(async function() {
     const messageId = <?php echo json_encode($messageId); ?>;
    if (messageId) {
        try {
            const response = await fetch(`../controlador/message/getById.php?id=${messageId}`);
            const result = await response.json();
            if (result.status && result.data) {
              loadMessageToForm(result.data);
            }
        } catch (error) {
            console.error('Error al verificar el mensaje:', error);
        }
    }else{
      loadRecipients('',[]);
    }
});

</script>
