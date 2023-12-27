<template>
  <div class="row q-col-gutter-lg">
    <div class="col-xs-12 col-sm-4">
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
      <MasterTable :tableProps="tableProps" @updateRow="updateRow"
      @deleteRow="deleteRow" @reload="reloadTable = false" :reloadTable="reloadTable" />
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import MasterTable from "/src/components/table/MasterTable.vue";
export default defineComponent({
    name: "InBox",
    data: () => ({
        tableProps: {
            flat: true,
            bordered: true,
            title: null,
            rows: [],
            url: 'v1/inbox/',
            sortBy: 'article_name',
            filter: [
                'article_name',
                'branch_name',
                'article_code',
                'branch_code'
            ],
            conditions: [
            ],
            columns: [
                { name: "article_code", align: "center", label: "", field: "article_code", sortable: true }
            ],
            "row-key": "name",
            selection: "single",
            "v-model:selected": null,
            buttons: [{
                key: 1,
                color: "primary",
                icon: "edit",
                flat: 'flat',
                emit: "updateRow",
                size: "10px"
            },
            {
                key: 2,
                color: "green",
                icon: "map",
                flat: 'flat',
                emit: "openGoogleMaps",
                size: "10px",
                loading: false
            },
            {
                key: 3,
                color: "negative",
                icon: "delete",
                flat: 'flat',
                emit: "deleteRow",
                size: "10px",
                loading: false
            }
            ]
        },
        reloadTable: false,
        rows: [],
        selected: null,
        tab: 'prioritarios'
    }),
    components: {
        MasterTable,
    },
    methods: {
        updateRow(val) { this.$router.push(`articles/${val.article_id}`) },
        async deleteRow(val) {
            this.tableProps.buttons[1].loading = true
            const { data } = await api.delete(`articles/${val.article_id}`)
            console.log(data)
            this.$notify(data.message)
            this.tableProps.buttons[1].loading = false
            this.reloadTable = true
        },
        openGoogleMaps (val) {
            window.open('https://www.google.es/maps?q=' + val.latitude + ',' + val.longitude, '_blank')
        },
        uploadFile(val) {
            alert(val.name)
        },
        downloadFile(val) {
            alert(val.email)
        }
    }
});
</script>
  
<style></style>