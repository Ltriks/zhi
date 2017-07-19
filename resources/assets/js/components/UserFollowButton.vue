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
        props:['user'],
        mounted() {
            const that = this
            axios.get('/api/user/followers/' + this.user).then(function(response) {
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
                return this.followed ? 'followed' : 'follow TA'
            }
        },
        methods: {
            follow() {
                const that = this
                axios.post('/api/user/follow',{
                    'user':this.user,
                }).then(function(response) {
                    that.followed = response.data.followed
                })
            }
        },
    }
</script>