// submit form name="form-roles"
$('form[name="form-roles"').on('submit', function(e) {
    e.preventDefault()
    
    let form = $(this)
    let data = form.serializeObject()
    let url  = form.attr('action-link')

    $.updated(url, data).then(() => {
        $('#form-roles').modal('hide')
        $.listdata('/roles')
    })
})

/**
 * function edit role
 * @param id 
 * @return @void
 */
function edit(id) {
    var url = `/roles/${id}`
    $.finddata(url + '/edit', 'form-roles').then(response => {
        let form = $(`form[name="form-roles"]`)

        form.attr('action-link', url)
        
        $.each(response.data, (key, val) => {
            form.find(`[name="${key}"]`).val(val)
        })
        
        $('#form-roles').modal('show').find('.modal-title').text('Update role')
    })
}

/**
 * function delete role
 * @param id 
 * @return @void
 */
function deleted(id) {
    Swal.fire({
        title: 'Are you sure ?',
        text: 'the data will go into the trash',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1ABC9C',
        cancelButtonColor: '#E74C3C',
        confirmButtonText: 'Delete',
        allowOutsideClick: false
    }).then((result) => {
        if (result.value) {
            $.deleted(`/roles/${id}`).then(() => {
                $.listdata('/roles')
            })
        }
    })
}

// clear form roles
$('#form-roles').on('hide.bs.modal', function () {
    let modal = $(this)
    let form  = modal.find('form[name="form-roles"]')
    
    modal.find('.modal-title').text('Update role')
    
    form.attr('action-link', '/roles')

    form.find('[name]').val('')
})