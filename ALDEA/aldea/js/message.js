
var attachments = [];
var deletedAttachments = [];
var messege = { id: '' };
var panginationDta = null;
var ROLES = { ADMINISTRADOR: 'ADMINISTRADOR', DOCENTE: 'DOCENTE', USUARIO: 'USUARIO', INVITADO: 'INVITADO' };
var APPROVED = 1;
var DISAPPROVED = 2;
var HIDDEN = 3;
var SENT = 'sent';
var RECEIVED = 'received';

async function fetchMessages(userId, currentPage, limit, url) {
  try {
    const response = await fetch(`../controlador/message/${url}.php?user_id=${userId}&page=${currentPage}&limit=${limit}`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error fetching messages:', error);
    return null;
  }
}

async function loadAndDisplayMessages(userId = '', page = 1, limit = 10, email_endpoint) {
  $(".loading").fadeIn();
  userId = await loadUserSessionId()
  var response = await fetchMessages(userId, page, limit, email_endpoint);
  if (response && response.status) {
    renderMessages(response.data.list, email_endpoint);
   // if (!panginationDta) {
    
      initializePaginator(userId, email_endpoint, response);
    //} else {
     // updatePaginator(response.data.list, response.data.size);
   // }
  } else {
    console.error('Error loading messages:', response?.msg || 'Unknown error');
  }
  $(".loading").fadeOut();
}


function getUserContext() {
  var currentUser = JSON.parse(localStorage.getItem('login')) || null;
  var isAdmin = currentUser && currentUser.rol_nombre === ROLES.ADMINISTRADOR;
  return { currentUser, isAdmin };
}
function isSender(currentUser, message) {
  return currentUser && message.sender_id === Number(currentUser.user);
}

function renderMessages(messages, email_endpoint) {
  $('#mailboxBody').empty();
  var userContext = getUserContext();
  $.each(messages, function (index, message) {
    var createdAt = moment(message.created_at).fromNow();
    var hasAttachment = message.count_attachments && message.count_attachments > 0;
    var hasRecipient = email_endpoint == RECEIVED ? message.sender_name : message.recipient_name;
    var isAuthor = isSender(userContext.currentUser, message);
    var rowBackground = message.is_read == 0 ? 'background-color: #e1e5e5;' : '';

    const row = `
        <tr style="${rowBackground}" >
              <td>
                  <div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false">
                      <input type="checkbox" data-id="${message.id}">
                      <ins class="iCheck-helper"></ins>
                  </div>
              </td>

              ${email_endpoint === RECEIVED ? `
                <td class="mailbox-star">
                  <a onclick="markFavorite(${message.id})" style="cursor: pointer;"> 
                    <i class="fa ${message.is_favorite ? 'fa-star' : 'fa-star-o'} text-yellow"></i>
                  </a>
                </td>
              ` : ''}

              <td class="mailbox-name"  style=" cursor: pointer;">
                 <a  style="color: #72afd2; cursor: pointer;" onclick="readMessage(this, ${message.id},${message.is_read})">
                    ${hasRecipient || 'Es un mensaje multiple.'}
                </a>

              </td>
              <td class="mailbox-subject">
                  <b>${message.subject || 'Sin asunto'}</b> - 
                  ${message.content.substring(0, 50)}${message.content.length > 50 ? '...' : ''}
              </td>
              <td class="mailbox-attachment">
                  ${hasAttachment ? '<i class="fa fa-paperclip"></i>' : ''}
              </td>
              <td class="mailbox-date">${createdAt}</td>
            <td style="display: flex; gap: 5px; align-items: center;">
            ${getMessageButtons(message.id, isAuthor, userContext.isAdmin, message.is_approved)}
         </td>
       </tr>
      `;

    $('#mailboxBody').append(row);
  });
}
function toggleSelectAll(button) {
  var isChecked = $(button).find('i').hasClass('fa-square-o');
  $('#mailboxBody input[type="checkbox"]').prop('checked', isChecked);
  $(button).find('i').toggleClass('fa-square-o fa-check-square-o');
}


async function sendMessage(btn) {
  try {
    var data = new FormData();
    data.append('id', messege.id ? messege.id : '');
    data.append('sender_id', await loadUserSessionId());
    data.append('subject', $('#subject').val());
    data.append('content', $('#content').val());
    data.append('is_approved', 0);
    data.append('status', 1);
    data.append('send_type', $('#send_type').val());
    data.append('likes_count', 0);

    var sendType = $('#send_type').val();
    var recipientIds = [];
    if (sendType === "1") {
      recipientIds.push($('#recipient_id').val());
    } else {
      $("#students input[type='checkbox']:checked").each(function () {
        recipientIds.push(parseInt($(this).val())); // Convertimos a número
      });
    }
    if (recipientIds.length > 0) {
      data.append('recipient_ids', JSON.stringify(recipientIds));
    } else {
      alert('Por favor, selecciona al menos un destinatario.');
      return;
    }

    data.append('deleted_files', JSON.stringify(getFilteredDeletedFiles()));
    attachments.forEach((fileInfo) => {
      data.append('attachments[]', fileInfo.file);
    });

    const response = await fetch('../controlador/message/save.php', { method: 'POST', body: data });
    const result = await response.json();
    if (!response.ok) throw new Error('Error al procesar el mensaje');
    if (result.status) {

      Swal.fire({
        toast: true,
        position: 'top-right', icon: 'success', title: result.msg,
        text: '', showConfirmButton: false, timer: 3000,
      });
      attachments = [];
      deletedAttachments = [];
      messege.id='';
      loadView(`message/sends.php`);
    } else {

      Swal.fire("Mensaje de error", result.msg, "error");
    }
  } catch (e) { }

}

function loadFiles(event) {
  var files = event.target.files;
  $.each(files, function (_, file) {
    handleFile(file);
  });
}
function handleFile(file) {
  var index = attachments.length;
  attachments.push({
    file: file,
    name: file.name,
    type: file.type,
    image: null,
    remove: false,
    path: null,
    id: null
  });

  addFileCapsule(index, file);
}

function addFileCapsule(index, file) {
  const container = createFileCapsule(index, file.name, getFileIcon(file.type || file.file_type));

  $('.files_list').append(container);
}


function createFileCapsule(index, fileName, icon) {
  var container = $('<div onclick="openFile(' + index.id + ')" class="file-capsule"></div>');
  var iconElement = $('<i class="' + icon + '"></i>');
  var fileNameSpan = $('<span style="cursor: pointer;"></span>').text(fileName);
  var removeBtn = $('<button class="msg-remove-btn">X</button>');
  var openFile = $('<button onclik ="openFile(' + index.id + ')"></button>');
  removeBtn.on('click', function (event) {
    event.preventDefault();
    event.stopPropagation();


    var fileContainer = $(this).closest('.file-capsule');
    var fileName = fileContainer.find('span').text();

    var fileIndex = attachments.findIndex(file => file.name === fileName);

    if (fileIndex !== -1) {

      var file = attachments[fileIndex];
      if (file) { ; deletedAttachments.push(file); deleteAttachment(file.id) }
      console.log("Archivo eliminado con ID:", file.id); // Mostrar ID del archivo eliminado

      attachments.splice(fileIndex, 1);
      $('.files_list').empty();
      showExistingFiles();
    } else {
      console.log("Error: No se encontró el archivo en el arreglo.");
    }
  });

  container.append(iconElement).append(fileNameSpan).append(removeBtn).append(openFile);
  return container;
}

function openFile(file) {
  var item = attachments.find(obj => obj.id == file);
  if (!item) return;
  if (item.path) window.open('../' + item.path, '_blank');
  else if (item.file) {
    const url = URL.createObjectURL(item.file);
    window.open(url, '_blank');
    setTimeout(() => URL.revokeObjectURL(url), 1000);
  }
}



function loadView(url) {
  $('#containes_message').load(url);
}


function getFileIcon(type) {
  const iconMap = {
    'image/jpeg': 'fa fa-fw fa-image',
    'image/png': 'fa fa-fw fa-image',
    'image/gif': 'fa fa-fw fa-image',
    'application/pdf': 'fa fa-file-pdf-o',
    'default': 'fa fa-file-o'
  };

  return iconMap[type] || iconMap['default'];
}

function deleteSelectedMessages() {
  var selectedIds = getSelectedMessageIds();
  if (selectedIds.length > 0) {
    deleteMessages(selectedIds);
  } else {
    Swal.fire({
      toast: true, position: 'top-right', icon: 'info',
      title: 'No hay mensajes seleccionados', text: 'selecione al menos un mensajes.',
      showConfirmButton: false, timer: 3000,
    });
  }
}
async function markFavorite(messageId) {
  try {
    var user_Id = await loadUserSessionId();
    const response = await fetch(`../controlador/message/mark-favorite.php?messageId=${messageId}&userId=${user_Id}`);
    if (!response.ok) throw new Error(`Error en la solicitud: ${response.status}`);
    const result = await response.json();

    if (result.status) {
      loadAndDisplayMessages('', 1, 10, 'received');
      Swal.fire({ toast: true, position: 'top-right', icon: 'success', title: result.msg, text: '', showConfirmButton: false, timer: 3000 });

    } else {
      Swal.fire({ toast: true, position: 'top-right', icon: 'error', title: 'Failed to mark as favorite', text: '', showConfirmButton: false, timer: 3000 });
    }
  } catch (error) {
    console.error("Error al marcar mensaje como favorito:", error);
  }
}

async function markRead(messageId, isRead) {
  try {
   if (isRead === 1 || isRead === undefined) return;//si esta leido salir

    var user_Id = await loadUserSessionId();
    const response = await fetch(`../controlador/message/mark-read.php?messageId=${messageId}&userId=${user_Id}`);
    if (!response.ok) throw new Error(`Error en la solicitud: ${response.status}`);
    const result = await response.json();
    console.log("Mensaje marcado como leido:", result);

    if (result.status) {

    } else {
      Swal.fire({ toast: true, position: 'top-right', icon: 'error', title: 'Failed to mark como leido', text: '', showConfirmButton: false, timer: 3000 });
    }
  } catch (error) {
    console.error("Error al marcar mensaje como leido:", error);
  }
}



function getSelectedMessageIds() {
  var selectedIds = [];
  $('#mailboxBody input[type="checkbox"]:checked').each(function () {
    selectedIds.push(parseInt($(this).data('id')));
  });
  return selectedIds;
}

async function deleteMessages(ids) {
  try {

    const response = await fetch('../controlador/message/delete.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(ids),
    });
    if (!response.ok) throw new Error(`Error en la solicitud: ${response.status}`);
    const result = await response.json();
    if (result.status) {
      Swal.fire({ toast: true, position: 'top-right', icon: 'success', title: result.msg, text: '', showConfirmButton: false, timer: 3000 });
      loadAndDisplayMessages('', 1, 10, RECEIVED);
    } else {
      Swal.fire({ toast: true, position: 'top-right', icon: 'error', title: 'Failed to mark as favorite', text: '', showConfirmButton: false, timer: 3000 });
    }

  } catch (error) {
    console.error("Error al eliminar mensajes:", error);
  }
}



function getFilteredDeletedFiles() {

  return deletedAttachments.map(file => ({
    id: file.id,
    file_name: file.file_name,
    file_type: file.file_type
  }));
}


function descargarArchivo(idArchivo, nombreArchivo) {

  window.open(`/descargar/${idArchivo}`, '_blank');
}

async function deleteAttachment(id) {

  if (!id) return;
  try {
    const response = await fetch(`../controlador/message/remove-att-byId.php?id=${id}`);
    if (!response.ok) throw new Error(`Error deleting attachment: ${response.status}`);

    const message = await response.text();
    console.log(message);

  } catch (error) {
    console.error("Error deleting attachment:", error);
  }
}

async function readMessageForm(messege) {
  var dateFormated = moment(messege.created_at).format('DD MMM. YYYY hh:mm A');
  $('.modalSubject').text(messege.subject);
  $('.sender_name').text(messege.sender_name || '');
  $('.date-time').text(dateFormated);
  $('.modalContent').text(messege.content);

   var userCurret = getUserContext();
   var isCreator = isSender(userCurret.currentUser, messege);

  var $buttons = getMessageButtons(messege.id,isCreator,userCurret.isAdmin, messege.is_approved);
  $('.btn-group-action').html($buttons);

  // Listar destinatarios
  $('#modalRecipients').empty();

  if(userCurret.isAdmin){

      if (messege.recipients && messege.recipients.length > 0) {
      messege.recipients.forEach(function (recipient) {
      $('#modalRecipients').append(
        $('<li>').text(recipient.recipient_name)
      );
      });
      } else {
       $('#modalRecipients').append($('<li>').text('No hay destinatarios'));
     }
  }else{ $('#modalRecipients').append($('<li>').html('<i class="fa fa-users" style="margin-right:6px;"></i> es un mensaje masivo'));}

  $('.files_list').empty();
  if (messege.attachments && messege.attachments.length > 0) {
    messege.attachments.forEach(function (attachment) {
      var icon_Class = getFileIcon(attachment.file_type);
      $('.files_list')
        .append($('<div class="file-capsule">')
          .append(`<i class="${icon_Class}"></i>`)
          .append($('<span style="cursor: pointer;">')
            .append(`<a href="../${attachment.file_path}" target="_blank">${attachment.file_name}</a>`
            )
          )
        );
    });
  } else {
    $('.files_list').append($('<li>').text('No hay archivos adjuntos'));
  }
}


async function loadMessageToForm(params) {
  if (!params) return;
  messege.id = params.id;
  $('#subject').val(params.subject);
  $('#content').val(params.content);
  $('#send_type').val(params.send_type);
  $('#recipient_id').val(params.recipient_id);

  changeSendType(params.send_type)
  if (params.send_type == 2 && params.recipients) {

    var recipientIds = (params.recipients || []).map(r => Number(r.user_id)) || [];
    loadRecipients(1, recipientIds)
  } else {

    loadRecipients(1, [params.recipient_id]);
  }

  if (params.attachments && params.attachments.length > 0) {
    $('.files_list').empty();

    attachments = params.attachments.map(attachment => {
      return {
        file: null, // No hay archivo físico cargado desde el servidor
        name: attachment.file_name,
        type: attachment.file_type,
        image: null,
        remove: false,
        path: attachment.file_path,
        id: attachment.id
      };
    });

    showExistingFiles();

  }
}

function showExistingFiles() {
  $.each(attachments, function (index, file) {
    var container = createFileCapsule(file, file.name || file.file_name, getFileIcon(file.type || file.file_type));
    if (file.id !== null) {
    }
    $('.files_list').append(container);
  });
}


function changeSendType(value) {
  if (value == '1') {
    $('#individual-recipients').show();
    $('#mass-recipients').hide();
  } else {
    $('#individual-recipients').hide();
    $('#mass-recipients').show();
  }

}


async function loadRecipients(grupId = 1, ids = []) {
  console.log(" ids seleccionados: ", ids)
  try {
    const response = await fetch(`../controlador/message/get-destinatarios.php?grupId=${grupId}`);
    const result = await response.json();

    if (!result.status) {
      throw new Error(result.msg || 'Error al obtener destinatarios');
    }
    const recipients = result.data;
    renderIndividualRecipients(recipients, ids);
    renderMassiveRecipients(recipients, ids);

  } catch (error) {
    console.error('Error cargando destinatarios:', error.message);
    alert('No se pudieron cargar los destinatarios');
  }
}


function renderMassiveRecipients(data, ids) {
  const $container = $("#students").empty();
  console.log(ids)
  if (!Array.isArray(ids)) {
    console.error('El parámetro ids debe ser un arreglo');
    ids = [];
  }

  data && data.forEach(item => {
    const isChecked = ids?.includes(item.id);

    $container.append(`
    <div class="checkbox-item">
      <input id="student_${item.id}" class="form-check-input" type="checkbox" value="${item.id}" ${isChecked ? 'checked' : ''}>
      <label for="student_${item.id}">${item.name} ${item.usu_nombre}</label>
    </div>
  `);
  });
}

function renderIndividualRecipients(recipients, ids = []) {
  const $selectIndividual = $('#recipient_id').empty();
  $selectIndividual.append(
    $('<option>', {
      value: '',
      text: '----- Seleccione -----',
      selected: ids.length === 0
    })
  );
  recipients.forEach(user => {

    const option = $('<option>', {
      value: user.id,
      text: `${user.name} ${user.usu_nombre} `,
      selected: ids.includes(user.id)
    });

    $selectIndividual.append(option);
  });
  if ($selectIndividual.hasClass('js-example-basic-single select2-hidden-accessible')) {

  }
}


function confirmAction(btn, messageId, isApproved) {
  var actionText = isApproved === 1 ? 'aprobar' : 'ocultar';
  var statusMessage = isApproved === 1
    ? 'verá el mensaje publicado.'
    : 'no verá el mensaje en la plataforma.';

  Swal.fire({
    title: `¿Está seguro de ${actionText} este mensaje?`,
    text: `Una vez hecho esto, el cliente ${statusMessage}`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: 'rgb(204 5 78)',
    cancelButtonColor: '#05ccc4',
    confirmButtonText: '¡Sí, confirmar!'
  }).then((result) => {
    if (result.value) {
      changeStatus(btn, messageId, isApproved);
    }
  });
}

function deleteMessage(btn, messageId) {
  Swal.fire({
    title: '¿Está seguro de eliminar este mensaje?',
    text: 'Esta acción no se puede deshacer.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: 'rgb(204 5 78)',
    cancelButtonColor: '#05ccc4',
    confirmButtonText: 'Sí, eliminarlo'
  }).then((result) => {
    if (result.value) {
      deleteMessages([messageId]);
    }
  });
}


async function changeStatus(btn, messageId, isApproved) {

  try {
    const response = await fetch(`../controlador/message/set-status.php?messageId=${messageId}&isApproved=${isApproved}`);
    var result = await response.json();
    if (!response.ok) {
      throw new Error(result.error || 'Error en la solicitud');
    }

    if (result.status) {
      Swal.fire({ toast: true, position: 'top-right', icon: 'success', title: result.msg, text: '', showConfirmButton: false, timer: 3000 });
      loadView(`message/received.php`);

    } else {
      Swal.fire({ toast: true, position: 'top-right', icon: 'error', title: 'Failed to mark as favorite', text: '', showConfirmButton: false, timer: 3000 });
    }
  } catch (error) {
    console.error('Error:', error);
    alert('Hubo un error al cambiar el estado del mensaje');
  }
}

function getMessageButtons(messageId, isAuthor, isAdmin, is_approved) {
  let buttons = '';
  if (isAuthor) {
    buttons += `
          <button type="button" class="btn  btn-sm" onclick="edit(${messageId})"  title="Editar" >
              <i class="fa fa-pencil"></i>
          </button>
      `;
  }
  if (isAdmin) {
    buttons += `
        ${is_approved === 1 ? `
            <button type="button" class="btn btn-warning btn-sm" 
                    onclick="confirmAction(this, ${messageId},${HIDDEN})"
                     title="Ocultar">
                <i class="fa fa-times-circle"></i>
            </button>
        ` : `
            <button type="button" class="btn btn-success btn-sm" 
                    onclick="confirmAction(this, ${messageId},${APPROVED})"
                    title="Aprobar">
                <i class="fa fa-check-circle"></i>
            </button>
        `}
    `;
  }
  if(isAuthor){
    buttons += `
    <button type="button" class="btn btn-danger btn-sm" onclick="deleteMessage(this, ${messageId})" >
      <i class="fa fa-trash"></i> 
    </button>
    `;
  }
  return buttons;
}

async function handleMessageAction(action, messageId) {
  try {
    const response = await fetch(`/api/messages/${messageId}`);
    if (!response.ok) throw await response.text();
    const result = await response.json();
    console.log(result);

  } catch (error) {
    console.error(error);
    alert(error.message);
  }
}


function initializePaginator(userId, url, result) {
 // if (!panginationDta) {
    panginationDta = new Paginator({
      container: '#pagination-container',
      initialData: {
        total: Number(result.data.total) || 0,
        currentPage: Number(result.data.page) || 1,
        perPage: Number(result.data.size) || 10
      },
      onPageChange: (data) => {
        loadAndDisplayMessages(userId, data.currentPage, data.perPage, url);
      }
    });
  //}
}

function updatePaginator(result, selectedSize = null) { }

function filterMessages(input) {
  var filter = input.value.toLowerCase();
  if (filter === '') return; // No hacemos más nada
  // Recorremos cada fila de la tabla
  $('#mailboxBody tr').each(function () {
    var row = $(this);

    // Buscamos texto en columnas que quieres filtrar, por ejemplo:
    var sender = row.find('.mailbox-name a').text().toLowerCase();
    var subject = row.find('.mailbox-subject b').text().toLowerCase();
    var contentPreview = row.find('.mailbox-subject').text().toLowerCase();

    // Si el texto del filtro está en alguna de estas columnas, mostramos la fila
    if (sender.includes(filter) || subject.includes(filter) || contentPreview.includes(filter)) {
      row.show();
    } else {
      row.hide();
    }
  });
}
