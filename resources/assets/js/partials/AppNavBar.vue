<template>
  <v-toolbar 
    color="accent" 
    fixed 
    app
  >
    <v-toolbar-side-icon 
      :style="toggleBarStyle"
      @click.native.stop="toggleDrawer()"
    />
    <!-- Title -->
    <v-toolbar-title 
      v-if="extension" 
      class="text-xs-center ml-0 pl-3" 
      :class="$vuetify.breakpoint.width <= 1264 && 'pr-3'" 
      slot="extension" 
      :style="$vuetify.breakpoint.width > 1264 && 'width: 300px'"
    >
      <v-icon 
        :style="{color: iconColor }" 
        class="ml-3 hidden-md-and-down" 
        v-if="showIcon"
      >
        {{ icon }}
      </v-icon>
      <span 
        class="hidden-md-and-down" 
        :style="titleStyle"
      >
        {{ title }}
      </span>
    </v-toolbar-title>
    <v-toolbar-title 
      v-else 
      class="text-xs-center"
    >
      <v-icon 
        :style="{color: iconColor }" 
        class="ml-3 hidden-md-and-down" 
        v-if="showIcon"
      >
        {{ icon }}
      </v-icon>
      <span 
        class="hidden-md-and-down" 
        :style="titleStyle"
      >
        {{ title }}
      </span>
    </v-toolbar-title>
    <v-spacer/>
    <!-- center logo -->
    <img 
      v-if="showLogo" 
      class="hidden-md-and-up" 
      :src="logo" 
      :style="[logoStyle]"
      alt="App.site.title"
    >
    <v-spacer/>
  </v-toolbar>
</template>

<script>
import Theme from '../mixins/theme'

export default {
    mixins: [Theme],
    data: () => ({
        extension: false
    }),
    created () {
        /* Emit On a Child Component If You Want This To Be Visible */
        Bus.$on('header-extension-visible', (visibility) => {
            this.extension = visibility
        })
    },
    methods: {
        toggleDrawer () {
            Bus.$emit('toggleDrawer')
        }
    }
}
</script>

<style>

</style>
