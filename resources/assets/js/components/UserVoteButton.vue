<template>
    <button
            class="btn btn-default"
            v-bind:class="{'btn-primary': voted}"
            v-text="text"
            v-on:click="vote"
    ></button>
</template>

<script>
    export default {
        props:['answer','count'],
        mounted() {
            const that = this
            axios.post('/api/answer/' + this.answer + '/votes/users').then(function(response) {
                that.voted = response.data.voted
            })
        },
        data() {
            return {
                voted: false
            }
        },
        computed: {
            text() {
                return this.count
            }
        },
        methods: {
            vote() {
                const that = this
                axios.post('/api/answer/votes',{
                    'answer':this.answer,
                }).then(function(response) {
                    that.voted = response.data.voted
                    response.data.voted ? that.count ++ : that.count --
                })
            }
        },
    }
</script>