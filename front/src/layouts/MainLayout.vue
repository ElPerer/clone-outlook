<template>
  <q-layout view="hHh Lpr lff">
    <q-header>
      <q-toolbar>
        <!-- PRIMER HEADER SE MANDAN POR PROPS AL COMPONENTE LOS PIXELES PARA EL TEMA RESPONSIVO -->
        <FirstHeader :screenSize="screenSize" :key="screenSize"  />
      </q-toolbar>
      <q-separator />

      <!-- SECOND HEADER SON LOS TABS -->
      <q-tabs v-model="tab" :class="(screenSize > 700 || screenSize == null) ? 'float-left' : ''">
        <q-tab name="inicio" label="Inicio" />
        <q-tab name="vista" label="Vista" />
        <q-tab name="ayuda" label="Ayuda" />
      </q-tabs>

      <q-toolbar>
        <q-toolbar v-if="tab == 'inicio'" class="bg-secondary text-white rounded-borders q-my-sm">
          <!-- BOTON MENÚ -->  
          <q-btn
              flat
              dense
              round
              icon="menu"
              aria-label="Menu"
              @click="toggleLeftDrawer"
          />
          <!-- TERCER HEADER SE MANDAN POR PROPS AL COMPONENTE LOS PIXELES PARA EL TEMA RESPONSIVO -->
          <ThirdHeader :tab="tab" :screenSize="screenSize" :key="screenSize" />
        </q-toolbar>
      </q-toolbar>
    </q-header>

    <!-- DRAWER Y SU CONTENIDO EN UN COMPONENTE LLAMADO DrawerContent -->
    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
    >
      <DrawenContent />
    </q-drawer>
    
    
    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
// IMPORTACIÓN DE LOS COMPONENTES NECESARIOS
import { defineComponent, ref } from 'vue'
import FirstHeader from 'src/components/headers/FirstHeader.vue'
import ThirdHeader from 'src/components/headers/ThirdHeader.vue'
import DrawenContent from 'src/components/headers/drawercontent/DrawerContent.vue'
//import InBox from 'src/components/InBox.vue'

export default defineComponent({
  name: 'MainLayout',

  // USO DE LOS COMPONENTES NECESARIOS
  components: {
    FirstHeader,
    ThirdHeader,
    DrawenContent,
  },
  mounted () {
    window.onresize = () => {
      return (() => {
        window.screenWidth = document.body.clientWidth
        this.screenWidth = window.screenWidth
      })()
    }
  },
  setup () {
    const tab = ref('inicio')
    const screenWidth = ref(null)
    const screenSize = ref(null)
    const textSearch = ref('')
    const leftDrawerOpen = ref(false)

    return {
      tab,
      textSearch,
      screenWidth,
      screenSize,
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
  },
  // TIENE EL VALOR EN PIXELES DE LA PANTALLA UTILIZADO PRINCIPALMENTE PARA EL PRIMER Y TERCER HEADER
  watch: {
    screenWidth (val) {
      console.log(val)
      this.screenSize = val
    }
  }
})
</script>
