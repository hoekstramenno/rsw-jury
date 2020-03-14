<template>


    <tr>
        <td class="col-4">
            <label class="col-sm-2 col-form-label"><strong>Start</strong></label>

                <input type="time" class="form-control" v-model="startTime">

        </td>
        <td class="col-4">
            <label class="col-sm-2 col-form-label"><strong>Eind</strong></label>

                <input type="time" class="form-control" v-model="endTime">

        </td>
        <td class="col-4">
            <div>{{ difference }} uur</div>
        </td>
    </tr>


</template>

<script>

    import moment from "moment";
    import axios from 'axios';

    export default {
        props: {
            team: {
                type: Number,
                required: true,
            },
            start: {
                type: String,
                default: '00:00:00',
            },
            end: {
                type: String,
                default: '00:00:00',
            },
        },
        data: function () {
            return {
                startTime: this.start ? this.start : '00:00:00',
                endTime: this.end ? this.end : '00:00:00',
            };
        },
        computed: {
            difference: function () {
                console.log(this.startTime, this.endTime);
                let diff = moment(this.endTime, "HH:mm:ss").diff(moment(this.startTime, "HH:mm:ss"));
                let d = moment.duration(diff);
                return [d.hours(), d.minutes(), d.seconds()].join(':');
            },
            changeData() {
                const {startTime, endTime} = this;
                return {
                    'start': startTime,
                    'end': endTime
                }
            }
        },
        watch: {
            changeData: {
                handler: function (values) {
                    console.log(values);
                    const formData = new FormData();

                    for (const [key, value] of Object.entries(values)) {
                        formData.append(key, value);
                    }

                    axios
                        .post('/scores/hike-times/' + this.team, formData)
                        .then(response => {
                            console.log(response);
                        });
                },
                deep: true
            }
        }
    };
</script>
