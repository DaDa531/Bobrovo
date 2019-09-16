<template>
    <datetime format="YYYY-MM-DD H:i:s" :name="name" :value="value" firstDayOfWeek="1" required></datetime>
</template>

<script>
    import datetime from 'vuejs-datetimepicker';

    export default {
        components: { datetime },
        props: ['name', 'value']
    };
</script>
