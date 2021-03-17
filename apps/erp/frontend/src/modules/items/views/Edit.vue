<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <form class="container-fluid main-conta" autocomplete="off" @submit.prevent="submit">
            <div class="pl-1 pr-1">
                <breadcrums :breadcrumbUrl="breadcrumbUrl"></breadcrums>
                <generals-details v-if="!loading"></generals-details>
                <loading v-show="loading"></loading>
            </div>
            <form-buttons @cancel="cancel" :disabledSave="sending"></form-buttons>
        </form>
    </div>
</template>

<script lang="ts">
import {defineComponent, ref, onMounted, nextTick} from 'vue'
import {useRouter} from 'vue-router'
import Breadcrums from '@/components/Breadcrums.vue';
import GeneralsDetails from "@/modules/items/components/GeneralsDetails.vue";
import FormButtons from "@/components/FormButtons.vue";
import {useItem} from "@/modules/items/use/useItem";
import {useCore} from "@/modules/shared/use/useCore";
import Loading from "@/components/form/Loading.vue";

export default defineComponent({
    components: {FormButtons, GeneralsDetails, Breadcrums, Loading},
    props: {
        id: {
            type: String,
            required: true
        }
    },
    setup(props) {
        const {ERP_URL} = useCore();
        const router = useRouter();

        const breadcrumbUrl: string = ERP_URL + '/api/items/breadcrumbs'
        const sending = ref(false)
        const loading = ref(true)
        const {find, update} = useItem()

        onMounted(async () => {
            await find(props.id ? props.id : '')
            nextTick(() => loading.value = false);
        });

        function cancel(): void {
            router.push({name: 'items'});
        }

        async function submit() {
            try {
                sending.value = true
                await update();
                //todo: add toast
                router.push({name: 'items'});
            } catch (e) {
                //todo: add toast
                console.log('2', e);
            } finally {
                sending.value = false
            }
        }

        return {
            breadcrumbUrl,
            sending,
            loading,
            submit,
            cancel
        }
    }
});
</script>

<style scoped>

</style>
