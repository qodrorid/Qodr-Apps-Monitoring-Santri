// submit form name="form-income"
$('form[name="form-income"').on('submit', function(e) {
    e.preventDefault()
    
    let form = $(this)
    let data = form.serializeObject()
    let url  = form.attr('action-link')
    let type = form.attr('action-type')

    if (type == 'create') {
        $.created(url, data).then(() => {
            $('#form-income').modal('hide')
            $.listdata('/income')
        })
    } else {
        $.updated(url, data).then(() => {
            $('#form-income').modal('hide')
            $.listdata('/income')
        })
    }
})

/**
 * function edit income
 * @param id 
 * @return @void
 */
function edit(id) {
    var url = `/income/${id}`
    $.finddata(url + '/edit', 'form-income').then(response => {
        let form = $(`form[name="form-income"]`)

        form.attr('action-link', url)
        form.attr('action-type', 'update')
        
        $.each(response.data, (key, val) => {
            form.find(`[name="${key}"]`).val(val)
        })
        
        $('#form-income').modal('show').find('.modal-title').text('Update data income')
    })
}

/**
 * function delete income
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
            $.deleted(`/income/${id}`).then(() => {
                $.listdata('/income')
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
        title: "Refund this income ?",
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
                    $.get(`/income/refund/${id}`).then(response => {
                        Swal.fire("Success!", response.message, "success")
                        $.listdata('/income')
                    }).catch(error => {
                        Swal.fire("Error!", error.statusText, "error")
                    })
                }
            })
        }
    })
}

// clear form income
$('#form-income').on('hide.bs.modal', function () {
    let modal = $(this)
    let form  = modal.find('form[name="form-income"]')
    
    modal.find('.modal-title').text('Create new income')
    
    form.attr('action-link', '/income')
    form.attr('action-type', 'create')

    form.find('[name]').val('')
})

$('select[name="user_id"]').change(function() {
    let name = $(this).find('option:selected').text()
    
    $('input[name="name"]').val(name)
})