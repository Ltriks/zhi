<template>
    <button
            class="btn btn-default"
            v-bind:class="{'btn-success': followed}"
            v-text="text"
            v-on:click="follow"
    ></button>
</template>

<script>
    export default {
        props:['question'],
        mounted() {
            const that = this
            axios.post('/api/question/follower',{
                'question':this.question,
            }).then(function(response) {
                that.followed = response.data.followed
            })
        },
        data() {
            return {
                followed: false
            }
        },
        computed: {
            text() {
                return this.followed ? 'followed' : 'follow'
            }
        },
        methods: {
            follow() {
                const that = this
                axios.post('/api/question/follow',{
                    'question':this.question,
                }).then(function(response) {
                    that.followed = response.data.followed
                })
            }
        },
    }
</script>