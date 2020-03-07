$('select[name="showtables"]').change(function() {
    let table = $(this).val()
    
    $.listdata('/trash/view', { table })
})

/**
 * funtion restored user
 * @param id
 * @param table  
 * @return @void
 */
function restored(id, table) {
    Swal.fire({
        title: "Restor this data ?",
        text: "the data will be returned to origin",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1ABC9C',
        cancelButtonColor: '#E74C3C',
        confirmButtonText: 'Restor',
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
                    $.get(`/trash/restore/${id}/${table}`).then(response => {
                        Swal.fire("Success!", response.message, "success")
                        $.listdata('/trash/view', window.stateQuery)
                    }).catch(error => {
                        Swal.fire("Error!", error.statusText, "error")
                    })
                }
            })
        }
    })
}

/**
 * funtion deleted user
 * @param id
 * @param table  
 * @return @void
 */
function deleted(id, table) {
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
            Swal.fire({
                customClass: {
                    actions: 'swal2-icon-size',
                    popup: 'swal2-bg'
                },
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    $.get(`/trash/delete/${id}/${table}`).then(response => {
                        Swal.fire("Success!", response.message, "success")
                        $.listdata('/trash/view', window.stateQuery)
                    }).catch(error => {
                        Swal.fire("Error!", error.statusText, "error")
                    })
                }
            })
        }
    })
}