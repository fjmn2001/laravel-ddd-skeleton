<template>
    <teleport to="body">
        <div class="modal fade" :id="name" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Options</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                @click.prevent="hideModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4"></div>
                </div>
            </div>
        </div>
    </teleport>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import {useModal} from "@/use/useModal";

export default defineComponent({
    props: {
        name: {
            type: String,
            required: true
        }
    },
    setup(props) {
        const {hide} = useModal();

        function hideModal() {
            hide(props.name)
        }

        return {
            hideModal
        }
    }
})
</script>

<style scoped>

</style>
