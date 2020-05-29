<template>
    <div class="card chat-box">
        <div class="card-header">
            {{ chat.name }}
            <a href="" @click.prevent="close">
                <span clas="float-right">x</span>
            </a>
        </div>

        <div class="card-body" v-chat-scroll>
            <p class="card-text" v-for="chat in chats" :key="chat.message">
                {{chat.message}}
            </p>
        </div>

        <form class="card-footer" @submit.prevent="send">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Your message here..." />
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
                open: true
            }
        },

        methods: {
            send() {
                console.log('acab');
            },

            close() {
                this.$emit('close');
            }
        },

        created() {
            this.chats.push(
                { message: 'Test 1' },
                { message: 'Test 2' },
                { message: 'Test 3' }
            );
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