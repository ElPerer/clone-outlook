<template>
  <q-list>
    <q-expansion-item
        label="Favoritos"
        caption=""
        switch-toggle-side
        :content-inset-level="1"
    >
        <q-item clickable v-ripple dense @click="this.$router.push('/email')">
        <q-item-section avatar>
            <q-icon name="inbox" />
        </q-item-section>
        <q-item-section>Bandeja de entrada</q-item-section>
        </q-item>
    </q-expansion-item>
    <q-expansion-item
        label="Carpetas"
        caption=""
        switch-toggle-side
        :content-inset-level="1"
    >
        <q-item clickable v-ripple dense @click="this.$router.push('/email')">
        <q-item-section avatar>
            <q-icon name="inbox" />
        </q-item-section>
        <q-item-section>Bandeja de entrada</q-item-section>
        </q-item>
    </q-expansion-item>
  </q-list>
</template>

<script>

export default {
  name: 'DrawenContent',
  
  data() {
    return {
    }
  }
};
</script>

<style>

</style>