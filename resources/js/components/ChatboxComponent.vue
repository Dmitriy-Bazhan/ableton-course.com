<template>

    <div class="chatbox p-3">

        <div class="row mt-5">

            <div class="col-10">

                <textarea class="textarea_in_vue" rows="3" maxlength="500" v-model="textMessage"></textarea>

            </div>

        </div>

        <div class="row mt-2">

            <div class="col">

                <button class="btn btn-primary" @click="sendMessage()">Send</button>

            </div>

        </div>

        <br>

        <div class="col-lg-9 lesson_comments_menu">

            <div class="lesson_comments_menu_scroll">

                <span id="block_comments"></span>

                <div class="messages">

                </div>

            </div>

        </div>


    </div>

</template>

<script>

    export default {
        props: ['comments'],
        mounted() {
            var arr = JSON.parse(this.comments);
            arr.forEach(function callback(element, index, arr) {
                var insert = '<div class="message"><div class="message_div1"><span class="span_message_vue">' + element['created_at'] + ' ' + element['body'] + '</span></div><br></div>';
                $('.messages').append(insert);
            });
        },
        data() {
            return {
                textMessage: '',
                messages: [],
            }
        },
        created() {
            let date = new Date();
            this.addMessage(' ');
            Echo.channel('chatbox')
                .listen('MessageSend', (e) => {
                    this.addMessage(e.message);
                });
        },
        methods: {
            addMessage(message,user) {
                let date = new Date();
                let timestamp = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
                var putVar = '<div class="message"><div class="message_div1"><span class="span_message_vue">' + timestamp + message + '</span></div><br></div>';
                $('#block_comments').after(putVar);
            },
            sendMessage() {
                axios.post('/api/message', {message: this.textMessage});
                this.textMessage = '';
            },
        }
    }
</script>

<style>
    .message_div1 {
        width: 100%;
        border: solid 2px #6d6a80;
        padding: 15px;
        border-radius: 30px;
        background: #6d6a80;
    }

    .span_message_vue {
        color: #ecc699;
        width: 95%;
        word-break: break-all;
        font-size: 15pt;
    }

    .textarea_in_vue {
        resize: none;
        width: 91%;
        background: #6d6a80;
        outline: none;
        font-size: 15pt;
        color: #ecc699;
        padding: 15px;
    }
</style>
