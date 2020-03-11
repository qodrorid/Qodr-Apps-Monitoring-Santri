{{-- FORM SETTING --}}
<div class="modal fade" id="form-branch" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create new branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="form-branch" autocomplete="off" action-link="/branch" action-type="create">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name Setting</label>
                        <input type="text" name="name" id="name" class="form-control" required placeholder="Name Setting">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control" rows="4" placeholder="Text Address .."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="telegram">Token Telegram</label>
                        <input type="text" name="telegram" id="telegram" class="form-control" required placeholder="Token Telegram">
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