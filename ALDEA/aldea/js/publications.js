var _TYPES = ['PUBLIC', 'ROLE', 'GRADE', 'INDIVIDUAL'];

var TYPE_CONFIG = {
    ROLE: { label: 'Selecciona un rol:', selectId: 'role_select' },
    GRADE: { label: 'Selecciona un grado:', selectId: 'grade_select' },
    INDIVIDUAL: { label: 'Selecciona un usuario:', selectId: 'user_select' },
    // DEPARTMENT: { label: 'Selecciona un departamento:', selectId: 'department_select' }
};

var publication ={id:'',recipients:[]};
var attachments = [];
var originalEvents = [];
var eventsPaginator = null;


function populateRecipientTypes(selectedType) {
    const $select = $('#recipient_type');
    $select.empty(); 
    $select.append('<option value="">---Seleccione---</option>'); 
    _TYPES.forEach(type => {
        const value = type.toLowerCase();
        const text = type.charAt(0) + type.slice(1).toLowerCase(); 
        const selectedAttr = (value === selectedType) ? ' selected' : '';

        $select.append(`<option value="${value}"${selectedAttr}>${text}</option>`);
    });
}

async function loadRecipients(selectOrId, selectedIds) {
    var $select = typeof selectOrId === 'string' ? $('#' + selectOrId) : $(selectOrId); 

    if ($select.length === 0) { console.error('No se encontró el select recipient_type'); return; } // Validar que el select exista
    var typeValue = $select.val(); 
    if (!typeValue) return; // Si no hay valor, salir
    var type = typeValue.toUpperCase(); // Convertir a mayúsculas

    if (selectedIds?.length === 0) { // Si no hay IDs seleccionados
        selectedIds = publication.recipients
            ?.filter(r => (r.recipient_type || '').toLowerCase() === type.toLowerCase()) // Filtrar por tipo
            .map(r => parseInt(r.recipient_id)) || []; // Convertir IDs a enteros
    }

    var $selector = $('#recipient_selector'); // Obtener el contenedor de opciones
    $selector.empty(); // Limpiar el contenedor
    if (type === 'PUBLIC' || !TYPE_CONFIG[type]) return; // Salir si es PUBLIC o tipo no existe
    var { label, selectId } = TYPE_CONFIG[type]; // Obtener datos del tipo desde config
    $selector.append(`<label>${label}</label>`); // Agregar etiqueta
    $selector.append(`<div id="${selectId}" class="checkbox-container"></div>`); // Agregar contenedor para checkboxes
    await loadOptions(type.toLowerCase(), selectId, selectedIds); // Cargar opciones dinámicamente
};


async function loadOptions(type, selectId, selectedIds) {
    try {
        const response = await fetch(`../controlador/event/recipients.php?type=${type}`);
        if (!response.ok) throw new Error('Error en la respuesta');
        const data = await response.json();
        const select = $("#" + selectId);
        select.empty();
        select.append('<option value="">Seleccione una opción</option>');

        data.forEach(item => {
           const isChecked = (Array.isArray(selectedIds) ? selectedIds : []).includes(item.id) ? 'checked' : '';
            select.append(`
            <div class="checkbox-item">
                <input 
                    type="checkbox" 
                    id="${selectId}_${item.id}" 
                    value="${item.recipient_id}" 
                    ${isChecked ? 'checked' : ''}
                     onclick="toggleRecipient(this ,${item.id})"
                >
                <label for="${selectId}_${item.id}">${item.name}</label>
            </div>
        `);
        });

    } catch (error) {
        console.error('Error cargando destinatarios:', error);
    }
}

function toggleRecipient(element, id) {
    var isChecked = $(element).is(':checked'); 
    var recipientType = $('#recipient_type').val().toLowerCase();
    if (isChecked) {
        publication.recipients.push({  id: null,  recipient_type: recipientType, recipient_id: id });
    } else {
        publication.recipients = publication.recipients.filter(r => Number(r.recipient_id) !== Number(id));
    }
}



async function sendForm(btn) {
  const data = new FormData();
  if(!validateForm()) return;
  data.append('id', publication.id ? publication.id : '');
  data.append('title', $('#title').val());
  data.append('description', $('#description').val());
  data.append('start_date', $('#start_date').val());
  data.append('end_date', $('#end_date').val());
  data.append('location', $('#location').val());
  data.append('background_color', $('#background_color').val());
  data.append('recipient_type', $('#recipient_type').val());
  data.append('is_virtual', $('#is_virtual').is(':checked') ? 1 : 0);
  data.append('virtual_link', $('#virtual_link').val());
   data.append('organizer_id', await loadUserSessionId());
  
  data.append('recipient_ids', JSON.stringify(publication.recipients));

  // Archivos adjuntos nuevos
  var newFileIndex = 0;
      attachments.forEach((file) => {
        if (!file.id && file.file) {
            data.append(`attachments[${newFileIndex}]`, file.file);
            data.append(`new_files_meta[${newFileIndex}]`, JSON.stringify({isFavorite: file.isFavorite || 0}));
            newFileIndex++;
        }
    });
   // Archivos adjuntos existentes
    var existingFiles = attachments
        .filter(file => file.id)
        .map(file => ({ id: file.id,status:file.status, isFavorite: file.isFavorite || 0 }));

    data.append('existing_files', JSON.stringify(existingFiles));

  try {
    const response = await fetch('../controlador/event/save.php', {
      method: 'POST',
      body: data
    });

    const result = await response.json();

    if (result.status) {
        Swal.fire({ toast: true, position: 'top-right', icon: 'success', title: result.msg, text: '', showConfirmButton: false, timer: 3000 });
       $('#paymentTabs a[href="#list"]').tab('show');
       listPublications('', 1, 10);
       clearFormInputs();
    } else {
        Swal.fire({ toast: true, position: 'top-right', icon: 'error', title: result.msg , text: '', showConfirmButton: false, timer: 3000 });
    }
  } catch (error) {

     Swal.fire("Mensaje de error", error.message || error, "error");

  }
}

async function listPublications(userId = '', page = 1, limit = 10) {
   $(".loading").fadeIn();
    //$('#tlb_events').empty();
    try {
    
        const response = await fetch(`../controlador/event/list.php?user_id=${userId}&page=${page}&limit=${limit}`);
        const events = await response.json();

        if (events && events.status) {
            originalEvents = events.data.list;
            renderEvents(events.data.list);
            if(!eventsPaginator) {
           
                initializePaginator(userId, '', events);
            } else {
       
                updatePaginator(events.data.list,result.data.size);
            }
        } else {
            renderEvents([]); 
        }
    } catch (error) {
       // renderEvents([]); // Para mostrar el mensaje si hay error
    }
    $(".loading").fadeOut();
}


function renderEvents(events) {

    var $tbody = $('#tlb_events');
    $tbody.empty();
    if (!events || events.length === 0) {
        $tbody.append(
            `<tr>
                <td colspan="9" class="text-center py-4">
                    <strong>Crear tu primer evento</strong>
                </td>
            </tr>`
        );
        return;
    }

    $.each(events, function(index, event) {
        var startDate = moment(event.start_date).format('YYYY-MM-DD');
        var endDate = moment(event.end_date).format('YYYY-MM-DD');
        var image = event.image 
            ? `<img src="${event.image}" alt="Foto" class="img-thumbnail" style="width:50px;height:50px;">`
            : '<div class="text-muted">Sin imagen</div>';

        var virtualLink = event.virtual_link
            ? `<a href="${event.virtual_link}" target="_blank">Enlace</a>`
            : 'N/A';

        var approved = event.is_approved ? '✅' : '⚠️';

        $tbody.append(`
            <tr>
                <td>${index + 1}</td>
                <td>${image}</td>
                <td>${event.title || 'N/A'}</td>
                <td>${startDate}</td>
                <td>${endDate}</td>
                <td>${event.location || 'N/A'}</td>
                <td>${virtualLink}</td>
                <td>${approved}</td>
                <td> <div style="display: flex; gap: 5px;">
                ${actionButtons(event.id, event.organizer_id ,event.is_approved )}
                 </div></td>

            </tr>
        `);
    });
}


function handleDateTime(element) {
  if ($(element).val().length >= 10) $(element).blur();
} 
async function editEvent(eventId) {
  try {
    // Mostrar loader si lo deseas
    $(".loading").fadeIn();

    // Petición GET a tu API para obtener datos del evento
    const response = await fetch(`../controlador/event/getByIid.php?id=${eventId}`);

    if (!response.ok) {
      throw new Error('Error al obtener el evento');
    }

    const result = await response.json();

    // Ocultar loader
    $(".loading").fadeOut();

    // Aquí puedes mostrar los datos en un formulario/modal
    if (result && result.status && result.data) {
      clearFormInputs()
       populateEventForm(result.data)
    } else {
    Swal.fire({ toast: true, position: 'top-right', icon: 'error', title: result.msg, text: '', showConfirmButton: false, timer: 3000 });
    }
  } catch (error) {
    $(".loading").fadeOut();
    alert('Error al cargar el evento: ' + error.message);
    console.error(error);
  }
}

  function populateEventForm(event) {
     $('#paymentTabs a[href="#create"]').tab('show');
    if (!event) return;
    publication.id = event.id;

    $('#title').val(event.title);
    $('#description').val(event.description);
    $('#start_date').val(event.start_date);
    $('#end_date').val(event.end_date);
    $('#location').val(event.location);
    $('#background_color').val(event.background_color);
    $('#is_virtual').prop('checked', !!event.is_virtual);
    $('#virtual_link').val(event.virtual_link);

    var recipient_type2 = event?.recipients?.[0]?.recipient_type;
    populateRecipientTypes(event?.recipient_type || recipient_type2 || 'public');

    toggleVirtualLink($('#is_virtual'));
    attachments = event?.attachments ?? [];

    attachments.forEach(function(file, index) {
        updateFilePreview('../' + file.file_path, index, file.isFavorite);
    });
    updateSelectedImage();
     var selectedIds = event?.recipients?.map(r => parseInt(r.recipient_id)) || [];
     console.log(selectedIds)
    loadRecipients($('#recipient_type'), selectedIds);

     publication.recipients = (event?.recipients || []).map(item => ({
      id: item.id,   recipient_type: item.recipient_type, recipient_id: item.recipient_id }));
  }





function initializePaginator(userId, searchTerm, result) {
    if(!eventsPaginator) {
        eventsPaginator = new Paginator({
            container: '#pagination-container',
            initialData: {
                total: Number(result.data.total) || 0,
                currentPage:Number(result.data.page) || 1,
                perPage: Number(result.data.size) || 10
            },
            onPageChange: (data) => {
                listPublications(userId, data.currentPage, data.perPage, searchTerm);
            }
        });
    }
}

function updatePaginator(result,selectedSize = null) {
   /* if(eventsPaginator) {
         console.log(selectedSize)
        eventsPaginator.updateData({
           total: Number(result.data.total) || 0,
           currentPage:Number(result.data.page) || 1,
           perPage: selectedSize ? Number(selectedSize) : Number(result.data.size) || 10
        });
    }*/
}


//||||||||||||||||||||||||||||
//||||||||||UTILS|||||||||||||
//||||||||||||||||||||||||||||


function actionButtons(eventId,organizer_id, is_approved) {
    var currentUser = JSON.parse(localStorage.getItem('login'));
    console.log(currentUser)
    var isAuthor = currentUser && organizer_id === Number(currentUser.user);
    var isAdmin = currentUser && currentUser.rol_nombre === 'ADMINISTRADOR';
    let buttons = '';
    if (isAuthor || isAdmin) {
      buttons += `
        <button class="btn btn-sm btn-warning " onclick="editEvent(${eventId})" title="Editar">
          <i class="fa fa-edit"></i>
        </button>
        <button class="btn btn-sm btn-danger" onclick="deleteEvent(${eventId})" title="Eliminar">
          <i class="fa fa-trash"></i>
        </button>
      `;
    }
  
    if (isAdmin) {
      const btnClass = is_approved ? 'btn-secondary' : 'btn-success';
      const iconClass = is_approved ? 'fa-times' : 'fa-check';
      const action = is_approved ? 'disapprove' : 'approve';
      const title = is_approved ? 'Desaprobar' : 'Aprobar';
  
      buttons += `
        <button 
          class="btn btn-sm ${btnClass} btn-approve-toggle" 
          onclick="handleEventAction(this, ${eventId}, '${action}')" 
          title="${title}">
          <i class="fa ${iconClass}"></i>
        </button>
      `;
    }
  
   /* if (currentUser) {
          const starIcon = isFavorite ? 'fa-star' : 'fa-star-o'; 
      buttons += `
        <button class="btn btn-sm btn-info btn-favorite" onclick="handleEventAction(this, ${eventId}, 'favorite')" title="Marcar como favorito">
           <i class="fa ${starIcon}"></i>
        </button>
        <button class="btn btn-sm btn-primary btn-comments" onclick="openComments(${eventId})" title="Comentarios">
          <i class="fa fa-comments"></i>
        </button>
      `;
    }*/
  
    return buttons;
  }
  
  

  async function handleEventAction(btn, eventId, endpoint) {
    var approver_id = await loadUserSessionId();
    try {
       endpoint = `event-${endpoint}.php`;
      const response = await fetch(`../controlador/event/${endpoint}?id=${eventId}&approver_id=${approver_id}`, {
        headers: { 'Content-Type': 'application/json' }
      });
  
      if (!response.ok) throw new Error(`Error en la respuesta: ${response.status}`);
      const result = await response.json();
      if (result.status) {
        Swal.fire({ toast: true, position: 'top-right', icon: 'success', title: result.msg, text: '', showConfirmButton: false, timer: 3000 });
        listPublications('',1,10);
      } else {
        Swal.fire({ toast: true, position: 'top-right', icon: 'error', title: 'Failed to mark as favorite', text: '', showConfirmButton: false, timer: 3000 });
      }
    } catch (e) {
      return Swal.fire("Warning", `Error: ${e.message || e}`, "warning");
    }
  }
  async function deleteEvent(eventId) {
    try {
        const url = `../controlador/event/event-delete.php?id=${eventId}`;
        
        const response = await fetch(url, {
            headers: { 'Content-Type': 'application/json' }
        });

        if (!response.ok) throw new Error(`Error en la respuesta: ${response.status}`);
        const result = await response.json();
      if (result.status) {
        Swal.fire({ toast: true, position: 'top-right', icon: 'success', title: result.msg, text: '', showConfirmButton: false, timer: 3000 });
        listPublications('',1,10);
      } else {
        Swal.fire({ toast: true, position: 'top-right', icon: 'error', title: result.msg, text: '', showConfirmButton: false, timer: 3000 });
      }
    } catch (e) {
        Swal.fire("Warning", `Error: ${e.message || e}`, "warning");
    }
}

  



function updateFilePreview(src, index,isSelected) {
    var container = $('<div class="image-container"></div>');
    var img = $('<img>').attr('src', src).attr('id', 'image-' + index);
    var radio = $('<input type="radio" name="selection" class="select custom-radio" data-index="' + index + '" />');
    if (isSelected) radio.prop('checked', true);
    var removeBtn = $('<button class="remove-btn">X</button>');
    removeBtn.on('click', function() {
        removeImage(index); 
    });
    radio.on('change', function() {
       attachments.forEach(function(att) { att.isFavorite = 0; });
       attachments[index].isFavorite = 1;
        updateSelectedImage(); 
    });
    img.on('click', function() {
        showLargeImage(src); 
    });
    container.append(radio).append(removeBtn).append(img);
    $('#imageList').append(container);
}

function loadFiles(event) {
  var files = event.target.files; // Obtener archivos seleccionados
  $.each(files, function(index, file) {
    var reader = new FileReader(); // Crear un objeto FileReader
    reader.onload = function(e) {
      updateFilePreview(e.target.result, attachments.length, false); // Actualizar vista previa
      attachments.push({
        id: null,
        file: file, 
        name: file.name,
        type: file.type,
        path: null,
        status: 1,
        isFavorite: 0
      });
    };

    reader.readAsDataURL(file); 
  });
}

function removeImage(index) {
$('#image-' + index).closest('.image-container').remove();
 attachments[index].status = 0;
 deleteAttachmentBy(attachments[index].id);
$('#imageList .select').each(function(i) { 
  $(this).data('index', i);
});
 updateSelectedImage();
 console.log('Imagen eliminada:', attachments[index]);
}


function updateSelectedImage() {
  var selectedImageSrc = $('#imageList .select:checked').siblings('img').attr('src');
  console.log("====>:" ,selectedImageSrc)
  if (selectedImageSrc) {
      $('#imgPreview').attr('src', selectedImageSrc); 
  } else {
      $('#imgPreview').attr('src', '');
  }
}

function showLargeImage(imageSrc) {
  console.log(imageSrc)
  $('#displayedImage').attr('src', imageSrc);
  $('#overlay').show(); 
  $('#largeImage').show(); 
}

$('#closeModal').on('click', function() {
 $('#largeImage').hide(); 
 $('#overlay').hide();
});

$('#overlay').on('click', function() {
 $('#largeImage').hide(); 
 $('#overlay').hide();
});

function toggleInvoice(button) {
  $(button).closest('.tile').find('.invoice-custom').slideToggle();
  $(button).find('i').toggleClass('fa-plus-circle fa-minus-circle');
}

function clearFormInputs() {
    $('#title').val('');
    $('#start_date').val('');
    $('#end_date').val('');
    $('#location').val('');
    $('#description').val('');
    $('#virtual_link').val('');
    $('#background_color').val('#01FF70');
    $('#recipient_type').prop('selectedIndex', 0);
    $('#is_virtual').prop('checked', false);
    $('#virtual_link_container').hide();
    $('#attachments').val('');
    $('#imgPreview').attr('src', '../imagenes/default.png');
    //$('#selectedImage').hide();
     publication ={id:'',recipients:[]};
    $('#imageList').empty();
    $('#recipient_selector').empty();
    $('.form-control').css('border', '');
    $("#recipient_selector").css('border', '');
}
function toggleVirtualLink(checkbox) {
    if ($(checkbox).is(':checked')) {
        $('#virtual_link_container').show();
    } else {
        $('#virtual_link_container').hide();
        $('#virtual_link').val('');
    }
}
function deleteAttachmentBy(id){
    console.log('delete',id )
}
function handleLimitChange(){
     var newLimit = parseInt($('#limit-selector').val());
    var searchTerm = $('#eventSearch').val();
    
    // Reiniciar a página 1 con los nuevos parámetros
    listPublications('', 1, newLimit);
}


function validateForm() {
    let isValid = true;
    const now = moment();
    $('.form-control').css('border', '');
    if (!validateRequired('#title', 'Título es requerido')) isValid = false;
    if (!validateRequired('#start_date', 'Fecha inicial es requerida')) isValid = false;
    if (!validateRequired('#end_date', 'Fecha final es requerida')) isValid = false;
    if (isValid) {
        const startDate = moment($('#start_date').val());
        const endDate = moment($('#end_date').val());
        if (endDate.isSameOrBefore(startDate)) {
            validateRequired('#end_date', 'La fecha final debe ser posterior a la inicial');
            isValid = false;
        }
        if (startDate.isBefore(now, 'day')) {
            validateRequired('#start_date', 'No puede usar fechas pasadas');
            isValid = false;
        }
    }
    if ($('#is_virtual').is(':checked')) {
        if (!validateRequired('#virtual_link', 'Enlace virtual es requerido para eventos virtuales')) {
            isValid = false;
        }
    }
    if (!validateRequired('#recipient_type', 'Especificar para quien va dirigido los eventos.')) {
        isValid = false;
    }
    const recipient_type = $('#recipient_type').val();
    if (recipient_type && recipient_type != 'public') {
        if( publication.recipients.length === 0){
           if (!validateRequired('#recipient_selector', 'Debe seleccionar al menos un destinatario')) {
            isValid = false;
        } 
        }
    }
    return isValid;
}

function validateRequired(selector, message) {
    const value = $(selector).val().trim();
    if (!value) {
        $(selector).css('border', '1px solid #ff4444');
        Swal.fire({  toast: true,  position: 'top-right', icon: 'error', title: message,  showConfirmButton: false, timer: 3000 });
        return false;
    }
    return true;
}



//&& (!publication.recipients || publication.recipients.length === 0))
