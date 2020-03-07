{{-- FORM SETTING --}}
<div class="modal fade" id="form-settings" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create new setting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="form-settings" autocomplete="off" action-link="/settings" action-type="create">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name Setting</label>
                        <input type="text" name="name" id="name" class="form-control" required placeholder="Name Setting">
                    </div>
                    <div class="form-group">
                        <label for="setting">Setting</label>
                        <textarea name="setting" id="setting" class="form-control" rows="4" placeholder="Text Setting .."></textarea>
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