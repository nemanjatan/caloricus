<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Chats</div>

                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"
                                @click.prevent="openChat(chat)"
                                :key="chat.id"
                                v-for="chat in chats">
                                    <a href="">
                                        {{ chat.name }}
                                        <span class="text-danger" v-if="chat.session && chat.session.unreadCount > 0">{{ chat.session.unreadCount }}</span>
                                    </a>
                                    <p>Status: <span v-if="chat.online">Online</span> </p>
                            </li>
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
                axios.post('/getChats').then(res => {
                    this.chats = res.data.data;
                    this.chats.forEach(chat => {
                        chat.session ? this.listenForEverySession(chat) : ''
                    })
                });
            },

            openChat(chat) {
                if (chat.session) {
                    this.chats.forEach(chat => {
                        chat.session ? chat.session.open = false : '';
                    });
                    chat.session.open = true;
                    chat.session.unreadCount = 0;
                } else {
                    this.chats.forEach(chat => {
                        if (chat.session) {
                            chat.session.open = false
                        }
                    });
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
            },

            listenForEverySession(chat) {
                Echo.private(`Chat.${chat.session.id}`)
                    .listen('PrivateChatEvent', () => (chat.session.open ? '' : chat.session.unreadCount++));
            }
        },

        created() {
            this.getChats();

            Echo.channel('Chat').listen('SessionEvent', e => {
                let chat = this.chats.find(chat => chat.id == e.sessionBy);
                chat.session = e.session;
                this.listenForEverySession(chat);
            });

            Echo.join('Chat')
            .here((users) => {
                this.chats.forEach(chat => {
                    users.forEach(user => {
                        user.id == chat.id ? chat.online = true : '';
                    })
                })
            })
            .joining((user) => {
                this.chats.forEach(chat => user.id == chat.id ? chat.online = true : '')
            })
            .leaving((user) => {
                this.chats.forEach(chat => user.id == chat.id ? chat.online = false : '')
            });
        },

        components: {
            MessageComponent
        }
    }
</script>
