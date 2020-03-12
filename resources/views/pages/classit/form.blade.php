{{-- FORM CLASS IT --}}
<div class="modal fade" id="form-classit" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create new class it</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="form-classit" autocomplete="off" action-link="/classit" action-type="create">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title Class</label>
                        <input type="text" name="title" id="title" class="form-control" required placeholder="Title Class">
                    </div>
                    <div class="form-group">
                        <label for="start_time">Start Time</label>
                        <input type="datetime-local" name="start_time" id="start_time" class="form-control" required placeholder="Start Time">
                    </div>
                    <div class="form-group">
                        <label for="speaker">Speaker</label>
                        <input type="text" name="speaker" id="speaker" class="form-control" required placeholder="Speaker">
                    </div>
                    <div class="form-group">
                        <label for="audience">Audiences</label>
                        <input type="number" name="audience" id="audience" class="form-control" required placeholder="Audiences">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="10" required placeholder="Text Description .."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light ">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>