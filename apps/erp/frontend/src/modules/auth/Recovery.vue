<template>
    <div class="container">
        <div class=" center-login-med row ">
            <form class="col-lg-7 col-md-9 col-sm-11 row-login text-center" @submit.prevent="submit">
                <img src="@/assets/images/logo2_SF_1.svg" class="img-fluid mb-5">
                <div class="div-text mb-5">
                    <h4 class="font-italic font-weight-bold text-re"><b class="clr-text">Recuperar Contraseña</b></h4>
                    <p class="mb-4 mt-4 text-in">Ingresa el correo electrónico para reiniciar la contraseña y enviarle
                        una nueva.<br>Al ingresar la nueva contraseña deberás actualizarla</p>
                </div>
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text input-login"><img src="@/assets/images/icons/@.svg"></span>
                    </div>
                    <input type="email" name="username" required v-model="email" class="form-control input-login"
                           aria-label="Username"
                           aria-describedby="basic-addon1" placeholder="Dirección de correo electrónico">
                </div>
                <button type="submit" class="btn btn-block btn-sm font-weight-bold linear-btn mb-3 text-white">Enviar
                </button>
                <div v-show="errorMessage" class="alert alert-danger" role="alert">
                    <p v-text="errorMessage"></p>
                </div>
                <div v-show="successMessage" class="alert alert-success" role="alert">
                    <p v-text="successMessage"></p>
                </div>
                <div class="pt-3 text-left">
                    <router-link class="olvidar-clave" :to="{name: 'auth.login'}">Iniciar Sesión</router-link>
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
import {Component, Vue} from 'vue-property-decorator';

@Component
export default class Login extends Vue {
    email = '';
    sending = false;
    errorMessage = '';
    successMessage = '';

    submit() {
        this.sending = true;
        this.$store.dispatch('auth/passwordRequest', {
            email: this.email
        }).then(() => {
            this.errorMessage = '';
            this.successMessage = `Se ha enviado un mensaje a ${this.email} para continuar con la recuperación de la contraseña.`;
        }).catch(error => {
            console.log(error)
            this.errorMessage = error.response?.data?.message;
            this.successMessage = '';
            this.sending = false;
        });
    }
}
</script>

<style scoped>

</style>
