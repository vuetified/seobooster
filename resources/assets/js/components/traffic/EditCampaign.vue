<template>
  <v-dialog 
    v-model="dialog" 
    fullscreen 
    transition="dialog-bottom-transition" 
    :overlay="false"
  >
    <v-card>
      <v-toolbar 
        dark 
        color="accent" 
        style="z-index:1000;"
      >
        <v-btn 
          icon
          @click.native="dialog = false" 
          dark
        >
          <v-icon color="primary">close</v-icon>
        </v-btn>
        <v-spacer/>
        <v-toolbar-title>
          <span class="primary--text headline">Edit Traffic Campaign</span>
        </v-toolbar-title>
        <v-spacer/>
        <v-toolbar-items>
          <v-btn 
            dark
            flat 
            @click.native="dialog = false"
            color="primary"
          >
            Close
          </v-btn>
        </v-toolbar-items>
      </v-toolbar>
      <v-tabs 
        fixed 
        icons 
        centered
      >
        <v-toolbar 
          color="white"
          light>
          <v-tabs-bar class="white">
            <v-tabs-slider color="primary"/>
            <v-tabs-item
              v-for="(tab,key) in tabs"
              :key="key"
              :href="`#${tab.name}`"
              ripple
              class="accent--text"
            >
              <v-icon :color="tab.iconColor">{{ tab.icon }}</v-icon>
              <span 
                :class="$vuetify.breakpoint.width >= 600 && 'title'"
              >
                {{ tab.name }}
              </span>
            </v-tabs-item>
          </v-tabs-bar>
        </v-toolbar>
        <v-tabs-items>
          <v-tabs-content
            v-for="(tab, key) in tabs"
            :key="key"
            :id="tab.name"
          >
            <v-card 
              flat 
              :light="true"
            >
              <component 
                :is="tab.component" 
                :tab="tab"
              />
            </v-card>
          </v-tabs-content>
        </v-tabs-items>
      </v-tabs>

    </v-card>
  </v-dialog>
</template>

<script>
import CampaignDetails from '../traffic/CampaignDetails.vue'
import CampaignPerformance from '../traffic/CampaignPerformance.vue'
export default {
    components: {
        CampaignDetails,
        CampaignPerformance
    },
    data: () => ({
        /* tabs */
        tabs: [
            {name: 'edit campaign', component: 'campaign-details', icon: 'fa-edit', iconColor: 'accent'},
            {name: 'campaign stats', component: 'campaign-performance', icon: 'timeline', iconColor: 'primary'}
        ],
        active: {
            name: 'edit campaign'
        },
        dialog: false
    }),
    mounted () {
        let self = this
        Bus.$on('open-edit-campaign-modal', () => {
            self.dialog = true
        })
    }
}
</script>

<style>

</style>
