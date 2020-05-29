<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Chats</div>

                    <div class="card-body">
                        <ul class="list-group">
                            <a href="" v-for="chat in chats" :key="chat.id" @click.prevent="openChat(chat)">
                                <li class="list-group-item">
                                    {{ chat.name }}
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <span v-for="chat in chats" :key="chat.id" v-if="chat.session">
                    <message-component
                    v-if="chat.session.open"
                    @close="close(chat)"
                    :chat=chat></message-component>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    import MessageComponent from './MessageComponent';
    export default {
        data() {
            return {
                chats: []
            }
        },

        methods: {
            close(chat) {
                chat.session.open = false
            },

            getChats() {
                axios.post('/getChats').then(res => this.chats = res.data.data)
            },

            openChat(chat) {
                if (chat.session) {
                    this.chats.forEach(chat => {
                        chat.session.open = false
                    });
                    chat.session.open = true
                } else {
                    this.createSession(chat);
                }
            },

            createSession(chat) {
                axios
                    .post('/session/create', { chat_id: chat.id })
                    .then(res => {
                        chat.session = res.data.data;
                        chat.session.open = true;
                    });
            }
        },

        created() {
            this.getChats()
        },

        components: {
            MessageComponent
        }
    }
</script>
