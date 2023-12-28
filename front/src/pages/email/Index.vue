<template>
  <div class="row q-col-gutter-lg">
    <div class="col-xs-12 col-sm-5">
      <q-tabs v-model="tab" dense>
        <q-tab name="prioritarios" label="Prioritarios" />
        <q-tab name="otros" label="Otros" />
        <q-btn-dropdown auto-close stretch flat>
          <template v-slot:label>
            <div>
              <div class="row justify-around items-center no-wrap">
                <q-icon name="filter_list" />
              </div>
              <div class="row items-center no-wrap">
                Filtrar
              </div>
            </div>
          </template>

          <q-list>
            <q-item clickable @click="tab = 'read'">
              <q-item-section avatar>
                <q-icon name="email" text-color="white" />
              </q-item-section>
              <q-item-section>
                  <q-item-label>Todo</q-item-label>
              </q-item-section>
            </q-item>

            <q-item clickable @click="tab = 'notread'">
              <q-item-section avatar>
                <q-icon name="mark_email_unread" text-color="white" />
              </q-item-section>
              <q-item-section>
                  <q-item-label>No leído</q-item-label>
              </q-item-section>
            </q-item>

            <q-item clickable @click="tab = 'mark'">
              <q-item-section avatar>
                <q-icon name="flag" text-color="white" />
              </q-item-section>
              <q-item-section>
                  <q-item-label>Marcado</q-item-label>
              </q-item-section>
            </q-item>

            <q-item clickable @click="tab = 'formy'">
              <q-item-section avatar>
                <q-icon name="send" text-color="white" />
              </q-item-section>
              <q-item-section>
                  <q-item-label>Para mí</q-item-label>
              </q-item-section>
            </q-item>

            <q-item clickable @click="tab = 'files'">
              <q-item-section avatar>
                <q-icon name="attach_file" text-color="white" />
              </q-item-section>
              <q-item-section>
                  <q-item-label>Tiene archivos</q-item-label>
              </q-item-section>
            </q-item>

            <q-item clickable @click="tab = 'spell'">
              <q-item-section avatar>
                <q-icon name="alternate_email" text-color="white" />
              </q-item-section>
              <q-item-section>
                  <q-item-label>Me menciona</q-item-label>
              </q-item-section>
            </q-item>
          </q-list>
        </q-btn-dropdown>
      </q-tabs>
      <!-- LA PROPIEDAD SCROLL LLEVA EL CONTROL EN DONDE ESTAMOS POSICIONADOS -->
      <q-scroll-area style="height: 400px; max-width: 500px;" @scroll="onBottom">
        <div v-for="email in rows" :key="email" class="q-py-sm q-px-md">
        <!-- CARTA Y SU CONTENIDO, ESTA CARTA ES LA QUE MUESTRA LOS MENSAJES EN LA BANDEJA -->
        <q-card class="my-card" flat bordered>
          <q-card-section horizontal>
            <q-item-section avatar class="q-ml-sm">
              <q-avatar>
                <img src="https://solicitudes.cimalogistic.com/images/cima.png">
              </q-avatar>
            </q-item-section>

            <q-card-section>
              Para: {{email.para}}
              <br>
              Asunto: {{email.asunto}}
              <br>
              Fecha: {{email.created_at}}
            </q-card-section>

            <q-card-actions vertical class="justify-around">
              <!-- BOTONES CON SUS MÉTODOS UTILIZADOS PARA PODER EDITAR Y ELIMINAR UN CORREO -->
              <q-btn flat round color="yellow" icon="edit" @click="updateEmail(email.id)"/>
              <q-btn flat round color="red" icon="delete" @click="deleteEmail(email.id)"/>
            </q-card-actions>
          </q-card-section>
        </q-card>
        </div>
      </q-scroll-area>
    </div>
    <div class="col-xs-12 col-sm-7">
      <!-- ESTE ES EL COMPONENTE QUE SE PUEDE APRECIAR AL LADO DERECHO AL MOMENTO DE QUERER EDITAR UN MENSAJE -->
      <ContentEmail :emailId="emailId" :key="cont"/>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import { api } from 'boot/axios'
import ContentEmail from 'src/components/contentemail/ContentEmail.vue'
export default defineComponent({
    name: "InBox",
    components: {
      ContentEmail
    },
    data: () => ({
      cont: 0,
      emailId: null,
      url: 'v1/inbox/',
      rows: [],
      tab: 'prioritarios',
      pagination: {
        sortBy: 'para',
        descending: false,
        page: 1,
        rowsNumber: 0,
        rowsPerPage: 5
      }
    }),
    methods: {
      updateEmail(id) { 
        this.emailId = id
        this.cont++
      },
      async deleteEmail(id) {
        const { data } = await api.delete(`/v1/messages/${id}`)
        console.log(data)
        this.$notify(data.message)
        this.pagination.page = 1
        this.fetchFromServer(true)
      },
      // MÉTODO PARA TENER EL CONTROL DEL SCROLL E INDICAR CUANDO HACER LA PETICIÓN SE UTILZA EN q-scroll-area
      onBottom (info) {
        let scrolling = info.verticalContainerSize + info.verticalPosition
        let bottom = info.verticalSize
        if(scrolling == bottom) {
          this.fetchFromServer(false)
        }
      },
      async fetchFromServer(isDelete) {
        this.$loading('Cargando...')
        const params = {}
        params.pagination = this.pagination
        await api.get(this.url, { params }).then(({ data }) => {
          this.$q.loading.hide()
          if(data.data.data.length > 0) {
            // VALIDACIÓN USADA PARA INDICAR SI LA PETICIÓN ES DESPUÉS DE BORRAR O AL CREARSE EL COMPONENTE
            if (isDelete) {
              this.pagination.page = 0
              this.rows = []
            }
            this.pagination.page++
            this.rows.push(...data.data.data)
          }
          this.pagination.rowsNumber = data.data.total
        })
      }
    }
});
</script>
  
<style></style>