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
import toastr from "toastr";
import {defineComponent, ref, onMounted, nextTick, watch} from 'vue'
import {useRouter} from 'vue-router'
import Breadcrums from '@/components/Breadcrums.vue';
import GeneralsDetails from "@/modules/items/components/GeneralsDetails.vue";
import FormButtons from "@/components/FormButtons.vue";
import {useItem} from "@/modules/items/use/useItem";
import {useCore} from "@/modules/shared/use/useCore";
import Loading from "@/components/form/Loading.vue";
import {Company} from "@/modules/auth/types/Company";
import {useAuth} from "@/modules/auth/use/useAuth";

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
        const {user} = useAuth();

        onMounted(async () => {
            await find(props.id ? props.id : '')
            nextTick(() => loading.value = false);
        });

        //when changeCompany
        watch(() => user.value?.company, async (company: Company | undefined) => {
            if (company) {
                router.push({name: 'items'});
            }
        })

        function cancel(): void {
            router.push({name: 'items'});
        }

        async function submit() {
            try {
                sending.value = true
                await update();
                toastr.success("Su solicitud se ha procesado correctamente.");
                router.push({name: 'items'});
            } catch (e) {
                toastr.error(e?.response?.data?.message);
                console.log(e);
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
