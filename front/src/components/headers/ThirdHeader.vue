<template>
    <q-btn-dropdown
        split
        color="accent"
        icon="email"
        label="Correo nuevo"
        @click="newEmail"
    >
        <q-list dense>
            <q-item clickable v-close-popup @click="newEmail" class="q-my-sm">
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
                    <q-item-label>Documento</q-item-label>
                </q-item-section> 
            </q-item>
        </q-list>
    </q-btn-dropdown>
    <div v-if="screen_size === 'pc'">
        <q-btn-dropdown
            split
            class="q-mx-md"
            color="secondary"
            icon="delete"
            label="Eliminar"
            @click="dropEmail"
        >
            <q-list dense>
                <q-item clickable v-close-popup @click="dropEmail" class="q-my-sm">
                    <q-item-section avatar>
                        <q-icon name="delete" text-color="white" />
                    </q-item-section>
                    <q-item-section>
                        <q-item-label>Eliminar</q-item-label>
                    </q-item-section>
                </q-item>
            </q-list>
        </q-btn-dropdown>

        <q-btn square text-color="green" icon="inventory_2" label="Archivar" />

        <q-btn-dropdown
            split
            class="q-mx-md"
            color="secondary"
            text-color="red"
            icon="privacy_tip"
            label="Informar"
        >
            <q-list dense>
                <q-item clickable v-close-popup class="q-my-sm">
                    <q-item-section avatar>
                        <q-icon name="privacy_tip" text-color="white" />
                    </q-item-section>
                    <q-item-section>
                        <q-item-label>Informar sobre suplantación de indentidad (phishing)</q-item-label>
                    </q-item-section>
                </q-item>
                <q-item clickable v-close-popup class="q-my-sm">
                    <q-item-section avatar>
                        <q-icon name="report" text-color="white" />
                    </q-item-section>
                    <q-item-section>
                        <q-item-label>Informar sobre correo no deseado</q-item-label>
                    </q-item-section>
                </q-item>
            </q-list>
        </q-btn-dropdown>

        <q-btn square icon="cleaning_services" label="Limpiar" />
    </div>
    <div v-else>
        <q-btn-dropdown
            split
            class="q-mx-md"
            color="accent"
            label="..."
        >
            <q-list dense>
                <q-item clickable v-close-popup @click="dropEmail" class="q-my-sm">
                    <q-item-section avatar>
                        <q-icon name="delete" text-color="white" />
                    </q-item-section>
                    <q-item-section>
                        <q-item-label>Eliminar</q-item-label>
                    </q-item-section>
                </q-item>
                <q-item clickable v-close-popup class="q-my-sm">
                    <q-item-section avatar>
                        <q-icon name="inventory_2" color="green" />
                    </q-item-section>
                    <q-item-section>
                        <q-item-label>Archivar</q-item-label>
                    </q-item-section>
                </q-item>
                <q-item clickable v-close-popup class="q-my-sm">
                    <q-item-section avatar>
                        <q-icon name="privacy_tip" color="red" />
                    </q-item-section>
                    <q-item-section>
                        <q-item-label>Informar</q-item-label>
                    </q-item-section>
                </q-item>
            </q-list>
        </q-btn-dropdown>
    </div>
</template>

<script>
export default {
  name: 'ThirdHeader',
  props: {
    tab: String,
    screenSize: Number 
  },
  mounted () {
    this.screen_size = (this.screenSize > 950 || this.screenSize == null) ? 'pc' : 'smartphone'
  },
  data() {
    return {
        screenWidth: null,
        screen_size: 'pc'
    }
  },
  methods: {
    newEmail () {
        this.$router.push('/email/new')
    },
    openWindowEvent () {},
    openWindowExcel () {},
    dropEmail () {},

  }
};
</script>

<style>

</style>