{{-- FORM TODO --}}
<div class="modal fade" id="form-todo" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Todo List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="form-todo" autocomplete="off">
                <input type="hidden" name="date">
                <div class="modal-body">
                    <div id="list-todo">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" name="status[]" value="0">
                                <input type="text" name="todo[]" class="form-control" placeholder="Text Todo" required>
                                <span class="input-group-addon bg-danger" onclick="removeTodo(this)">
                                    <i class="feather icon-x"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="add-todo">
                        <button type="button" class="btn btn-primary btn-sm btn-add-todo">
                            <i class="feather icon-plus"></i> Add Todo
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>