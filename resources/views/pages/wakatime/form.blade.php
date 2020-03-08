{{-- FORM WAKATIME --}}
<div class="modal fade" id="form-wakatime" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="form-wakatime" autocomplete="off" wakatime="{{ $wakatime->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="coding_activity">Coding Activity</label>
                        <input type="text" name="coding_activity" id="coding_activity" class="form-control" placeholder="https://example.com/coding_activity.json" value="{{ $wakatime->coding_activity }}" required>
                    </div>
                    <div class="form-group">
                        <label for="languages">Languages</label>
                        <input type="text" name="languages" id="languages" class="form-control" placeholder="https://example.com/languages.json" value="{{ $wakatime->languages }}" required>
                    </div>
                    <div class="form-group">
                        <label for="editors">Editors</label>
                        <input type="text" name="editors" id="editors" class="form-control" placeholder="https://example.com/editors.json" value="{{ $wakatime->editors }}" required>
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