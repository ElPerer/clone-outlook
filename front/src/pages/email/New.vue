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
                <q-input borderless  v-model="form.fields.para">
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
                <q-input borderless placeholder="Agregar un asunto" v-model="form.fields.asunto" />
            </div>
        </div>
        <q-separator />
        <div class="row q-col-gutter-xs">
            <div class="col-xs-12 col-sm-12">
                <q-input
                v-model="form.fields.contenido"
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
export default defineComponent({
    name: 'NewEmail',
    created () {
        console.log('in nre')
    },
    data: () => ({
        text: '',
        form: {
            fields: {
                para: null,
                asunto: null,
                contenido: null,
            }
        }
    }),
    methods: {
        async sendEmail(val) {
            try {
                this.$loading('Enviando correo...')
                const params = { ...this.form.fields }
                const { data } = await api.post('v1/messages', params)
                console.log(data)
                this.$notify(data.message)
                this.clearFields()
            } catch (error) {
                console.error('Error al guardar el registro:', error);
            }
            this.$q.loading.hide()
        },
        clearFields() {
            this.form.fields.para = null
            this.form.fields.asunto = null
            this.form.fields.contenido = null
        }
    }
});
</script>
  
<style></style>