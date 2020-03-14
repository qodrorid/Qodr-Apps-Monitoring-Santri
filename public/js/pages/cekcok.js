(function($) {
    $("#participant").select2();
})(jQuery)

// submit form name="form-cekcok"
$('form[name="form-cekcok"').on('submit', function(e) {
    e.preventDefault()
    
    let form = $(this)
    let data = form.serializeObject()
    let url  = form.attr('action-link')
    let type = form.attr('action-type')

    if (type == 'create') {
        $.created(url, data).then(() => {
            $('#form-cekcok').modal('hide')
            $.listdata('/cekcok')
        })
    } else {
        $.updated(url, data).then(() => {
            $('#form-cekcok').modal('hide')
            $.listdata('/cekcok')
        })
    }
})

/**
 * function edit cekcok
 * @param id 
 * @return @void
 */
function edit(id) {
    var url = `/cekcok/${id}`
    $.finddata(url + '/edit', 'form-cekcok').then(response => {
        let form = $(`form[name="form-cekcok"]`)

        form.attr('action-link', url)
        form.attr('action-type', 'update')
        
        $.each(response.data, (key, val) => {
            form.find(`[name="${key}"]`).val(val)
            if (key === 'start_time') {
                form.find(`[name="${key}"]`).val(val.replace(' ', 'T'))
            }

            if(key === 'participant') {
                $("#participant").select2().val(val).trigger('change')
            }
        })
        
        $('#form-cekcok').modal('show').find('.modal-title').text('Update data cekcok')
    })
}

/**
 * function delete cekcok
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
            $.deleted(`/cekcok/${id}`).then(() => {
                $.listdata('/cekcok')
            })
        }
    })
}

// clear form cekcok
$('#form-cekcok').on('hide.bs.modal', function () {
    let modal = $(this)
    let form  = modal.find('form[name="form-cekcok"]')
    
    modal.find('.modal-title').text('Create new cekcok')
    
    form.attr('action-link', '/cekcok')
    form.attr('action-type', 'create')

    form.find('[name]').val('')
    $("#participant").select2().val('').trigger('change')
})