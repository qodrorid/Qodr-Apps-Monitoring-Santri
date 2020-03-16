// token CSRF
const headers = { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

// submit form name="form-rab"
$('form[name="form-rab"').on('submit', function(e) {
    e.preventDefault()
    
    let form   = $(this)
    let data   = form.serializeObject()
    let url    = '/rab/create'
    let id_rab = $('select[name="rab_id"]').val()
    
    $.created(url, data).then(response => {
        $('#form-rab').modal('hide')
        $.listdata('/rab', { id_rab })
        $('select#rab_id').html(response.data)
    })
})

// add with keydown
document.addEventListener('keyup', function(e) {
    if (e.ctrlKey && e.key == ' ') {
        addRow()
    }

    if (e.ctrlKey && (e.which == 13 || e.keyCode == 13)) {
        if (typeof $('#listitem > tr.add-row > td > .btn-remove').html() !== 'undefined') {
            createRow()
        } else {
            editRow()
        }
    }
})

// add row
function addRow() {
    let row = $('#new-row > table > tbody').html()
    let rab = $('select[name="rab_id"]').val()
    
    if (rab === null) {
        $('#form-rab').modal('show')
        return false
    }

    if (typeof $('#listitem > tr.add-row, #listitem > tr.edit-row, #listitem > tr.disabled-row').html() === 'undefined') {
        $('tbody#listitem > tr:last').before(row)
        $('#listitem #for').focus()
        $('#listitem #price').autoNumeric({
            anDefault: 0,
            vMin: 0,
            aSign: 'Rp. ',
            aSep: '.',
            aDec: ',',
            mDec: 0
        })

        $('#listitem #total').autoNumeric({
            anDefault: 0,
            vMin: 0,
            aSign: 'Rp. ',
            aSep: '.',
            aDec: ',',
            mDec: 0
        })
        return false
    }
}

// create row
function createRow() {
    if (!validity()) return false
    let rab_id = $('select[name="rab_id"]').val()
    let newRow = $('#listitem > tr.add-row')
    let data = {
        rab_id,
        for: newRow.find('#for').val(),
        qty: newRow.find('#qty').val(),
        price: newRow.find('#price').val().replace('Rp. ', '').replace(/\./g, ''),
        total: newRow.find('#total').val().replace('Rp. ', '').replace(/\./g, '')
    }

    newRow.addClass('table-active')
    newRow.find('#for').prop('disabled', true)
    newRow.find('#qty').prop('disabled', true)
    newRow.find('#price').prop('disabled', true)
    newRow.find('.btn-remove').prop('disabled', true)
    newRow.find('.btn-submit').prop('disabled', true)
    
    $.ajax({
        url: urlbase('/rab'),
        headers,
        method: 'POST',
        data: data,
        dataType: 'json',
        success: (response) => {
            if (response.status) {
                $.listdata('/rab', { rab_id })
            }
        },
        error: (error) => {
            if (error.responseJSON) {
                Swal.fire({
                    type: 'error',
                    title: 'Error!',
                    text: error.responseJSON.message,
                    allowOutsideClick: false
                })
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Error!',
                    text: error.statusText,
                    allowOutsideClick: false
                })
            }
        }
    })
}

// edit row
function editRow() {
    if (!validity()) return false
    let rab_id  = $('select[name="rab_id"]').val()
    let editRow = $('#listitem > tr.edit-row')
    let id      = editRow.attr('id').replace('row-rab-', '')
    let data = {
        rab_id,
        for: editRow.find('#for').val(),
        qty: editRow.find('#qty').val(),
        price: editRow.find('#price').val().replace('Rp. ', '').replace(/\./g, ''),
        total: editRow.find('#total').val().replace('Rp. ', '').replace(/\./g, '')
    }

    editRow.addClass('table-active')
    editRow.find('#for').prop('disabled', true)
    editRow.find('#qty').prop('disabled', true)
    editRow.find('#price').prop('disabled', true)
    editRow.find('.btn-remove').prop('disabled', true)
    editRow.find('.btn-submit').prop('disabled', true)
    
    $.ajax({
        url: urlbase(`/rab/${id}`),
        headers,
        method: 'PUT',
        data: data,
        dataType: 'json',
        success: (response) => {
            if (response.status) {
                $.listdata('/rab', { rab_id })
            }
        },
        error: (error) => {
            if (error.responseJSON) {
                Swal.fire({
                    type: 'error',
                    title: 'Error!',
                    text: error.responseJSON.message,
                    allowOutsideClick: false
                })
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Error!',
                    text: error.statusText,
                    allowOutsideClick: false
                })
            }
        }
    })
}

// remove row
function removeRow(that) {
    $(that).closest('.add-row').remove()
    $(".tooltip").tooltip("hide");
}

// count total price
function countTotal() {
    let newRow = $('#listitem > tr.add-row, #listitem > tr.edit-row')
    let qty    = parseInt(newRow.find('#qty').val().replace(/\./g, ''))
    let price  = parseInt(newRow.find('#price').val().replace('Rp. ', '').replace(/\./g, ''))
    
    let total  = (isNaN(qty) || isNaN(price) || parseInt(qty * price) < 0) ? 0 : parseInt(qty * price)
    $('#listitem #total').autoNumeric('set', total)
}

// validation form
function validity() {
    let newRow = $('#listitem > tr.add-row, #listitem > tr.edit-row')
    
    if (typeof newRow.html() === 'undefined') return false
    
    let data = {
        for: newRow.find('#for').val(),
        qty: newRow.find('#qty').val(),
        price: newRow.find('#price').val().replace('Rp. ', '').replace(/\./g, ''),
        total: newRow.find('#total').val().replace('Rp. ', '').replace(/\./g, '')
    }

    for (const key in data) {
        if (data[key] === '' || data[key] === '0') {
            $('#' + key).tooltip('show').focus()
            return false
        } else {
            $('#' + key).tooltip('hide')
        }
    }

    return true
}

/**
 * function delete rab
 * @param id 
 * @return @void
 */
function deleted(id) {
    let rab_id  = $('select[name="rab_id"]').val()
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
            $.deleted(`/rab/${id}`).then(() => {
                $.listdata('/rab', { rab_id })
            })
        }
    })
}

// edit
function edit(id, data) {
    let rowEdit = $(`#row-rab-${id}`)
    let rowNo   = rowEdit.find('td:first').text()
    let rowElmt = $('#new-row > table > tbody > tr').clone()
    let dataRab = JSON.parse(data)

    let dataStr = JSON.stringify(dataRab)

    rowElmt.find('.btn-remove').attr('onclick', `cancleEdit('${rowNo}', '${dataStr}')`)
    rowElmt.find('.btn-submit').attr('onclick', `editRow()`)

    rowEdit.addClass('edit-row')
    rowEdit.html(rowElmt.html())

    rowEdit.find('#price').autoNumeric({
        anDefault: 0,
        vMin: 0,
        aSign: 'Rp. ',
        aSep: '.',
        aDec: ',',
        mDec: 0
    })

    rowEdit.find('#total').autoNumeric({
        anDefault: 0,
        vMin: 0,
        aSign: 'Rp. ',
        aSep: '.',
        aDec: ',',
        mDec: 0
    })

    rowEdit.find('#for').attr('value', dataRab.for)
    rowEdit.find('#qty').attr('value', dataRab.qty)
    rowEdit.find('#price').autoNumeric('set', dataRab.price)
    rowEdit.find('#total').autoNumeric('set', dataRab.total)
}

// cacle edit
function cancleEdit(no, data) {
    let dataRab = JSON.parse(data)
    let rowEdit = $(`#row-rab-${dataRab.id}`)
    let element = `<td align="center">${no}</td>`

    element += `<td>${dataRab.for}</td>`
    element += `<td align="center">${dataRab.qty}</td>`
    element += `<td align="right"><span style="float:left">Rp. </span>${new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 3 }).format(dataRab.price)},-</td>`
    element += `<td align="right"><span style="float:left">Rp. </span>${new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 3 }).format(dataRab.total)},-</td>`
    element += `<td class="action" align="center">`
    element += `<button type="button" class="btn btn-primary btn-sm pr-2">`
    element += `<i class="feather icon-edit"></i></button> `
    element += `<button type="button" class="btn btn-danger btn-sm pr-2" onclick="deleted(${dataRab.id})"><i class="feather icon-trash-2"></i></button></td>`

    rowEdit.html(element)
    rowEdit.find('.action > button:first').attr('onclick', `edit(${dataRab.id}, '${data}')`)
}

// change rab id
$('select[name="rab_id"]').change(function() {
    let rab_id = $(this).val()
    $.listdata('/rab', { rab_id })
})