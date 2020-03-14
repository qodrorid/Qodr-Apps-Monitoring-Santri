{{-- FORM CEKCOK --}}
<div class="modal fade" id="form-cekcok" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create new cekcok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="form-cekcok" autocomplete="off" action-link="/cekcok" action-type="create">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title Cekcok</label>
                        <input type="text" name="title" id="title" class="form-control" required placeholder="Title Cekcok">
                    </div>
                    <div class="form-group">
                        <label for="start_time">Start Time</label>
                        <input type="datetime-local" name="start_time" id="start_time" class="form-control" required placeholder="Start Time">
                    </div>
                    <div class="form-group">
                        <label for="mentor">Mentor</label>
                        <input type="text" name="mentor" id="mentor" class="form-control" required placeholder="Mentor">
                    </div>
                    <div class="form-group">
                        <label for="participant">Participant</label>
                        <select name="participant" multiple="multiple" id="participant" class="form-control" required>
                            {!! HelperTag::userSelect(null, 'name') !!}
                        </select>
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