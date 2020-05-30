<template>
    <div class="card chat-box">
        <div class="card-header">
            {{ chat.name }}
            <a href="" @click.prevent="close">
                <span clas="float-right">x</span>
            </a>
        </div>

        <div class="card-body" v-chat-scroll>
            <p class="card-text"
                :class="{'text-right' : chat.type == 0}"
                v-for="chat in chats"
                :key="chat.id">
                    {{chat.message}}
            </p>
        </div>

        <form class="card-footer" @submit.prevent="send">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Your message here..." v-model="message" />
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['chat'],
        data() {
            return {
                chats: [],
                open: true,
                message: null
            }
        },

        methods: {
            send() {
                if (this.message) {
                    this.pushToChat(this.message);

                    axios.post(`/send/${this.chat.session.id}`, {
                        body: this.message,
                        toUser: this.chat.id
                    });

                    this.message = null;
                }
            },

            pushToChat(message) {
                this.chats.push({
                    message: message,
                    type: 0,
                    sent_at: 'Just now'
                });
            },

            close() {
                this.$emit('close');
            },

            getAllMessages() {
                axios.post(`/session/${this.chat.session.id}/chats`)
                    .then(res => {
                        this.chats = res.data.data
                    });
            },

            read() {
                axios.post(`/session/${this.chat.session.id}/read`);
            }
        },

        created() {
            this.read();

            this.getAllMessages();

            Echo.private(`Chat.${this.chat.session.id}`)
                .listen('PrivateChatEvent', e => {
                    this.chat.session.open ? this.read() : '';
                    this.chats.push({
                        message: e.content,
                        type: 1,
                        sent_at: 'Just Now'
                    });
            });
        },
    }
</script>

<style>
    .chat-box {
        height: 400px;
    }

    .card-body {
        overflow-y: scroll;
    }
</style>