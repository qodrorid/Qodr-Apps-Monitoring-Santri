{{-- FORM INCOME --}}
<div class="modal fade" id="form-income" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create new income</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="form-income" autocomplete="off" action-link="/income" action-type="create">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name Student</label>
                        <select name="user_id" id="user_id" class="form-control select2">
                            <option value="">--- Select Student ---</option>
                            {!! HelperTag::userSelect() !!}
                        </select>
                        <input type="hidden" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="number" name="nominal" id="nominal" class="form-control" placeholder="Nominal">
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" class="form-control" placeholder="Date">
                    </div>
                    <div class="form-group">
                        <label for="information">Information</label>
                        <textarea name="information" id="information" class="form-control" rows="4" placeholder="Text Information .." required></textarea>
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