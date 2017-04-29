<template id="bs-modal">
    <div :id="modalId" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Confirmation</h5>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <h6 class="text-semibold">Disclaimer</h6>
                        <p class="text-justify">
                            I hereby agree on behalf of my heirs, executors, administrators, and assigns,
                            to indemnify the [PROVIDER] and its officers, board and employees, 
                            joint and severally from any and all actions, causes of actions, claims and 
                            demands for, upon or by reason of any damage, loss or injury, which hereafter 
                            may be sustained by participating in the [ACTIVITY].
                        </p>
                        <p class="text-justify">
                            It is further understood and agreed that said participation in the [ACTIVITY]
                            is not to be construed as an admission of any liability and acceptance of assumption 
                            of responsibility by the [PROVIDER], its officers, board, and employees, jointly and 
                            severally, for all damages and expenses for which the [PROVIDER], its officers, board 
                            and employees, become liable as a result of any alleged act of the parade participant.
                        </p>
                        
                        <hr />

                        <h6 class="text-semibold">Evaluation Details</h6>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="text-semibold">Submission Number</label>
                                    <p class="form-control-static" v-text="evaluation.submission_number"></p>
                                </div>
                                <div class="col-sm-4">
                                    <label class="text-semibold">Submission Type</label>
                                    <p class="form-control-static" v-text="evaluation.type"></p>
                                </div>
                                <div class="col-sm-4">
                                    <label class="text-semibold">Notice</label>
                                    <p class="form-control-static" v-text="evaluation.notice_number"></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="text-semibold">Notice Name</label>
                                    <p class="form-control-static" v-text="evaluation.notice_name"></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="text-semibold">Description</label>
                                    <p class="form-control-static" v-text="evaluation.notice_description"></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="accept(evaluation.id)">I Agree</button>
                </div>
            </div>
        </div>
    </div>
</template>