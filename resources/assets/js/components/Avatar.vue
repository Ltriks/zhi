<template>
<div style="text-align: center;">
    <my-upload field="img"
        @crop-success="cropSuccess"
        @crop-upload-success="cropUploadSuccess"
        @crop-upload-fail="cropUploadFail"
        v-model="show"
        :width="100"
        :height="100"
        url="/avatar"
        :params="params"
        :headers="headers"
        img-format="png"></my-upload>
    <img :src="imgDataUrl" style="width: 80px;">
    <div style="margin-top: 20px;"><button class="btn btn-default" @click="toggleShow">set avatar</button></div>
</div>
</template>

<script>
    import 'babel-polyfill'; // es6 shim
    import myUpload from 'vue-image-crop-upload';

    export default {
        props:['avatar'],
        data() {
            return {
                show: false,
                params: {
                    _token: document.head.querySelector('meta[name="csrf-token"]').content,
                    name: 'img'
                },
                headers: {
                    smail: '*_~'
                },
                imgDataUrl: this.avatar 
            }
        },
        components: {
            'my-upload': myUpload
        },
        methods: {
            toggleShow() {
                this.show = !this.show;
            },
            /**
             * crop success
             *
             * [param] imgDataUrl
             * [param] field
             */
            cropSuccess(imgDataUrl, field){
                console.log('-------- crop success --------');
                this.imgDataUrl = imgDataUrl;
            },
            /**
             * upload success
             *
             * [param] jsonData  server api return data, already json encode
             * [param] field
             */
            cropUploadSuccess(response, field){
                this.imgDataUrl = response.url
                this.toggleShow()
            },
            /**
             * upload fail
             *
             * [param] status    server api return error status, like 500
             * [param] field
             */
            cropUploadFail(status, field){
                console.log('-------- upload fail --------');
                console.log(status);
                console.log('field: ' + field);
            }
        }
    }
</script>
