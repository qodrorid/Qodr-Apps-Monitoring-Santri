// submit form name="form-credit"
$('form[name="form-credit"').on('submit', function(e) {
    e.preventDefault()
    
    let form = $(this)
    let data = form.serializeObject()
    let url  = form.attr('action-link')
    let type = form.attr('action-type')

    if (type == 'create') {
        $.created(url, data).then(() => {
            $('#form-credit').modal('hide')
            $.listdata('/credit')
        })
    } else {
        $.updated(url, data).then(() => {
            $('#form-credit').modal('hide')
            $.listdata('/credit')
        })
    }
})

/**
 * function edit credit
 * @param id 
 * @return @void
 */
function edit(id) {
    var url = `/credit/${id}`
    $.finddata(url + '/edit', 'form-credit').then(response => {
        let form = $(`form[name="form-credit"]`)

        form.attr('action-link', url)
        form.attr('action-type', 'update')
        
        $.each(response.data, (key, val) => {
            form.find(`[name="${key}"]`).val(val)
        })
        
        $('#form-credit').modal('show').find('.modal-title').text('Update data credit')
    })
}

/**
 * function delete credit
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
            $.deleted(`/credit/${id}`).then(() => {
                $.listdata('/credit')
            })
        }
    })
}

/**
 * funtion verified user
 * @param id 
 * @return @void
 */
function refund(id) {
    Swal.fire({
        title: "Refund this credit ?",
        text: "will increase cash flow debit",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1ABC9C',
        cancelButtonColor: '#E74C3C',
        confirmButtonText: 'Refund',
        allowOutsideClick: false
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                customClass: {
                    actions: 'swal2-icon-size',
                    popup: 'swal2-bg'
                },
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    $.get(`/credit/refund/${id}`).then(response => {
                        Swal.fire("Success!", response.message, "success")
                        $.listdata('/credit')
                    }).catch(error => {
                        Swal.fire("Error!", error.statusText, "error")
                    })
                }
            })
        }
    })
}

// clear form credit
$('#form-credit').on('hide.bs.modal', function () {
    let modal = $(this)
    let form  = modal.find('form[name="form-credit"]')
    
    modal.find('.modal-title').text('Create new credit')
    
    form.attr('action-link', '/credit')
    form.attr('action-type', 'create')

    form.find('[name]').val('')
})

$('select[name="user_id"]').change(function() {
    let name = $(this).find('option:selected').text()
    
    $('input[name="name"]').val(name)
})