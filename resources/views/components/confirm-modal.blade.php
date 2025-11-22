<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p id="confirmModalMessage">{{ $message }}</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                <form id="confirmModalForm" action="{{ $action }}" method="POST" style="display:inline;">
                    @csrf
                    @if ($method !== 'POST')
                        @method($method)
                    @endif
                    <button type="submit" class="btn btn-danger">Yes, Confirm</button>
                </form>
            </div>

        </div>
    </div>
</div>
