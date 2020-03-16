{{-- FORM RAB --}}
<div class="modal fade" id="form-rab" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create new rab</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="form-rab" autocomplete="off">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="date">Month</label>
                        <input type="month" name="date" min="{{ date('Y-m') }}" max="{{ now()->addMonth('1')->format('Y-m') }}" id="date" class="form-control" required placeholder="Month">
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