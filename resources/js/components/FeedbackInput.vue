<template>
    <div class="container">
        <div>
            <div class="row mt-5">
                <div class="col-md-8 offset-md-2 text-center">
                    <h1>Gambarkan 3 kata, soal saya !</h1>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-6 offset-md-3">
                    <form @submit.prevent="submit">
                        <input type="text" class="form-control form-control-lg"
                            placeholder="Contoh: mantab keren banget"
                            :value="feedback"
                            @input="feedback = $event.target.value"
                            required
                        />
                        <br>
                        <button type="submit" :disabled="status == 'PROCESSING'"
                        class="btn btn-primary btn-block btn-lg"
                            > Submit
                        </button>
                    </form>
                    <br>
                    <div class="alert alert-danger" v-if="status == 'ERROR'">
                        {{ message }}
                    </div>
                    <div class="alert alert-success" v-if="status == 'SUCCESS'">
                        {{ message }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            feedback: '',
            status: 'IDLE', // IDLE | SUBMITTING | ERROR | SUCCESS
            message: ''
        }
    },

    mounted() {

    },

    methods: {
        submit: function () {
            this.status = 'SUBMITTING';
            axios.post('/api/v1/feedback', {
                words: this.$data.feedback
            })
            .then(response => {
                this.feedback = '';
                this.$data.status = 'SUCCESS';
                this.$data.message = 'Terima kasih atas partisipasi anda !';
            })
            .catch(error => {
                this.$data.status = 'ERROR';
                if (error.response.data.message) {
                    this.$data.message = error.response.data.message
                } else {
                    this.$data.message = 'Terjadi kesalahan saat melakukan feedback !';
                }

                console.error(error)
            })
        }
    }
}
</script>

<style lang="css" scoped>
</style>
