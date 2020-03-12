// submit form name="form-classit"
$('form[name="form-classit"').on('submit', function(e) {
    e.preventDefault()
    
    let form = $(this)
    let data = form.serializeObject()
    let url  = form.attr('action-link')
    let type = form.attr('action-type')

    if (type == 'create') {
        $.created(url, data).then(() => {
            $('#form-classit').modal('hide')
            $.listdata('/classit')
        })
    } else {
        $.updated(url, data).then(() => {
            $('#form-classit').modal('hide')
            $.listdata('/classit')
        })
    }
})

/**
 * function edit setting
 * @param id 
 * @return @void
 */
function edit(id) {
    var url = `/classit/${id}`
    $.finddata(url + '/edit', 'form-classit').then(response => {
        let form = $(`form[name="form-classit"]`)

        form.attr('action-link', url)
        form.attr('action-type', 'update')
        
        $.each(response.data, (key, val) => {
            form.find(`[name="${key}"]`).val(val)
            if (key === 'start_time') {
                form.find(`[name="${key}"]`).val(val.replace(' ', 'T'))
            }
        })
        
        $('#form-classit').modal('show').find('.modal-title').text('Update data class it')
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
            $.deleted(`/classit/${id}`).then(() => {
                $.listdata('/classit')
            })
        }
    })
}

// clear form settings
$('#form-classit').on('hide.bs.modal', function () {
    let modal = $(this)
    let form  = modal.find('form[name="form-classit"]')
    
    modal.find('.modal-title').text('Create new class it')
    
    form.attr('action-link', '/classit')
    form.attr('action-type', 'create')

    form.find('[name]').val('')
})