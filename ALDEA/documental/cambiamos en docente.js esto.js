function XMLHttpRequestAsycn(Request){
    console.log(Request); // para seguir viendo qué llega

    if (typeof Request === 'string') {
        Request = JSON.parse(Request);
    }

    if (Request.status === 'success') {
        $('.loader').hide();
        $('#button_resgist').prop('disabled', false);
        canselar_Registro();
        table.ajax.reload();
        Swal.fire({
            icon: 'success',
            title: 'Registro Éxitoso!!',
            text: Request.mensaje,
            showConfirmButton: false,
            timer: 1500
        });
    } else if (Request == 100) {
        $('.loader').hide();
        $('#button_resgist').prop('disabled', false);
        $('#cont_dniem_error').removeClass('form-group').addClass('form-group has-error');
        $('#cont_codigo_error').removeClass('form-group').addClass('form-group has-error');
        return Swal.fire("Mensaje De Advertencia", "El Registro ya existe. Los 3 campos deben ser diferentes para distinguir cada docente.", "warning");
    } else if (Request == 404 || Request.status == 404) {
        window.location = "NotFound";
    } else if (Request == 401 || Request.status == 401) {
        window.location = "NotFound";
    } else {
        $('.loader').hide();
        $('#button_resgist').prop('disabled', false);
        return Swal.fire("Mensaje De Error", "Registro Fallido!! " + (Request.mensaje || "Error desconocido"), "error");
    }
}
