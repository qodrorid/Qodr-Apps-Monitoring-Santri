// submit form name="form-settings"
$('form[name="form-settings"').on('submit', function(e) {
    e.preventDefault()
    
    let form = $(this)
    let data = form.serializeObject()
    let url  = form.attr('action-link')
    let type = form.attr('action-type')

    if (type == 'create') {
        $.created(url, data).then(() => {
            $('#form-settings').modal('hide')
            $.listdata('/settings')
        })
    } else {
        $.updated(url, data).then(() => {
            $('#form-settings').modal('hide')
            $.listdata('/settings')
        })
    }
})

/**
 * function edit setting
 * @param id 
 * @return @void
 */
function edit(id) {
    var url = `/settings/${id}`
    $.finddata(url + '/edit', 'form-settings').then(response => {
        let form = $(`form[name="form-settings"]`)

        form.attr('action-link', url)
        form.attr('action-type', 'update')
        
        $.each(response.data, (key, val) => {
            form.find(`[name="${key}"]`).val(val)
        })
        
        $('#form-settings').modal('show').find('.modal-title').text('Update data setting')
    })
}

/**
 * function delete setting
 * @param id 
 * @return @void
 */
function deleted(id) {
    swal({
        title: "Are you sure?",
        text: "the data will go into the trash",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }, () => {
        $.deleted(`/settings/${id}`).then(() => {
            $.listdata('/settings')
        })
    })
}

// clear form settings
$('#form-settings').on('hide.bs.modal', function () {
    let modal = $(this)
    let form  = modal.find('form[name="form-settings"]')
    
    modal.find('.modal-title').text('Create new setting')
    
    form.attr('action-link', '/settings')
    form.attr('action-type', 'create')

    form.find('[name]').val('')
})