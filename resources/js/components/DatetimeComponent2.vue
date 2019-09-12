<template>
    <datetime format="YYYY-MM-DD H:i:s" name="available_to" firstDayOfWeek="1"></datetime>
</template>

<script>
    import datetime from 'vuejs-datetimepicker';

    export default {
        components: { datetime }
    };
</script>
