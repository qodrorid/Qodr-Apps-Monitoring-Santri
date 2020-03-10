// submit form name="form-todo"
$('form[name="form-todo"').on('submit', function(e) {
    e.preventDefault()
    
    let form = $(this)
    let data = form.serializeObject()
    let url  = '/todo/store'

    $.created(url, data).then(() => {
        $.listdata('/todo')
    })
})

// add todo
$('.btn-add-todo').click(() => {
    let clone = $('#list-todo .form-group:first').clone()

    clone.find('input[name="status[]"]').val('0')
    clone.find('input[name="todo[]"]').val('')

    $('#list-todo').append(clone)
    $('#list-todo .form-group:last input[name="todo[]"]').focus()
})

// remove todo
function removeTodo(that) {
    $(that).closest('.form-group').remove()
}

// open form todo
function todo(date, todoString) {
    let modal = $('#form-todo')

    if (typeof todoString !== 'undefined') {
        let todos = JSON.parse(todoString)
        let clone = $('#list-todo .form-group:first').clone()

        $('#list-todo').html('')

        todos.forEach(item => {
            clone.find('input[name="status[]"]').attr('value', item.status)
            clone.find('input[name="todo[]"]').attr('value', item.todo)

            let element = clone.html()

            $('#list-todo').append(`<div class="form-group">${element}</div>`)
        });
    }

    modal.find('input[name="date"]').val(date)
    modal.modal('show')
}

// check todo
function checkTodo(id, key, that) {
    let todo = JSON.parse($(that).parent().attr('list-todos'))
    let url  = `/todo/update/${id}`

    const headers = { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

    todo.map((item, idx) => {
        if (idx === key) {
            item.status = item.status == 0 ? 1 : 0
        }
        return item
    })

    $.ajax({
        url: urlbase(url),
        headers,
        method: 'PUT',
        data: { todo },
        dataType: 'json',
        success: (response) => {
            if (response.status == true) {
                $(that).find('i.fa').toggleClass('text-primary')
                $(that).parent().attr('list-todos', JSON.stringify(todo))
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

// clear form todo
$('#form-todo').on('hide.bs.modal', function () {
    let modal = $(this)
    let form  = modal.find('form[name="form-todo"]')
    let clone = $('#list-todo .form-group:first').clone()
    
    form.find('[name]').val('')

    clone.find('input[name="status[]"]').val('0')
    clone.find('input[name="todo[]"]').val('')

    $('#list-todo').html('')
    $('#list-todo').append(clone)
    
    modal.find('.modal-title').text('Create new todo')
})