<template>
    <div>
        <button
                class="button is-naked delete-button"
                @click="showCommentsForm"
                v-text="text"
        ></button>
        <div class="modal fade" :id=dialog tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">
                            Comments List
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div v-if="comments.length > 0">
                            <div class="media" v-for="comment in comments">
                                <div class="media-left">
                                    <a href="#">
                                        <img width="24" class="media-object" :src="comment.user.avatar">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{comment.user.name}}</h4>
                                    {{comment.body}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <input type="text" class="form-control" v-model="body">
                        <button type="button" class="btn btn-primary" @click="store">
                            comment
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
        props:['type','model','count'],
        data() {
            return {
                body:'',
                comments:[],
                newComment:{
                    user:{
                        name:Zhihu.name,
                        avatar:Zhihu.avatar
                    },
                    body:''
                }
            }
        },
        computed:{
            dialog() {
                return 'comments-dialog-' + this.type + '-' + this.model
            },
            dialogId() {
                return '#' + this.dialog
            },
            text() {
                return this.count > 0 ? this.count + ' comments' : this.count + ' comment'
//                console.log('text entered.')

            }
        },
        methods: {
            store() {
                const that = this
                axios.post('/api/comment',{
                    'type':this.type,
                    'model':this.model,
                    'body':this.body,
                }).then(function(response) {
                    that.newComment.body = response.data.body
                    that.comments.push(that.newComment)
                    that.body = ''
                    that.count ++
                })
            },
            showCommentsForm() {
                this.getComments()
                const that = this
                $(that.dialogId).modal('show')
            },
            getComments() {
                const that = this
                axios.get('/api/' + this.type + '/' + this.model + '/comments').then(function(response) {
                    that.comments = response.data
                })
            }
        },
    }
</script>