<template>
    <div class="pb-4 pr-0 pr-md-3 pt-3 row">
        <div class="col-6 col-md-2 col-sm-6 offset-md-8">
            <button type="button" class="btn btn-block btn-outline-secondary mr-5 pl-3 pr-3"
                    style="margin: 10px 10px 10px 0px;" @click="cancel">Cancelar
            </button>
        </div>
        <div class="col-6 col-md-2 col-sm-6" style="margin-top: 3px;">
            <button type="submit" class="btn btn-block btn-blue-deg mb-2 mr-0 mr-md-5 mt-2"
                    style="height: 38px;" :disabled="disabledSave">Guardar
            </button>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
    props: {
        disabledSave: {
            type: Boolean,
            required: true
        }
    },
    setup(props, {emit}) {
        function cancel() {
            emit('cancel');
        }

        return {
            //disabledSave: props.disabledSave,
            cancel
        }
    }
});
</script>

<style scoped>

</style>
