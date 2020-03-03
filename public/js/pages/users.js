// submit form name="form-users"
$('form[name="form-users"').on('submit', function(e) {
    e.preventDefault()
    
    let form = $(this)
    let data = form.serializeObject()
    let url  = form.attr('action-link')
    let type = form.attr('action-type')

    if (type == 'create') {
        $.created(url, data).then(() => {
            $('#form-users').modal('hide')
            $.listdata('/users')
        })
    } else {
        $.updated(url, data).then(() => {
            $('#form-users').modal('hide')
            $.listdata('/users')
        })
    }
})

// submit form name="form-reset-password"
$('form[name="form-reset-password"').on('submit', function(e) {
    e.preventDefault()
    
    let form = $(this)
    let url  = form.attr('action-link')
    let data = form.serializeObject()
    
    $.updated(url, data).then(() => {
        $('#form-reset-password').modal('hide')
    })
})

/**
 * function edit user
 * @param id 
 * @return @void
 */
function edit(id) {
    var url = `/users/${id}`
    $.finddata(url + '/edit', 'form-users').then(response => {
        let form = $(`form[name="form-users"]`)

        form.attr('action-link', url)
        form.attr('action-type', 'update')
        
        $.each(response.data, (key, val) => {
            form.find(`[name="${key}"]`).val(val)
        })
        
        $('.password').hide().find('#password').removeAttr('name').prop('required', false)
        
        $('#form-users').modal('show').find('.modal-title').text('Update data user')
    })
}

/**
 * function delete user
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
        $.deleted(`/users/${id}`).then(() => {
            $.listdata('/users')
        })
    })
}

/**
 * funtion verified user
 * @param id 
 * @return @void
 */
function verified(id) {
    swal({
        title: "Verified this user?",
        text: "it will give user access",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }, () => {
        $.get(`/users/verified/${id}`).then(response => {
            swal("Success!", response.message, "success")
            $.listdata('/users')
        }).catch(error => {
            swal("Error!", error.statusText, "error")
        })
    })
}

/**
 * funtion reset password user
 * @param id 
 * @return @void
 */
function resetpassword(id) {
    var url   = `/users/reset_password/${id}`
    let modal = $('#form-reset-password')
    let form  = modal.find('form[name="form-reset-password"]')
    
    form.attr('action-link', url)
    modal.modal('show')
}

// clear form users
$('#form-users').on('hide.bs.modal', function () {
    let modal = $(this)
    let form  = modal.find('form[name="form-users"]')
    
    modal.find('.modal-title').text('Create New User')
    
    form.attr('action-link', '/users')
    form.attr('action-type', 'create')

    form.find('[name]').val('')
    $('.password').show().find('#password').attr('name', 'password').prop('required', true)
})

// clear form reset password
$('#form-reset-password').on('hide.bs.modal', function () {
    let form  = $(this).find('form[name="form-reset-password"]')
    
    form.removeAttr('action-link')
    form.find('[name]').val('')
})