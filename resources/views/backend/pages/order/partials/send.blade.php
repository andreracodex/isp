<div class="modal fade" id="modalSendAll" tabindex="-1" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title">Send Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="add-contact-box">
                    <div class="add-contact-content">
                        <form action="{{ route('order.sendAll', $order->id) }}" id="addContactModalTitle" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <h3>Apakah barang akan dikirim semua?</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button id="sendAll" type="submit"
                                    class="btn btn-success rounded-pill px-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
