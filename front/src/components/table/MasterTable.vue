<template>
  <div class="q-gutter-sm">
    <div class="row">
      <div class="col-xs-12 col-sm-12">
        <q-table :title="tableProps.title" :flat="tableProps.flat" :bordered="tableProps.bordered"
          :columns="tableProps.columns" :rows="rows" :filter="filter" v-model:pagination="pagination"
          @request="qTableRequest">
          <template v-slot:header-cell="{ col }">
            <q-th class="centered-aligned-header">
              {{ col.label }}
            </q-th>
          </template>
          <template v-slot:body-cell="{ row, col }">
            <q-td :key="col.name" :class="{
              'center-aligned-cell': col.align === 'center',
              'left-aligned-cell': col.align === 'left',
              'right-aligned-cell': col.align === 'right'
            }" colspan="100%">
              <div v-if="col.name === 'actions'">
                <q-btn-group flat class="q-pm-sm q-mx-sm" v-for="btn in tableProps.buttons" :key="btn.key">
                  <q-btn :flat="btn.flat" :color="btn.color" :loading="btn.loading" :size="btn.size" :icon="btn.icon"
                    @click="$emit(btn.emit, row)" />
                </q-btn-group>
              </div>
              <div v-else>
                {{ row[col.name] }}
              </div>
            </q-td>
          </template>
        </q-table>
      </div>
    </div>
  </div>
</template>

<script>
import { api } from 'boot/axios';

export default {
  name: 'MasterTable',
  props: {
    tableProps: Object,
    reloadTable: Boolean
  },
  data() {
    return {
      rows: [],
      pagination: {
        sortBy: null,
        descending: false,
        page: 1,
        rowsNumber: 0,
        rowsPerPage: 5
      },
      filter: ''
    }
  },
  created() {
    this.fetchFromServer()
  },
  methods: {
    async qTableRequest(props) {
      this.$loading()
      this.filter = props.filter
      this.pagination = props.pagination
      this.pagination.sortBy = this.tableProps.sortBy
      this.pagination.descending = props.pagination.descending ? true : false
      const params = {}
      if (this.filter) {
        params.filter = this.tableProps.filter.map((element) => { return [element, this.filter] })
      }
      params.conditions = this.tableProps.conditions
      params.pagination = this.pagination
      await api.get(this.tableProps.url, { params }).then(({ data }) => {
        this.$q.loading.hide()
        this.rows = data.data.data
        this.pagination.rowsNumber = data.data.total
      })
    },
    async fetchFromServer() {
      this.qTableRequest({
        pagination: this.pagination,
        filter: this.filter
      })
    }
  },
  watch: {
    reloadTable: {
      handler(val, oldVal) {
        this.$emit('reload', false)
        if (val) {
          this.fetchFromServer()
        }
      },
      immediate: true
    }
  }
};
</script>

<style>
thead tr:first-child th {
  /* background-color: #178042; */
  color: white;
}

.align-btn-actions {
  display: flex;
  flex-direction: row;
}

.center-aligned-cell {
  text-align: center;
}

.left-aligned-cell {
  text-align: left;
}

.right-aligned-cell {
  text-align: right;
}

.centered-aligned-header {
  text-align: center;
}
</style>