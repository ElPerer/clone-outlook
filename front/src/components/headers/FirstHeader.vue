<template>
    <q-img
        src="https://solicitudes.cimalogistic.com/images/cima.png"
        spinner-color="white"
        style="height: 50px; max-width: 50px"
    />
    <div class="q-mx-lg">
    Outlook
    </div>
    <!-- screenSize PROPIEDAD RECIBIDA POR PROP UTILIZADA PARA LLEVAR EL CONTROL SOBRE 
          SI ES VISTA SMARTHPHONE O PC -->
    <q-input dark dense standout v-model="textSearch" input-class="text-left" placeholder="Buscar"
        :class="(screenSize > 600) ? 'q-mx-xl' : ''" style="width: 30%;">
        <template v-slot:prepend>
        <q-icon v-if="textSearch === ''" name="search" />
        <q-icon v-else name="clear" class="cursor-pointer" @click="clearSearch()" />
        </template>
    </q-input>

    <q-toolbar-title>
    </q-toolbar-title>
    <!-- screen_size PROPIEDAD LOCAL UTILIZADA PARA LLEVAR EL CONTROL SOBRE 
          SI ES VISTA SMARTHPHONE O PC -->
    <div v-if="screen_size === 'pc'" :class="(screenSize > 600) ? 'q-ml-xl' : ''">
        <q-btn flat square icon="videocam" label="Llamada de Teams" @click="openTeams" />
        <q-btn flat square icon="forum" @click="openSkype" />
        <q-btn flat square icon="theaters" />
        <q-btn flat square icon="event_available" />
        <q-btn flat square icon="notifications" />
        <q-btn flat square icon="settings" />
        <q-btn flat square icon="lightbulb" />
    </div>
    <!-- VISTA SMARTPHONE -->
    <div v-else>
      <q-btn-dropdown
            split
            class="q-mx-md"
            color="accent"
            label="..."
        >
          <q-list dense>
              <q-item clickable v-close-popup @click="openTeams" class="q-my-sm">
                <q-item-section avatar>
                    <q-icon name="videocam" text-color="white" />
                </q-item-section>
                <q-item-section>
                    <q-item-label>Llamada de teams</q-item-label>
                </q-item-section>
              </q-item>
              <q-item clickable v-close-popup @click="openSkype" class="q-my-sm">
                <q-item-section avatar>
                    <q-icon name="forum" text-color="white" />
                </q-item-section>
                <q-item-section>
                    <q-item-label>Skype</q-item-label>
                </q-item-section>
              </q-item>
              <q-item clickable v-close-popup class="q-my-sm">
                <q-item-section avatar>
                    <q-icon name="theaters" text-color="white" />
                </q-item-section>
                <q-item-section>
                    <q-item-label>One note</q-item-label>
                </q-item-section>
              </q-item>
              <q-item clickable v-close-popup class="q-my-sm">
                <q-item-section avatar>
                    <q-icon name="event_available" text-color="white" />
                </q-item-section>
                <q-item-section>
                    <q-item-label>Eventos</q-item-label>
                </q-item-section>
              </q-item>
              <q-item clickable v-close-popup class="q-my-sm">
                <q-item-section avatar>
                    <q-icon name="notifications" text-color="white" />
                </q-item-section>
                <q-item-section>
                    <q-item-label>Notificaciones</q-item-label>
                </q-item-section>
              </q-item>
              <q-item clickable v-close-popup class="q-my-sm">
                <q-item-section avatar>
                    <q-icon name="settings" text-color="white" />
                </q-item-section>
                <q-item-section>
                    <q-item-label>Configuración</q-item-label>
                </q-item-section>
              </q-item>
              <q-item clickable v-close-popup class="q-my-sm">
                <q-item-section avatar>
                    <q-icon name="lightbulb" text-color="white" />
                </q-item-section>
                <q-item-section>
                    <q-item-label>Sugerencias</q-item-label>
                </q-item-section>
              </q-item>
          </q-list>
      </q-btn-dropdown>
    </div>
</template>

<script>

export default {
  name: 'FirstHeader',
  // SE RECIBE LA CANTIDAD DE PIXELES
  props: {
    screenSize: Number 
  },
  mounted () {
    // SE PROCESA LA CANTIDAD DE PIXELES Y SE DEFINE QUE TIPO DE PANTALLA QUE SERÁ PC O SMARTPHONE
    this.screen_size = (this.screenSize > 1244 || this.screenSize == null) ? 'pc' : 'smartphone'
  },
  data() {
    return {
      screenWidth: null,
      screen_size: 'pc',
      textSearch: ''
    }
  },
  methods: {
    // MÉTODOS PARA ABRIR LINKS PROPORCIONADOS POR OUTLOOK
    openTeams () {
      window.open('https://join.skype.com/meetnow?source=outlook.web&exp=SuiteHeader&correlationId=5227d8e1-c93c-fca6-ccad-5376899d0ae3')
    },
    openSkype () {
      window.open('https://web.skype.com')
    }
  }
};
</script>

<style>

</style>