(function($) {
    $("#participant").select2();
})(jQuery)

// submit form name="form-eventit"
$('form[name="form-eventit"').on('submit', function(e) {
    e.preventDefault()
    
    let form = $(this)
    let data = form.serializeObject()
    let url  = form.attr('action-link')
    let type = form.attr('action-type')

    if (type == 'create') {
        $.created(url, data).then(() => {
            $('#form-eventit').modal('hide')
            $.listdata('/eventit')
        })
    } else {
        $.updated(url, data).then(() => {
            $('#form-eventit').modal('hide')
            $.listdata('/eventit')
        })
    }
})

/**
 * function edit eventit
 * @param id 
 * @return @void
 */
function edit(id) {
    var url = `/eventit/${id}`
    $.finddata(url + '/edit', 'form-eventit').then(response => {
        let form = $(`form[name="form-eventit"]`)

        form.attr('action-link', url)
        form.attr('action-type', 'update')
        
        $.each(response.data, (key, val) => {
            form.find(`[name="${key}"]`).val(val)
            if (key === 'start' || key === 'end') {
                form.find(`[name="${key}"]`).val(val.replace(' ', 'T'))
            } 
            
            if(key === 'participant') {
                $("#participant").select2().val(val).trigger('change')
            }
        })
        
        $('#form-eventit').modal('show').find('.modal-title').text('Update data event it')
    })
}

/**
 * function delete eventit
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
            $.deleted(`/eventit/${id}`).then(() => {
                $.listdata('/eventit')
            })
        }
    })
}

// clear form eventit
$('#form-eventit').on('hide.bs.modal', function () {
    let modal = $(this)
    let form  = modal.find('form[name="form-eventit"]')
    
    modal.find('.modal-title').text('Create new event it')
    
    form.attr('action-link', '/eventit')
    form.attr('action-type', 'create')

    form.find('[name]').val('')
    form.find('[name="budget"]').val('0')

    $("#participant").select2().val('').trigger('change');
})