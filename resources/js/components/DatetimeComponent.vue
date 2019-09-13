<template>
    <datetime format="YYYY-MM-DD H:i:s" :name="name" :value="value" firstDayOfWeek="1"></datetime>
</template>

<script>
    import datetime from 'vuejs-datetimepicker';

    export default {
        components: { datetime },
        props: ['name', 'value']
    };
</script>
