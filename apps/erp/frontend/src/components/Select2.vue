<template>
    <select ref="root" :multiple="!!attr.multiple">
        <slot></slot>
    </select>
</template>

<script>
import $ from "jquery";

import {defineComponent, ref, onMounted, onUnmounted} from 'vue'

export default defineComponent({
    props: ['config', 'modelValue', 'attr'],
    setup(props, {emit}) {
        const root = ref(null)
        const contador = ref(0);
        const myConfig = ref({
            minimumInputLength: 0,
            width: '100%'
        });
        const myAjax = ref({
            delay: 700,
            dataType: 'json',
            processResults(data) {
                return {
                    results: data
                };
            },
            data(params) {
                return {
                    q: params.term
                }
            }
        });

        onMounted(() => {
            myConfig.value = $.extend(myConfig.value, props.config);

            if (props.config.ajax) {
                myConfig.value.ajax = $.extend(myAjax.value, props.config.ajax);
            }

            console.log(props.modelValue, 'prop value')


            window.$(root.value)
                // init select2
                .select2(myConfig.value)
                .val(props.modelValue)
                .trigger('change')
                // emit event on change.
                .on('change', function () {
                    console.log('change', $(root.value).val());
                    emit('update:modelValue', $(root.value).val());
                })
        })

        onUnmounted(() => {
            window.$(root.value).off().select2('destroy');
        })

        console.log(contador, myAjax, myConfig, props, 'ended');

        return {
            root
        }
    },

    // mounted() {

    // },
    //
    // watch: {
    //     value(value, oldValue) {
    //         let self = this;
    //         let isValidValue = (value) => {
    //             if (typeof value === 'object' && !_.isEmpty(value)) return true;
    //             if (typeof value === 'string' && value.length) return true;
    //             if (typeof value === 'number' && value) return true;
    //             return false;
    //         };
    //
    //         $(root.value).val(value);
    //         if ($(root.value).val() === null && isValidValue(value)) {
    //             let datos = $.extend({erptkn: window.tkn}, {id: value});
    //             $.ajax({
    //                 url: self.config.ajax.url(),
    //                 type: "POST",
    //                 data: datos,
    //                 dataType: "json",
    //                 success(data) {
    //                     if (!_.isEmpty(data)) {
    //                         if (typeof data[0] === 'object') {
    //                             _.forEach(data, (row) => {
    //                                 let text = typeof row.nombre !== 'undefined' ? row.nombre : row.text;
    //                                 $(self.$el).append('<option value="' + row.id + '" selected>' + text + '</option>');
    //                             });
    //                             setTimeout(function () {
    //                                 $(self.$el).val(value).trigger('change');
    //                             }, 1000);
    //                         } else {
    //                             let text = typeof data.nombre !== 'undefined' ? data.nombre : data.text;
    //                             $(self.$el).append('<option value="' + data.id + '" selected>' + text + '</option>');
    //
    //                             setTimeout(function () {
    //                                 $(self.$el).val(data.id != '' ? value : '').trigger('change');
    //                             });
    //                         }
    //                     }
    //                 }
    //             });
    //         } else {
    //             let aux = $(root.value).val();
    //
    //             if (_.isArray(aux) && aux.length === _.toArray(value).length && this.contador > 0) {
    //                 this.contador = 0;
    //                 return;
    //             }
    //
    //             this.contador += 1;
    //             $(root.value).val(value).trigger('change');
    //         }
    //     }
    // },
    //

})
</script>

<style lang="sass">
@import "./../assets/css/select2.min.css"
</style>
