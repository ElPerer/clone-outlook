<template>
    <q-page>
        <div class="row q-pa-md q-col-gutter-xs">
            <div class="col-sm-10">
                <q-btn-dropdown
                    split
                    color="accent"
                    label="Enviar"
                    @click="sendEmail"
                >
                    <q-list dense>
                        <q-item clickable v-close-popup @click="sendEmail" class="q-my-sm">
                            <q-item-section>
                                <q-item-label>Enviar</q-item-label>
                            </q-item-section>
                        </q-item>
                    </q-list>
                </q-btn-dropdown>
            </div>

            <div class="col-sm-2 float-right">
                <q-btn flat square icon="delete" @click="this.$router.push('/email')" >
                    <q-tooltip class="bg-primary text-body2" :offset="[10, 10]">
                        Descartar
                    </q-tooltip>
                </q-btn>
            </div>
        </div>
        <q-separator />
        <div class="row q-px-md q-col-gutter-xs">
            <div class="col-sm-12 float-right">
                <q-input borderless  v-model="text">
                    <template v-slot:prepend>
                        <q-btn rounded color="accent" label="Para" />
                    </template>
                    <template v-slot:append>
                        <q-btn flat square label="cc" />
                        <q-btn flat square label="cco"  />
                    </template>
                </q-input>
            </div>
        </div>
        <q-separator />
        <div class="row q-px-md q-col-gutter-xs">
            <div class="col-sm-12 float-right">
                <q-input borderless placeholder="Agregar un asunto" v-model="text" />
            </div>
        </div>
        <q-separator />
        <div class="row q-col-gutter-xs">
            <div class="col-xs-12 col-sm-12">
                <q-input
                v-model="text"
                filled
                type="textarea"
                />
            </div>
        </div>
    </q-page>
</template>
  
<script>
import { api } from 'boot/axios'
import { defineComponent } from 'vue'
// import { required, alphaNum, maxLength } from '@vuelidate/validators'
// import { useVuelidate } from '@vuelidate/core'
export default defineComponent({
    name: 'NewEmail',
    /* validations: {
        form: {
            fields: {
                code: { required, alphaNum, maxLength: maxLength(5) },
                name: { required, maxLength: maxLength(255), }
            },
        }
    }, */
    // setup: () => ({ v$: useVuelidate() }),
    created () {
        console.log('in nre')
    },
    data: () => ({
        form: {
            fields: {
                code: null,
                name: null
            }
        },
        actionsBreadCrumbsItems: [
            { type: 'button', style: 'color: white', icon: 'save', label: 'Guardar', emit: 'saveData', dateEmit: true }
        ]

    }),
    /* computed: {
        codeRules() {
            return [
                () => !this.v$.form.fields.code.required.$invalid || 'El campo es requerido.',
                () => !this.v$.form.fields.code.maxLength.$invalid || 'El campo debe tener máximo 5 caracteres.',
                // () => /^[a-zA-Z0-9]*$/.test(this.v$.form.fields.code) || 'El campo debe ser alfanumérico.'

            ]
        },
        nameRules() {
            return [
                () => !this.v$.form.fields.name.required.$invalid || 'El campo es requerido.',
                () => !this.v$.form.fields.name.maxLength.$invalid || 'El campo debe tener máximo 255 caracteres.'

            ]
        }
    }, */
    methods: {
        async sendEmail(val) {
            try {
                this.v$.form.fields.$reset()
                this.v$.form.fields.$touch()
                if (this.v$.form.fields.$error) {
                    this.$notify(this.$messageValidate);
                    return false
                }
                this.$loading('Ingresando categoría')
                const params = { ...this.form.fields }
                const { data } = await api.post('category', params)
                this.$notify(data.message)
                this.clearFields()
            } catch (error) {
                console.error('Error al guardar el registro:', error);
            }
            this.$q.loading.hide()
        },
        clearFields() {
            this.form.fields.code = null
            this.form.fields.name = null
        },
        isMobile() {
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                return true
            } else {
                return false
            }
        }
    }
});
</script>
  
<style></style>