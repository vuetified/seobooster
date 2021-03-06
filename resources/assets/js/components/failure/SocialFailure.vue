<template>
  <v-card>
    <v-card-title>
      <v-text-field
        v-if="items.length > 0"
        append-icon="search"
        label="Search By Post Title"
        single-line
        hide-details
        v-model="search"
      />
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="items"
      :search="search"
      v-model="selected"
      item-key="id"
      select-all
      :pagination.sync="pagination"
      expand
    >
      <template 
        slot="headers" 
        slot-scope="props"
      >
        <tr>
          <th>
            <v-checkbox
              v-if="items.length > 0"
              primary
              hide-details
              @click.native="toggleAll"
              :input-value="props.all"
              :indeterminate="props.indeterminate"
            />
          </th>
          <th 
            v-for="header in props.headers" 
            :key="header.text"
            :class="['column sortable', pagination.descending ? 'desc' : 'asc', header.value === pagination.sortBy ? 'active' : '',$vuetify.breakpoint.width >= 600 && 'title']"
            @click="changeSort(header.value)"
          >
            <v-icon>arrow_upward</v-icon>
            {{ header.text }}
          </th>
          <th>
            <span 
              v-if="selected < 1"
              :class="$vuetify.breakpoint.width >= 600 && 'title'"
            >
              Actions
            </span>
            <v-btn 
              v-else 
              flat 
              icon 
              color="error" 
              @click.native="deleteSelected"
            >
              <v-icon>fa-trash</v-icon>
            </v-btn>
          </th>
        </tr>
      </template>
      <template 
        slot="items" 
        slot-scope="props"
      >
        <td>
          <v-checkbox
            primary
            hide-details
            v-model="props.selected"
          />
        </td>
        <td class="text-xs-center">
          <span class="accent--text">{{ props.item.title }}</span>
        </td>
        <td class="text-xs-center">
          <span class="accent--text">{{ props.item.status }}</span>
        </td>
        <td class="text-xs-center">
          <v-icon :color="props.item.iconColor">{{ props.item.icon }}</v-icon>
          <span class="accent--text">{{ props.item.platform }}</span>
        </td>
        <td class="text-xs-center">
          <span class="accent--text">{{ props.item.published_at }}</span>
        </td>
        <td class="text-xs-center">
          <v-btn 
            flat 
            icon 
            color="error" 
            @click.native="deleteItem(props.item)"
          >
            <v-icon>fa-remove</v-icon>
          </v-btn>
        </td>
      </template>
      <template slot="no-data">
        <v-alert 
          :value="true" 
          type="error"
          outline
          icon="warning"
        >
          You Have No Failured Scheduled Post Yet On Social Type Post...
        </v-alert>
      </template>

      <template 
        slot="pageText" 
        slot-scope="{ pageStart, pageStop }"
      >
        From {{ pageStart }} to {{ pageStop }}
      </template>

    </v-data-table>
  </v-card>
</template>

<script>
//! Fetch Blog posts From Database
export default {
    props:{
        tab: {
            type: Object,
            required: true
        }
    },
    data: () => ({
        pagination: {
            sortBy: 'name'
        },
        selected: [],
        search: '',
        /* table */
        headers: [
            /* remove sort and value since we cant access dot anotation in item */
            { text: 'Social Post Title', value: 'title', align: 'center', sortable: true },
            { text: 'Network', value: 'status', align: 'center', sortable: false },
            { text: 'Platform', value: 'platform', align: 'center', sortable: false },
            { text: 'Posted At', value: 'published_at', align: 'center', sortable: false }
        ],
        items: [
            {
                //! Post
                id: 1,
                title: 'Test1',
                status: 'Failed',
                platform: 'wordpress',
                icon: 'fa-wordpress',
                published_at: '16 Nov 2017 @ 10:15:01',
                iconColor: 'indigo'
            },
            {
                //! Post
                id: 2,
                title: 'Test2',
                status: 'Failed',
                platform: 'facebook',
                icon: 'fa-facebook',
                published_at: '16 Nov 2017 @ 10:15:01',
                iconColor: 'indigo'
            }
        ]
    }),
    methods: {
        changeSort (column) {
            if (this.pagination.sortBy === column) {
                this.pagination.descending = !this.pagination.descending
            } else {
                this.pagination.sortBy = column
                this.pagination.descending = false
            }
        },
        toggleAll () {
            if (this.selected.length) this.selected = []
            else this.selected = this.items.slice()
        },
        deleteSelected () {
            let self = this
            let newItems = _.difference(self.items, self.selected)
            self.items = newItems
            self.selected = []
            //! Send Api Call To Delete The Social Account
        },
        deleteItem (item) {
            let self = this
            let itemIndex = _.findIndex(self.items, ['id', item.id])
            self.items.splice(itemIndex, 1)
            let selectedIndex = _.findIndex(self.selected, ['id', item.id])
            self.selected.splice(selectedIndex, 1)
        }
    }
}
</script>

<style>

</style>
