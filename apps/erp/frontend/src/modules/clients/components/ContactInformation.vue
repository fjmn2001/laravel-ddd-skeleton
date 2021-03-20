<template>
    <div class="xcontainer">
        <div class="mt-3">
            <div class="align-items-center d-flex justify-content-between pl-sm-3 pr-sm-3 pt-sm-3 row">
                <div class="d-flex">
                    <h4 class="ml-5 ml-md-4 pb-md-0" style="padding-left: 14px;">Información de contacto</h4>
                </div>
            </div>

            <div class="des01 pb-4 pl-4 pr-4">
                <div class="mt-3 pl-3 pr-3 row">

                    <div class="col-lg-6">
                        <div class="row" v-for="(row, index) in client.emails" :index="index" :key="row.id">
                            <div class="col-md-5">
                                <label>Correo electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i>@</i></span>
                                    <input type="text" class="form-control inp-filter" v-model="row.email">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label>Uso del correo</label>
                                <select class="form-control inp-filter" v-model="row.emailType">
                                    <option value="">Seleccione</option>
                                    <option value="trabajo">Trabajo</option>
                                    <option value="movil">Personal</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>
                            <div class="col-md-2 pad-l29">
                                <button type="button" class="btn btn-block btn-outline-secondary d-inline" v-if="index === 0" @click.prevent="addRowEmail">+</button>
                                <button type="button" class="btn btn-block btn-outline-secondary d-inline" v-if="index !== 0" @click.prevent="removeEmail(row)"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row" v-for="(row, index) in client.phones" :index="index" :key="row.id">
                            <div class="col-md-5">
                                <label>Teléfono *</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control inp-filter" v-model="row.number">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label>Uso del teléfono</label>
                                <select class="form-control inp-filter" v-model="row.numberType">
                                    <option value="">Seleccione</option>
                                    <option value="trabajo">Trabajo</option>
                                    <option value="movil">Móvil</option>
                                    <option value="fax">Fax</option>
                                    <option value="residencial">Residencial</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>
                            <div class="col-md-2 pad-l29">
                                <button type="button" class="btn btn-block btn-outline-secondary d-inline" v-if="index === 0" @click.prevent="addRowPhone">+</button>
                                <button type="button" class="btn btn-block btn-outline-secondary d-inline" v-if="index !== 0" @click.prevent="removePhone(row)"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>

<script lang="ts">
import {defineComponent, onMounted} from "vue";
import {useClient} from "@/modules/clients/use/useClient";

export default defineComponent({
    components: {},
    setup() {
        const {client, addEmail, addPhone} = useClient();

        onMounted(() => {
            if(!client.value.emails.length){
                client.value.emails.push(addEmail())
            }

            if(!client.value.phones.length){
                client.value.phones.push(addPhone())
            }
        });

        function addRowEmail(): void {
            client.value.emails.push(addEmail())
        }

        function addRowPhone(): void {
            client.value.phones.push(addPhone())
        }

        function removeEmail(row: object): void {
            const index = client.value.emails.indexOf(row)
            client.value.emails.splice( index, 1 );
        }

        function removePhone(row: object): void {
            const index = client.value.phones.indexOf(row)
            client.value.phones.splice( index, 1 );
        }

        return {
            client,
            addRowEmail,
            addRowPhone,
            removeEmail,
            removePhone,
        };
    }
})
</script>

<style scoped>

</style>
