<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12">
                <h1 class="text-center">Top Word</h1>
                <hr>
            </div>
            <div class="row mt-5">
                <div class="col-lg-5 offset-md-2">
                    <pie-chart :chart-data="piechartData"></pie-chart>
                </div>
                <div class="col-lg-5 text-left">
                    <ul style="list-style: none;padding: 0">
                        <li :key="index" v-for="(feedback, index) in data">
                            <h1 v-if="index == 0">
                                {{ feedback.word.toUpperCase() }}
                                {{ feedback.count }}
                            </h1>
                            <h2 v-if="index == 1">
                                {{ feedback.word.toUpperCase() }}
                                ( {{ feedback.count }} )
                            </h2>
                            <h3 v-if="index == 2">
                                {{ feedback.word.toUpperCase() }}
                                ( {{ feedback.count }} )</h3>
                            <h4 v-if="index > 2">
                                {{ feedback.word.toUpperCase() }}
                                ( {{ feedback.count }} )
                            </h4>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import palette from 'google-palette';

export default {
    data() {
        return {
            data: [],
            status: 'IDLE',
            message: ''
        }
    },

    mounted() {
        this.fetchInitialData();
        this.listenForChange();
    },

    computed: {
        piechartData: function () {
            return {
                datasets: [
                    {
                        data: this.$data.data.map(a => a.count),
                        backgroundColor: palette(["qualitative"],
                            this.$data.data.length
                        ).map(function (hex) {
                            return '#' + hex;
                        })
                    }
                ],
                labels: this.$data.data.map(a => a.word.toUpperCase())
            }
        }
    },

    methods: {
        fetchInitialData() {
            axios.get('/api/v1/feedback/data')
            .then(response => {
                this.$data.data = response.data;
                this.$data.status = 'SUCCESS';
            })
            .catch(error => {
                this.$data.status = 'ERROR';
            })
        },
        listenForChange() {
            window.Echo.channel('feedback-received').listen(
                'FeedbackReceived',
                payload => {
                    this.$data.data = payload
                },
            )
        }
    }
}
</script>

<style lang="css" scoped>
</style>
