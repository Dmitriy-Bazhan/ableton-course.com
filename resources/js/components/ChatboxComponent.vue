<template>

    <div class="chatbox p-3">

        <div class="col-lg-9 lesson_comments_menu">

            <div class="lesson_comments_menu_scroll">

                <div class="messages" v-if="messages.length">

                    <div class="message" v-for="message in messages">

                        <span class="d-inline-block nav-link text-white">{{ message }}</span>

                    </div>

                </div>

            </div>

        </div>

        <div class="row mt-5">

            <div class="col-3">

                <input type="text" class="form-control" v-model="textMessage">

            </div>

        </div>

        <div class="row mt-2">

            <div class="col">

                <button class="btn btn-primary" @click="sendMessage()">Send</button>

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
                var insert = '<div class="message"><span class="d-inline-block nav-link text-white">' + element['body'] + '</span></div>';
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
            addMessage(message) {
                let date = new Date();
                let timestamp = date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
                this.messages.push(timestamp + ' ' + message);
            },
            sendMessage() {
                axios.post('/api/message', {message: this.textMessage});
                this.textMessage = '';
            }
        }
    }

    // var block = document.getElementById("block");
    // block.scrollTop = block.scrollHeight;
</script>
