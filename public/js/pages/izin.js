// ready script
(function() {
    $('input[name="daterange"]').daterangepicker({
        timePicker: true,
        locale: {
            format: 'YYYY-MM-DD hh:mm'
        }
    })
})()

// apply date range
$('input[name="daterange"]').on('apply.daterangepicker', function () {
    let date  = $(this).val().split(' - ')
    let start = date[0]
    let end   = date[1]

    $.listdata('/izin', { start, end })
})

// submit form name="form-izin"
$('form[name="form-izin"').on('submit', function(e) {
    e.preventDefault()
    
    let form = $(this)
    let data = form.serializeObject()
    let url  = form.attr('action-link')
    let type = form.attr('action-type')

    if (type == 'create') {
        $.created(url, data).then(() => {
            $('#form-izin').modal('hide')
            $.listdata('/izin')
        })
    } else {
        $.updated(url, data).then(() => {
            $('#form-izin').modal('hide')
            $.listdata('/izin')
        })
    }
})

/**
 * function edit izin
 * @param id 
 * @return @void
 */
function edit(id) {
    var url = `/izin/${id}`
    $.finddata(url + '/edit', 'form-izin').then(response => {
        let form = $(`form[name="form-izin"]`)

        form.attr('action-link', url)
        form.attr('action-type', 'update')
        
        $.each(response.data, (key, val) => {
            form.find(`[name="${key}"]`).val(val)
            if (key == 'start' || key == 'end') {
                let date = val.replace(' ', 'T')
                form.find(`[name="${key}"]`).val(date)
            }
        })
        
        $('#form-izin').modal('show').find('.modal-title').text('Update data izin')
    })
}

/**
 * function delete izin
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
            $.deleted(`/izin/${id}`).then(() => {
                $.listdata('/izin')
            })
        }
    })
}

/**
 * function delete izin
 * @param id 
 * @return @void
 */
function approved(id, userid, approved) {
    var message = {}
    if (approved) {
        message = {
            title: 'Are you sure approved ?',
            text: 'students will be allowed permission',
            confirmButtonText: 'Approve'
        }
    } else {
        message = {
            title: 'Are you sure rejected ?',
            text: 'students will be banned for permission',
            confirmButtonText: 'Rejected'
        }
    }

    Swal.fire({
        ...message,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1ABC9C',
        cancelButtonColor: '#E74C3C',
        allowOutsideClick: false
    }).then((result) => {
        if (result.value) {
            $.updated(`/izin/approved/${id}`, { approved }).then(() => {
                $.listdata(`/izin/list/${userid}`)
            })
        }
    })
}

// clear form izin
$('#form-izin').on('hide.bs.modal', function () {
    let modal = $(this)
    let form  = modal.find('form[name="form-izin"]')
    
    modal.find('.modal-title').text('Create new izin')
    
    form.attr('action-link', '/izin')
    form.attr('action-type', 'create')

    form.find('[name]').val('')
})