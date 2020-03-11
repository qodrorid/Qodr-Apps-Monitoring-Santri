{{-- FORM IZIN --}}
<div class="modal fade" id="form-izin" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create new izin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="form-izin" autocomplete="off" action-link="/izin" action-type="create">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="information">Izin Information</label>
                        <textarea name="information" id="information" class="form-control" rows="4" placeholder="Izin Information .."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="start">Date Start</label>
                        <input type="datetime-local" name="start" id="start" class="form-control" required placeholder="Date Start">
                    </div>
                    <div class="form-group">
                        <label for="end">Date End</label>
                        <input type="datetime-local" name="end" id="end" class="form-control" required placeholder="Date End">
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