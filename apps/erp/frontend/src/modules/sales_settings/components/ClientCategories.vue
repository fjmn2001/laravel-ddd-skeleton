<template>
    <div class="config-div02 pr-5 pl-5 pt-4">
        <div class="pl-3 pl-md-2">
            <div class="d-flex pt-2 row">
                <div style="padding-left: 0px;" class="align-items-center col-md-12 d-flex">
                    <h5 class="d-inline ml-lg-0 ml-md-3 ml-sm-3 xtitle-buscar-guardar">Buscar y guardar&nbsp;
                        categorías de cliente</h5>
                </div>
            </div>

            <form class="des01 mb-3 ml-0 mr-3 mt-3" @submit.prevent="submit" autocomplete="off">
                <div class=" row">
                    <div class="col-lg-3 col-md-6 col-sm-12 pl-3 pl-lg-0 pl-md-3">
                        <label>Nombre *</label>
                        <input type="text" name="name" v-model="name" required="" class="form-control inp-filter">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 ">
                        <label>Descripción</label>
                        <input type="text" name="description" v-model="description" class="form-control inp-filter">
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 pr-lg-0">
                        <label>Estado *</label>
                        <select name="state" required="" class="form-control inp-filter" v-model="state">
                            <option value="">Select</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="mt-3 row" style="width: 100%;">
                    <div
                        class="col-lg-7 col-md-8 col-xl-6 d-flex justify-content-around offset-lg-5 offset-md-4 offset-xl-6">
                        <button type="button" class="btn btn-blue2-deg btn-sm pl-3 pr-3" :disabled="sending"
                                @click.prevent="search">Buscar
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm mr-0 pl-3 pr-3"
                                style="margin: 10px 0px; min-width: 100px;" @click="myReset" :disabled="sending">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-blue-deg btn-sm pl-3 pr-3" :disabled="sending">Guardar
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent, ref, Ref, watch} from "vue";
import {Company} from "@/modules/auth/types/Company";
import {useAuth} from "@/modules/auth/use/useAuth";
import {useClientCategory} from "@/modules/sales_settings/use/useClientCategory/useClientCategory";

export default defineComponent({
    setup() {
        const {user} = useAuth();
        const {create, clientCategory} = useClientCategory();


        const loading: Ref<boolean> = ref(true);
        const sending: Ref<boolean> = ref(false);
        const editing: Ref<boolean> = ref(false);

        //..
        const name: Ref<string> = ref('');
        const description: Ref<string> = ref('');
        const state: Ref<string> = ref('');

        watch(() => name.value, (val) => clientCategory.value.name = val)
        watch(() => description.value, (val) => clientCategory.value.description = val)
        watch(() => state.value, (val) => clientCategory.value.state = val)
        //when changeCompany
        watch(() => user.value?.company, async (company: Company | undefined) => {
            if (company) {
                console.log(company);
            }
        })

        async function submit() {
            try {
                sending.value = true
                if (editing.value) {
                    console.log('edit');
                } else {
                    await create()
                }
            } catch (e) {
                console.log(e);
            } finally {
                sending.value = false
            }
        }


        async function myReset() {
            console.log('Reset')
        }

        async function search() {
            console.log('search')
        }

        return {
            name,
            description,
            state,

            loading,
            sending,
            editing,

            submit,
            myReset,
            search,
        }
    }
});
</script>

<style scoped>

</style>
