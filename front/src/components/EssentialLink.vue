<template>
  <div class="q-pa-md q-gutter-sm">
    <q-tree
      node-key="label"
      no-connectors
      default-expand-all
      v-model:expanded="expanded"
    >
    <q-list>
    </q-list>
      <q-item-label header>
        Barbaros
      </q-item-label>
    </q-tree>
  </div>
  <!-- <q-item
    clickable
    tag="a"
    target="_blank"
    :href="link"
  >
    <q-item-section
      v-if="icon"
      avatar
    >
      <q-icon :name="icon" />
    </q-item-section>

    <q-item-section>
      <q-item-label>{{ title }}</q-item-label>
      <q-item-label caption>{{ caption }}</q-item-label>
    </q-item-section>
  </q-item> -->
</template>

<script>
import { defineComponent } from 'vue'
import { ref } from 'vue'

export default {
  setup () {
    return {
      expanded: ref([ 'Favoritos', 'Good food (with icon)' ]),

      simple: [
        {
          label: 'Favoritos',
          children: [
            {
              label: 'Bandeja de entrada',
              icon: 'message',
            }
          ]
        },
        {
          label: 'Carpetas',
          children: [
            {
              label: 'Bandeja de entrada',
              style: {
                cursor: 'handle-pointer',
                // Otros estilos según tus necesidades
              },
            }
          ]
        },
        {
          label: 'Grupos',
          children: [
            {
              label: 'Bandeja de entrada',
              icon: 'message',
            }
          ]
        },
      ]
    }
  },
  methods: {
    customNodeMeta({ node }) {
      // Customize the icon based on your conditions
      if (node.label === 'Bandeja de entrada') {
        return {
          icon: 'hand-pointer' // Replace with the icon you want to use
        }
      }
      return {}
    }
  }
}

/* export default defineComponent({
  name: 'EssentialLink',
  props: {
    title: {
      type: String,
      required: true
    },

    caption: {
      type: String,
      default: ''
    },

    link: {
      type: String,
      default: '#'
    },

    icon: {
      type: String,
      default: ''
    }
  }
}) */
</script>
