(function() {
    let cashflowAlert = localStorage.getItem('cashflowAlert')

    if (cashflowAlert == 'hide') {
        $('.alert-cashflow').hide()
    } else {
        $('.alert-cashflow').show()
    }
})()

// save alert
function saveAlert() {
    localStorage.setItem('cashflowAlert', 'hide')
}

// token CSRF
const headers = { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

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
    let cashflow = $('select[name="cash_flow_id"]').val()
    
    if (cashflow === null) {
        return false
    }

    if (typeof $('#listitem > tr.add-row, #listitem > tr.edit-row, #listitem > tr.disabled-row').html() !== 'undefined') return false
    
    $('tbody#listitem > tr:last').before(row)
    $('#listitem #date').focus()
    $('#listitem #price').autoNumeric({
        anDefault: 0,
        vMin: 0,
        aSign: 'Rp. ',
        aSep: '.',
        aDec: ',',
        mDec: 0
    })

    $('#listitem #debit').autoNumeric({
        anDefault: 0,
        vMin: 0,
        aSign: 'Rp. ',
        aSep: '.',
        aDec: ',',
        mDec: 0
    })

    $('#listitem #kredit').autoNumeric({
        anDefault: 0,
        vMin: 0,
        aSign: 'Rp. ',
        aSep: '.',
        aDec: ',',
        mDec: 0
    })
    
    return false
}

// create row
function createRow() {
    if (!validity()) return false
    let cash_flow_id = $('select[name="cash_flow_id"]').val()
    let newRow = $('#listitem > tr.add-row')
    let data = {
        cash_flow_id,
        date: newRow.find('#date').val(),
        for: newRow.find('#for').val(),
        qty: newRow.find('#qty').val(),
        type: newRow.find('#type').val(),
        price: newRow.find('#price').val().replace('Rp. ', '').replace(/\./g, ''),
        debit: newRow.find('#debit').val().replace('Rp. ', '').replace(/\./g, ''),
        kredit: newRow.find('#kredit').val().replace('Rp. ', '').replace(/\./g, '')
    }

    newRow.addClass('table-active')
    newRow.find('#date').prop('disabled', true)
    newRow.find('#for').prop('disabled', true)
    newRow.find('#qty').prop('disabled', true)
    newRow.find('#type').prop('disabled', true)
    newRow.find('#price').prop('disabled', true)
    newRow.find('#to').prop('disabled', true)
    newRow.find('.btn-remove').prop('disabled', true)
    newRow.find('.btn-submit').prop('disabled', true)
    
    $.ajax({
        url: urlbase('/cashflow'),
        headers,
        method: 'POST',
        data: data,
        dataType: 'json',
        success: (response) => {
            if (response.status) {
                $.listdata('/cashflow', { cash_flow_id })
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
    let cash_flow_id  = $('select[name="cash_flow_id"]').val()
    let editRow = $('#listitem > tr.edit-row')
    let id      = editRow.attr('id').replace('row-cashflow-', '')
    let data = {
        cash_flow_id,
        date: editRow.find('#date').val(),
        for: editRow.find('#for').val(),
        qty: editRow.find('#qty').val(),
        type: editRow.find('#type').val(),
        price: editRow.find('#price').val().replace('Rp. ', '').replace(/\./g, ''),
        debit: editRow.find('#debit').val().replace('Rp. ', '').replace(/\./g, ''),
        kredit: editRow.find('#kredit').val().replace('Rp. ', '').replace(/\./g, '')
    }

    editRow.addClass('table-active')
    editRow.find('#date').prop('disabled', true)
    editRow.find('#for').prop('disabled', true)
    editRow.find('#qty').prop('disabled', true)
    editRow.find('#type').prop('disabled', true)
    editRow.find('#price').prop('disabled', true)
    editRow.find('#to').prop('disabled', true)
    editRow.find('.btn-remove').prop('disabled', true)
    editRow.find('.btn-submit').prop('disabled', true)
    
    $.ajax({
        url: urlbase(`/cashflow/${id}`),
        headers,
        method: 'PUT',
        data: data,
        dataType: 'json',
        success: (response) => {
            $.listdata('/cashflow', { cash_flow_id })
        },
        error: (error) => {
            $.listdata('/cashflow', { cash_flow_id })
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
    let to     = newRow.find('#to').val()
    let qty    = parseInt(newRow.find('#qty').val().replace(/\./g, ''))
    let price  = parseInt(newRow.find('#price').val().replace('Rp. ', '').replace(/\./g, ''))
    
    let total  = (isNaN(qty) || isNaN(price) || parseInt(qty * price) < 0) ? 0 : parseInt(qty * price)

    if (to === 'kredit') {
        $('#listitem #debit').autoNumeric('set', 0)
        $('#listitem #kredit').autoNumeric('set', total)
    } else {
        $('#listitem #debit').autoNumeric('set', total)
        $('#listitem #kredit').autoNumeric('set', 0)
    }
}

// validation form
function validity() {
    let newRow = $('#listitem > tr.add-row, #listitem > tr.edit-row')
    
    if (typeof newRow.html() === 'undefined') return false
    
    let data = {
        date: newRow.find('#date').val(),
        for: newRow.find('#for').val(),
        qty: newRow.find('#qty').val(),
        price: newRow.find('#price').val().replace('Rp. ', '').replace(/\./g, '')
    }

    let to     = newRow.find('#to').val()
    let debit  = newRow.find('#debit').val().replace('Rp. ', '').replace(/\./g, '')
    let kredit = newRow.find('#kredit').val().replace('Rp. ', '').replace(/\./g, '')

    for (const key in data) {
        if (data[key] === '' || data[key] === '0') {
            $('#' + key).tooltip('show').focus()
            return false
        } else {
            $('#' + key).tooltip('hide')
        }
    }

    if (debit == '0' && kredit == '0') {
        $('#' + to).tooltip('show').focus()
        return false
    }

    return true
}

/**
 * function delete cashflow
 * @param id 
 * @return @void
 */
function deleted(id) {
    let cash_flow_id  = $('select[name="cash_flow_id"]').val()
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
            $.deleted(`/cashflow/${id}`).then(() => {
                $.listdata('/cashflow', { cash_flow_id })
            })
        }
    })
}

// edit
function edit(id, data) {
    if (typeof $('#listitem > tr.add-row, #listitem > tr.edit-row').html() !== 'undefined') {
        $('#listitem .btn-remove').click()
    }

    let rowEdit      = $(`#row-cashflow-${id}`)
    let rowNo        = rowEdit.find('td:first').text()
    let rowElmt      = $('#new-row > table > tbody > tr').clone()
    let dataCashflow = JSON.parse(data)

    let dataStr = JSON.stringify(dataCashflow)

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

    $('#listitem #debit').autoNumeric({
        anDefault: 0,
        vMin: 0,
        aSign: 'Rp. ',
        aSep: '.',
        aDec: ',',
        mDec: 0
    })

    $('#listitem #kredit').autoNumeric({
        anDefault: 0,
        vMin: 0,
        aSign: 'Rp. ',
        aSep: '.',
        aDec: ',',
        mDec: 0
    })

    rowEdit.find('#date').val(dataCashflow.date)
    rowEdit.find('#for').val(dataCashflow.for)
    rowEdit.find('#qty').val(dataCashflow.qty)
    rowEdit.find('#type').val(dataCashflow.type)
    rowEdit.find('#price').autoNumeric('set', dataCashflow.price)
    rowEdit.find('#debit').autoNumeric('set', dataCashflow.debit)
    rowEdit.find('#kredit').autoNumeric('set', dataCashflow.kredit)

    if (dataCashflow.debit != 0) {
        rowEdit.find('#to').val('debit')
    } else {
        rowEdit.find('#to').val('kredit')
    }
}

// cacle edit
function cancleEdit(no, data) {
    let dataCashflow = JSON.parse(data)
    let rowEdit = $(`#row-cashflow-${dataCashflow.id}`)
    let element = `<td align="center">${no}</td>`

    element += `<td>${changeDate(dataCashflow.date)}</td><td>${dataCashflow.for}</td><td align="center">${dataCashflow.qty}</td><td align="center">${dataCashflow.type}</td>`
    element += `<td align="right"><span style="float:left">Rp. </span>${new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 3 }).format(dataCashflow.price)},-</td>`
    element += `<td align="right"><span style="float:left">Rp. </span>${new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 3 }).format(dataCashflow.debit)},-</td>`
    element += `<td align="right"><span style="float:left">Rp. </span>${new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 3 }).format(dataCashflow.kredit)},-</td>`
    element += `<td align="right"><span style="float:left">Rp. </span>${new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 3 }).format(dataCashflow.total)},-</td>`
    element += `<td class="action" align="center">`
    element += `<button type="button" class="btn btn-primary btn-sm pr-2">`
    element += `<i class="feather icon-edit"></i></button> `
    element += `<button type="button" class="btn btn-danger btn-sm pr-2" onclick="deleted(${dataCashflow.id})"><i class="feather icon-trash-2"></i></button></td>`

    rowEdit.removeClass('edit-row')
    rowEdit.html(element)
    rowEdit.find('.action > button:first').attr('onclick', `edit(${dataCashflow.id}, '${data}')`)
}

// change cashflow id
$('select[name="cash_flow_id"]').change(function() {
    let cash_flow_id = $(this).val()
    $.listdata('/cashflow', { cash_flow_id })
})

// change date
function changeDate(params) {
    let date = new Date(params)
    let dd   = String(date.getDate()).padStart(2, '0')
    let mm   = String(date.getMonth()).padStart(2, '0')
    let yyyy = date.getFullYear()
    
    return `${dd}/${mm}/${yyyy}`
}