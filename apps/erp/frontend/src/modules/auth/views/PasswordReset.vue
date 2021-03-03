<template>
    <div class="container">
        <div class=" center-login-med row ">
            <form class="col-lg-7 col-md-9 col-sm-11 row-login text-center" @submit.prevent="submit">
                <img src="@/assets/images/logo2_SF_1.svg" class="img-fluid mb-5">
                <div class="div-text mb-5">
                    <h4 class="font-italic font-weight-bold text-re"><b class="clr-text">Nueva Contraseña</b></h4>
                    <p class="mb-4 mt-4 text-in">Ingrese su nueva contraseña.</p>
                </div>
                <div class="input-group mb-5">
                    <div class="input-group-prepend">
                        <span class="input-group-text "><img src="@/assets/images/icons/key.svg"></span>
                    </div>
                    <input type="password" name="password" required class="form-control " aria-label="Username"
                           aria-describedby="basic-addon1"
                           placeholder="Contraseña" v-model="password">
                </div>
                <div class="input-group mb-5">
                    <div class="input-group-prepend">
                        <span class="input-group-text "><img src="@/assets/images/icons/key.svg"></span>
                    </div>
                    <input type="password" name="password_confirmation" required class="form-control "
                           aria-label="Username"
                           aria-describedby="basic-addon1"
                           placeholder="Confirmación de contraseña" v-model="passwordConfirmation">
                </div>
                <button type="submit" class="btn btn-block btn-sm font-weight-bold linear-btn mb-3 text-white">Enviar
                </button>
                <div v-show="errorMessage" class="alert alert-danger" role="alert">
                    <p v-text="errorMessage"></p>
                </div>
                <div v-show="successMessage" class="alert alert-success" role="alert">
                    <p v-text="successMessage"></p>
                </div>
                <div class="pt-5">
                    <p class="by mb-0">Diseñado y Desarrollado por &nbsp;<a class="olvidar-clave"
                                                                            href="https://medine.dev/" target="_blank">MEDINE</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent, ref} from 'vue'
import {useRouter} from 'vue-router'
import {useAuth} from "@/modules/auth/use/useAuth";

export default defineComponent({
    setup() {
        const router = useRouter();
        const {resetPassword} = useAuth();

        const password = ref('');
        const passwordConfirmation = ref('');
        const sending = ref(false);
        const errorMessage = ref('');
        const successMessage = ref('');

        function submit() {
            sending.value = true;
            const urlParams = new URLSearchParams(window.location.search);
            resetPassword({
                password: password.value,
                passwordConfirmation: passwordConfirmation.value,
                email: urlParams.get('email'),
                token: urlParams.get('token'),
            }).then(() => {
                errorMessage.value = '';
                router.push({name: 'auth.login'});
            }).catch(error => {
                console.log(error)
                errorMessage.value = error.response?.data;
                successMessage.value = '';
                sending.value = false;
            });
        }

        return {
            password,
            passwordConfirmation,
            sending,
            errorMessage,
            successMessage,
            submit
        }
    }
});
</script>

<style scoped>

</style>
