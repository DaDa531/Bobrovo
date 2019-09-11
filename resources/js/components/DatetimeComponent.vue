<template>
    <datetime format="DD/MM/YYYY H:i:s" name="available_from" firstDayOfWeek="1"></datetime>
</template>

<script>
    import datetime from 'vuejs-datetimepicker';

    export default {
        components: { datetime }
    };
</script>
