<template>

    <div class="chatbox p-3">

        <div class="row mt-5">

            <div class="col-lg-9">

                <textarea class="textarea_in_vue" rows="3" maxlength="500" v-model="textMessage"
                          placeholder="Enter message"></textarea>

            </div>

        </div>

        <div class="row mt-2">

            <div class="col-lg-9">

                <button class="message_button" @click="sendMessage()">
<!--                    <span class="oi oi-media-skip-forward"></span>-->
                    <span class="oi oi-comment-square"></span>
<!--                    <span class="oi oi-envelope-closed"></span>-->
                </button>

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
                var insert = '<div class="message">' +
                    '<div class="div_date_message"><span class="date_message">' + element['created_at'] + '</span></div>' +
                    '<div class="message_div1">' +
                    '<span class="span_message_vue">' + ' ' + element['body'] + '</span>' +
                    '</div><br></div>';
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
                    // console.log(e);
                    this.addMessage(e.message);
                });
        },
        methods: {
            addMessage(message, user) {
                let date = new Date();
                let timestamp = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
                var putVar = '<div class="message">' +
                    '<div class="div_date_message"><span class="date_message">' + timestamp + '</span></div>' +
                    '<div class="message_div1">' +
                    '<span class="span_message_vue">' + message + '</span>' +
                    '</div><br></div>';
                $('#block_comments').after(putVar);
            },
            sendMessage() {
                // console.log(this.textMessage);
                axios.post('/api/message', {message: this.textMessage});
                this.textMessage = '';
            },
        }
    }
</script>

<style>
    .message_button {
        float: right;
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 10px;
        padding-bottom: 10px;
        background: #373539;
        color: wheat;
        border-radius: 15px;
        border: solid 1px black;
        box-shadow: 7px 7px black;
    }

    .message_button:hover {
        color: lightgreen;
        box-shadow: 4px 4px black;
    }

    .message_button:focus {
        outline: 0;
    }

    .message_button:active {
        box-shadow: none !important;
        padding: 10px;
        background: #373539;
        color: wheat;
        border-radius: 15px;
        border: solid 1px black;
        box-shadow: 10px 10px black;
    }

    .message_div1 {
        width: 100%;
        /*border: solid 2px #6d6a80;*/
        padding: 15px;
        /*border-radius: 30px;*/
        /*background: #6d6a80;*/
    }

    .span_message_vue {
        color: wheat;
        width: 95%;
        word-break: break-all;
        font-size: 15pt;
    }

    .textarea_in_vue {
        resize: none;
        width: 100%;
        /*background: #6d6a80;*/
        background: #373539;
        border: solid 1px black;
        border-radius: 30px;
        box-shadow: 10px 10px black;
        outline: none;
        font-size: 15pt;
        color: #ecc699;
        padding: 15px;
    }

    .date_message {
        color: #ec665c;
        width: 95%;
        word-break: break-all;
        font-size: 12pt;
    }

    .username_message {
        color: #39ec3f;
        width: 95%;
        word-break: break-all;
        font-size: 15pt;
    }

    .div_date_message {
        /*width: 100%;*/
        display: inline-block;
        /*border: solid 2px #6d6a80;*/
        padding: 5px;
        /*border-radius: 30px;*/
        /*background: #6d6a80;*/
    }
</style>
