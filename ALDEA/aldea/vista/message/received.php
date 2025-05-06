<div class="box box-warning">
  <div class="box-body">

    <div class="box-header with-border">
      <div class="user-block">
        <span class="username" style="margin-left: 0px;"><a href="#"> <i class="fa fa-envelope" style="color:#f39c12;"></i> Mensajes recibidos</a></span>
      </div>
      <div class="box-tools" style="margin-top: -28px;">
        <div class="has-feedback">
          <input type="text" class="form-control input-sm" placeholder="Search Mail"  style="width: 180px;" oninput="filterMessages(this)">
          <span class="glyphicon glyphicon-search form-control-feedback"></span>
        </div>
       

      </div>
    </div>

    <div class="mailbox-controls" style="display: flex; justify-content: space-between; align-items: center;">
      <div style="flex-shrink: 0;">
        <button type="button" onclick="toggleSelectAll(this)" class="btn  btn-sm checkbox-toggle">
          <i class="fa fa-square-o"></i>
        </button>
        <div class="btn-group">
          <button type="button" onclick="deleteSelectedMessages(this)" class="btn  btn-sm">
            <i class="fa fa-trash-o"></i>
          </button>
        </div>
        <button type="button" onclick="loadAndDisplayMessages('',1,10,'received') " class="btn btn-sm">
          <i class="fa fa-refresh"></i>
        </button>
      </div>

    </div>
  </div>
  <!-- /.box-body -->
  <!-- /.box-header -->


  <div class="box-body no-padding">
    <div class="table-responsive mailbox-messages">
      <table id="mailboxTable" class="table table-hover table-striped">
        <tbody id="mailboxBody">
        </tbody>
        <tbody>
          <tr class="loading" style="display:none;">
            <td colspan="9" class="text-center">
              <div class="loader"></div>
              <div>Cargando...</div>
            </td>
          </tr>
        </tbody>
      </table>
      <!-- /.table -->
    </div>
    <!-- /.mail-box-messages -->
  </div>

  <div class="box-footer no-padding">
    <div class="mailbox-controls">
      <!-- Check all button -->
      <!-- /.btn-group -->
      <div class="pull-right" style="margin: 10px;">
        <div id="pagination-container"></div>
        <!-- /.btn-group -->
      </div>
      <!-- /.pull-right -->
    </div>
  </div>
  <!-- /.box-footer -->
</div>
<!-- /.box -->

<script type="text/javascript">
  $(document).ready(function() {
    moment.locale('es');
    loadAndDisplayMessages('', 1, 10, 'received');
  });
</script>