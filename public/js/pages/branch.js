// submit form name="form-branch"
$('form[name="form-branch"').on('submit', function(e) {
    e.preventDefault()
    
    let form = $(this)
    let data = form.serializeObject()
    let url  = form.attr('action-link')
    let type = form.attr('action-type')

    if (type == 'create') {
        $.created(url, data).then(() => {
            $('#form-branch').modal('hide')
            $.listdata('/branch')
        })
    } else {
        $.updated(url, data).then(() => {
            $('#form-branch').modal('hide')
            $.listdata('/branch')
        })
    }
})

/**
 * function edit setting
 * @param id 
 * @return @void
 */
function edit(id) {
    var url = `/branch/${id}`
    $.finddata(url + '/edit', 'form-branch').then(response => {
        let form = $(`form[name="form-branch"]`)

        form.attr('action-link', url)
        form.attr('action-type', 'update')
        
        $.each(response.data, (key, val) => {
            form.find(`[name="${key}"]`).val(val)
        })
        
        $('#form-branch').modal('show').find('.modal-title').text('Update data setting')
    })
}

/**
 * function delete setting
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
            $.deleted(`/branch/${id}`).then(() => {
                $.listdata('/branch')
            })
        }
    })
}

// clear form settings
$('#form-branch').on('hide.bs.modal', function () {
    let modal = $(this)
    let form  = modal.find('form[name="form-branch"]')
    
    modal.find('.modal-title').text('Create new setting')
    
    form.attr('action-link', '/branch')
    form.attr('action-type', 'create')

    form.find('[name]').val('')
})