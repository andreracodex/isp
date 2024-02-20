<div class="modal fade modal-animate" id="animateModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Device</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <label for="device">Device Name</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="ti ti-user me-1"></i></span>
                    <input type="text" name="device_name" class="form-control" placeholder="Device Name" aria-label="name" required aria-describedby="basic-addon1">
                </div>
                <label for="device">Phone Number Register</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fab fa-whatsapp"></i></span>
                    <input type="number" name="device_number" min="0" class="form-control" placeholder="Device Name" aria-label="number" required aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary shadow-2">{{ $submit }}</button>
            </div>
        </div>
    </div>
</div>
