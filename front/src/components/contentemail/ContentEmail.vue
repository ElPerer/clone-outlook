<template>
    <q-page>
        <!-- VALIDACIÓN PARA INDICAR SI MOSTRAR EL CONTENIDO DEL MENSAJE O MOSTRAR LA IMAGEN -->
        <div v-if="emailId != null">
            <div class="row q-pa-md q-col-gutter-xs">
                <div class="col-sm-10">
                    <q-btn-dropdown
                        split
                        color="accent"
                        label="Actuaizar"
                        @click="updateEmail"
                    >
                        <q-list dense>
                            <q-item clickable v-close-popup @click="updateEmail" class="q-my-sm">
                                <q-item-section>
                                    <q-item-label>Actualizar</q-item-label>
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
        </div>
        <!-- MOSTRAR LA IMAGEN EN DADO CASO QUE NO SE SELCCIONE UN CORREO A EDITAR -->
        <div v-else>
            <q-img class="q-my-md" src="https://d28hi93gr697ol.cloudfront.net/_global/sin-resultados-search.png" />
        </div>
    </q-page>
</template>
  
<script>
import { api } from 'boot/axios'
import { defineComponent } from 'vue'
export default defineComponent({
    name: 'ContentEmail',
    props: {
        emailId: Number
    },
    created () {
        this.fetchFromServer()
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
        async fetchFromServer () {
            this.$loading()
            const params = {}
            if (this.emailId != null) {
                // LAS CONDITIONS SE MANDAN AL BACK PARA PODER TRAER EL DATO ESPECIFICANDO EL ID 
                params.conditions = [[
                    'id', '=', this.emailId
                ]]
                const { data: { data } } = await api.get('v1/inbox/', { params })
                this.form.fields.para = data[0].para
                this.form.fields.asunto = data[0].asunto
                this.form.fields.contenido = data[0].contenido
            }
            this.$q.loading.hide()
        },
        async updateEmail() {
            try {
                // LOADING ESTÁ COMO HELPER EN LA CARPETA boot/helpers.js
                this.$loading('Actualizando correo...')
                const params = { ...this.form.fields }
                const { data } = await api.put(`v1/messages/${this.emailId}`, params)
                console.log(data)
                // NOTIFY ESTÁ COMO HELPER EN LA CARPETA boot/helpers.js
                this.$notify(data.message)
            } catch (error) {
                console.error('Error al guardar el registro:', error);
            }
            this.$q.loading.hide()
            location.reload();
        },
    }
});
</script>
  
<style></style>