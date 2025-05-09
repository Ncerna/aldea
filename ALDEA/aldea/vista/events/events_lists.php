
<script type="text/javascript" src="../js/publications.js?rev=<?php echo time();?>"></script>
<style>
/* Estilos para tabs */
.nav-tabs > li.active > a,
.nav-tabs > li.active > a:hover {
    color: #fff;
    background-color: #5fe5d9;
}

</style>

<div class="col-md-12">
    <div class="box box-warning">
        <div class="box-body">
           
            <ul class="nav nav-tabs" id="paymentTabs">
                <li class="active"><a href="#list" data-toggle="tab"><i class="fa fa-list"></i> Lista Eventos.</a></li>
                <li><a href="#create" data-toggle="tab"><i class="fa fa-plus"></i> Crear nuevo</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="list">
                   <div class="box-header with-border">
                    <div class="user-block">
                      <span class="username"><a href="#">Lista se eventos</a></span>
                      <span class="description"></span>
                    </div>

                    <div class="box-tools" style="margin-top: -28px;">
                      <div class="has-feedback">
                        <input type="text" class="form-control input-sm" id="eventSearch" placeholder="Search events" style="width: 180px;" oninput="filterEvents(this)">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                      </div>
                    </div>
                  </div>

                  <div class="box-body">
                    <div class="custom-table-container">
                      <div class="table-responsive">
                        <table class="table table-condensed" id="eventsTable">
                          <thead>
                            <tr>
                              <th>N°</th>
                              <th>Imagen</th>
                              <th>Titulo</th>
                              <th>Fecha inicio</th>
                              <th>Fecah finalización</th>
                              <th>Zona</th>
                              <th>Link virtual</th>
                              <th>¿Aprovado?</th>
                              <th>Accion</th>
                            </tr>
                          </thead>
                          <tbody id="tlb_events">
                            <!-- Aquí van los eventos -->
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
                      </div>
                      <div id="pagination-container"></div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="create">
                  <div class="box-header with-border">
                    <div class="user-block">
                      <img class="img-circle" src="../imagenes/default.png" alt="User Image">
                      <span class="username"><a href="#">Nueva publicación</a></span>
                      <span class="description"></span>
                    </div>

                    <div class="box-tools" style="margin-top: -35px;">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse" onclick="toggleInvoice(this)">
                        <i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div>

                  <div class="invoice-custom">
                    <div class="box-body">
                      <div class="grid-container">
                        <div>
                          <label for="title">Título del Evento:</label>
                          <input type="text" id="title" name="title" class="form-control" required autocomplete="off">
                        </div>
                        <div>
                          <label for="start_date">Fecha y Hora de Inicio:</label>
                          <input type="datetime-local" id="start_date" name="start_date" class="form-control" required oninput="handleDateTime(this)">
                        </div>
                        <div>
                          <label for="end_date">Fecha y Hora de Fin:</label>
                          <input type="datetime-local" id="end_date" name="end_date" class="form-control" required oninput="handleDateTime(this)">
                        </div>
                        <div>
                          <label for="location">Ubicación:</label>
                          <input type="text" id="location" name="location" class="form-control" maxlength="512" autocomplete="off">
                        </div>
                      </div>

                      <div class="grid-container">
                        <div>
                          <label for="background_color">Color de Fondo:</label>
                          <input type="color" id="background_color" name="background_color" class="form-control">
                        </div>
                        <div>
                          <div class="form-group form-check">
                            <input type="checkbox" id="is_virtual" name="is_virtual" class="form-check-input" onchange="toggleVirtualLink(this)">
                            <label for="is_virtual" class="form-check-label">Evento Virtual</label>
                          </div>
                          <div id="virtual_link_container" style="display:none;">
                            <label for="virtual_link">Enlace para evento virtual:</label>
                            <input type="url" id="virtual_link" name="virtual_link" class="form-control" placeholder="https://" autocomplete="off">
                          </div>
                        </div>
                        <div>
                          <label for="description">Descripción:</label>
                          <textarea id="description" name="description" class="form-control" rows="2" required></textarea>
                        </div>
                        <div>
                          <label for="recipient_type">¿Para quién va dirigido?</label>
                          <select id="recipient_type" name="recipient_type" class="form-control" onchange="loadRecipients(this,[])">
                            <option value="public">Público</option>
                            <option value="role">Rol</option>
                            <option value="grade">Grado</option>
                            <option value="individual">Individual</option>
                          </select>
                        </div>
                      </div>

                      <div class="grid-container">
                        <div>
                          <div id="recipient_selector"></div>
                        </div>
                        <div>
                          <label for="attachments">Archivos adjuntos:</label>
                          <div class="custom-input-file">
                            <input type="file" id="attachments" name="attachments[]" class="form-control input-file" multiple onchange="loadFiles(event)">
                            <label for="images" for="file-upload" class="upload-label">+</label>
                          </div>
                        </div>
                        <div>
                          <div class="col-6">
                            <div class="profile">
                              <div class="previewContainer" id="selectedImage">
                                <img id="imgPreview" src="../imagenes/default.png" alt="Preview of the selected image" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <div>
                          <div class="col-6">
                            <div id="imageList"></div>
                          </div>
                        </div>

                        <!-- Overlay and Modal to show the large image -->
                        <div id="overlay"></div>
                        <div id="largeImage">
                          <button id="closeModal">Close</button>
                          <img id="displayedImage" src="" alt="Large Image" />
                        </div>

                        <!-- Resultados -->
                        <div id="recipients-display" class="mt-4">
                          <div id="recipient_selector" class="mb-3"></div>
                        </div>
                      </div>

                      <div class="modal-footer">
                        <button class="btn btn-primary btn-sm" onclick="sendForm()">
                          <i class="fa fa-check"><b>&nbsp;Registrar</b></i>
                        </button>
                        <button type="button" class="btn btn-default btn-sm" onclick="clearFormInputs()" data-dismiss="modal">
                          <i class="fa fa-close"><b>&nbsp;Cerrar</b></i>
                        </button>
                      </div>
                    </div>
                  </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<style>
  .modal {
    position: fixed;
    z-index: 9999;
    left: 0; top: 0;
    width: 100%; height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.5);
  }
  .modal-content img {
    max-width: 100px;
    max-height: 100px;
    border-radius: 4px;
    cursor: pointer;
    object-fit: cover;
  }
</style>


<form autocomplete="false" onsubmit="return false">
  <div class="modal fade" id="eventDetailsModal">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content" style=" padding:20px; border-radius:8px; max-width:600px; margin: 50px auto; position: relative;border-radius: 15px;"> <!-- Borde redondeado en el modal -->
        <div class="modal-header" style="padding: 20px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="box-title" id="dates_student"></h4>
        </div>
        <div class="modal-body" style="max-height: 70vh; overflow-y: auto; scroll-behavior: smooth;">
          <!-- Content goes here -->
      
            <h2 id="modalTitle"></h2>
            <p id="modalDescription"></p>
            <p><strong>Fecha inicio:</strong> <span id="modalStartDate"></span></p>
            <p><strong>Fecha fin:</strong> <span id="modalEndDate"></span></p>
            <p><strong>Ubicación:</strong> <span id="modalLocation"></span></p>
            <p><strong>Virtual:</strong> <span id="modalIsVirtual"></span></p>
            <p><strong>Link virtual:</strong> <a href="#" target="_blank" id="modalVirtualLink"></a></p>
            <h3>Receptores</h3>
            <ul id="modalRecipients"></ul>
            <h3>Imágenes adjuntas</h3>
            <div id="modalAttachments" style="display:flex; gap:10px; flex-wrap: wrap;"></div>
        
      

        </div>
        <div class="modal-footer">
            <div style="display: flex;gap: 10px;">
          <button  class="btn btn-block btn-secondary btn-sm" data-dismiss="modal">
            <i class="fa fa-times-circle"></i> Cancelar
          </button>
         
        </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</form>



<script type="text/javascript">
  $(document).ready(function() {

$("#refres_add").hide();
    populateRecipientTypes();
    listPublications();
} );

 function filterEvents(inputElement) {
    var term = inputElement.value.toLowerCase();
    var results = originalEvents.filter(event => 
        Object.values(event).some(
            val => val && val.toString().toLowerCase().includes(term)
        )
    );
    renderEvents(results);
}
</script>