<template>
    <div class="form-group form-check">
        <input type="checkbox"
               class="form-check-input"
               name="is_active"
               value="{{ value }}"
               id="is_active"
        >
        <label class="form-check-label" for="is_active">Активено</label>
    </div>
</template>

<script>
    export default {
        name: "Checkbox",
        data() {
            return {
                value: 0,
                checked
            }
        }
    }
</script>

<style scoped>

</style>
