<template>

    <div>

        <select v-model="option">
            <option :value="report" :key="key" v-for="(report, key) in reports"> {{ report }} </option>
        </select>

        <select v-if="option" v-model="value">
            <option :value="item" :key="key" v-for="(item, key) in getvalues(option)"> {{ item }} </option>
        </select>

    </div>

</template>

<script>

import _ from 'lodash';

export default {
    props: {
        options: []
    },
    data: function () {
        return {
            option: null,
            value: null
        }
    },
    computed: {
        reports()
        {
            return _.keys(this.options);
        }
    },
    methods: {
        getvalues(option) {
            return this.options[option];
        }
    }
}
</script>
