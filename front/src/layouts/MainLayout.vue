<template>
  <q-layout view="hHh Lpr lff">
    <q-header>
      <q-toolbar>
        <q-img
          src="https://solicitudes.cimalogistic.com/images/cima.png"
          spinner-color="white"
          style="height: 50px; max-width: 50px"
        />
        <div class="q-mx-lg">
        Outlook
        </div>

        <q-input dark dense standout v-model="textSearch" input-class="text-left" placeholder="Buscar"
          class="q-mx-xl" style="width: 30%;"
          @blur="textSearch = textSearch.toUpperCase()">
          <template v-slot:prepend>
            <q-icon v-if="textSearch === ''" name="search" />
            <q-icon v-else name="clear" class="cursor-pointer" @click="clearSearch()" />
          </template>
        </q-input>

        <div class="q-ml-xl">
          <q-btn flat square icon="videocam" label="Llamada de Teams"/>
          <q-btn flat square icon="forum" />
          <q-btn flat square icon="theaters" />
          <q-btn flat square icon="event_available" />
          <q-btn flat square icon="notifications" />
          <q-btn flat square icon="settings" />
          <q-btn flat square icon="lightbulb" />
          
        </div>

      </q-toolbar>
      <q-separator />

      <q-tabs v-model="tab" class="float-left">
        <q-tab name="inicio" label="Inicio" />
        <q-tab name="vista" label="Vista" />
        <q-tab name="ayuda" label="Ayuda" />
      </q-tabs>

      <q-toolbar>
        <q-toolbar v-if="tab == 'inicio'" class="bg-secondary text-white rounded-borders q-ma-sm">
          <q-btn
            flat
            dense
            round
            icon="menu"
            aria-label="Menu"
            @click="toggleLeftDrawer"
          />

          <q-btn-dropdown
            split
            color="accent"
            label="Correo nuevo"
            @click="newEmail"
          >
            <q-list dense>
              <q-item clickable v-close-popup @click="onItemClick" class="q-my-sm">
                <q-item-section avatar>
                  <q-icon name="email" text-color="white" />
                </q-item-section>
                <q-item-section>
                  <q-item-label>Correo</q-item-label>
                </q-item-section>
              </q-item>

              <q-item clickable v-close-popup @click="openWindowEvent" class="q-my-sm">
                <q-item-section avatar>
                  <q-icon name="calendar_today" text-color="white" />
                </q-item-section>
                <q-item-section>
                  <q-item-label>Evento</q-item-label>
                </q-item-section> 
              </q-item>
              <q-item clickable v-close-popup @click="openWindowExcel" class="q-my-sm">
                <q-item-section avatar>
                  <q-icon name="description" text-color="white" />
                </q-item-section>
                <q-item-section>
                  <q-item-label>Evento</q-item-label>
                </q-item-section> 
              </q-item>
            </q-list>
          </q-btn-dropdown>

          <div>Quasar v{{ $q.version }}</div>
        </q-toolbar>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
    >
      <q-list>
        <!-- UTILIZAR LA PROPIEDAD expand-icon en los  nodos de q-expansion-item para colocar un ícono-->
        <q-expansion-item
          label="Favoritos"
          caption=""
          switch-toggle-side
          :content-inset-level="1"
        >
          <q-item clickable v-ripple dense @click="abrirComponente">
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
          <q-item clickable v-ripple dense @click="abrirComponente">
            <q-item-section avatar>
              <q-icon name="inbox" />
            </q-item-section>
            <q-item-section>Bandeja de entrada</q-item-section>
          </q-item>
        </q-expansion-item>
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from 'vue'

export default defineComponent({
  name: 'MainLayout',

  components: {
  },

  setup () {
    const tab = ref('inicio')
    const textSearch = ref('')
    const leftDrawerOpen = ref(false)

    return {
      tab,
      textSearch,
      leftDrawerOpen,
      toggleLeftDrawer () {
        leftDrawerOpen.value = !leftDrawerOpen.value
      }
    }
  },
  methods: {
    abrirComponente () {
      console.log('Hola')
    },
    clearSearch () {
      this.textSearch = ''
    },
    newEmail () {
      console.log('nuevo correo')
    },
    openWindowEvent () {
      window.open('https://outlook.live.com/calendar/0/deeplink/compose')
    },
    openWindowExcel () {
      window.open('onedrive.live.com/edit?id=C71EC090F39326A4!4728&resid=C71EC090F39326A4!4728&ithint=file%2cxlsx&wdo=2&cid=c71ec090f39326a4')
    }
  }
})
</script>
