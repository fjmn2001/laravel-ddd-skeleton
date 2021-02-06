<template>
    <div class="page-wrapper" style="min-height: 875px;">
        <div class="container-fluid mt-lg-5 mt-md-5 pt-lg-2 pt-md-2">
            <div class="pl-1 pr-1">
                <breadcrums :breadcrumb_url="breadcrumb_url"></breadcrums>
                <div class="d-datos-principal ml-n3 mr-n3">
                    <p>Routes prototyped in vuejs</p>
                    <ul>
                        <li>Empresas</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';
import Breadcrums from '@/components/Breadcrums.vue';

@Component({
    components: {Breadcrums}
})

export default class Home extends Vue {
    breadcrumb_url = this.$store.state.ERP_URL + '/api/company/breadcrumbs'
}
</script>

<style scoped>

</style>
