{{-- FORM EVENT IT --}}
<div class="modal fade" id="form-eventit" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create new event it</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="form-eventit" autocomplete="off" action-link="/eventit" action-type="create">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title Event</label>
                        <input type="text" name="title" id="title" class="form-control" required placeholder="Title Event">
                    </div>
                    <div class="form-group">
                        <label for="start">Start Time</label>
                        <input type="datetime-local" name="start" id="start" class="form-control" required placeholder="Start Time">
                    </div>
                    <div class="form-group">
                        <label for="end">End Time</label>
                        <input type="datetime-local" name="end" id="end" class="form-control" required placeholder="End Time">
                    </div>
                    <div class="form-group">
                        <label for="participant">Participant</label>
                        <select name="participant" multiple="multiple" id="participant" class="form-control" required>
                            {!! HelperTag::userSelect(null, 'name') !!}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="budget">Budget</label>
                        <input type="number" name="budget" id="budget" class="form-control" required placeholder="Budget" value="0">
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