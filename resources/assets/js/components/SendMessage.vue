<template>
    <div>
        <button
                class="btn btn-default pull-right"
                @click="showSendMessageForm"
                style="margin-top: -36px;"
        >SendMessage</button>
        <div class="modal fade" id="modal-send-message" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">
                            MessageSend
                        </h4>
                    </div>
                    <div class="modal-body">
                        <textarea name="body" class="form-control" v-model="body" v-if="!status"></textarea>
                        <div class="alert alert-success" v-if="status">
                            <strong>SendSuccess</strong>
                        </div>
                    </div>
                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="store">
                            Send
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['user'],
        data() {
            return {
                body:'',
                status:false
            }
        },
        methods: {
            store() {
                const that = this
                axios.post('/api/message/store',{
                    'user':this.user,
                    'body':this.body,
                }).then(function(response) {
                    that.status = response.data.status
                    that.body = ''
                    setTimeout(function (){
                        $('#modal-send-message').modal('hide')
                    },2000)
                })
            },
            showSendMessageForm() {
                $('#modal-send-message').modal('show')
            }
        },
    }
</script>