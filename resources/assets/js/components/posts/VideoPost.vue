<template>
  <v-card flat>
    <v-card-text>
      <v-container>
        <v-layout row>
          <v-flex 
            xs12
            md8 
            offset-md2
          >
            <v-text-field
              v-model="name"
              name="name"
              label="Campaign Name"
              single-line
              prepend-icon="fa-fa"
            />
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex 
            xs12 
            md8 
            offset-md2
          >
            <v-text-field
              v-model="title"
              name="title"
              label="Video Title"
              prepend-icon="fa-book"
              single-line
            />
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex
            xs12
            md8 
            offset-md2
          >
            <v-text-field
              name="social_decription"
              label="Video Description"
              prepend-icon="pageview"
              disabled
              single-line
            />
            <v-text-field
              name="decription"
              v-model="description"
              textarea
            />
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex 
            xs12
            md8 
            offset-md2
          >
            <v-checkbox
              color="green"
              v-model="spin"
            >
              <div slot="label" @click.stop="">
                Do you Want To Spin  <v-icon color="info">autorenew</v-icon> Text?
              </div>
            </v-checkbox>
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex 
            xs12 
            md8 
            offset-md2
          >
            <v-dialog
              persistent
              v-model="modal"
              lazy
              full-width
              width="290px"
            >
              <v-text-field
                slot="activator"
                label="Schedule Social Post"
                v-model="scheduled_at"
                prepend-icon="event"
                readonly
              />
              <v-date-picker 
                v-model="scheduled_at" 
                scrollable 
                actions
              >
                <template slot-scope="{ save, cancel }">
                  <v-card-actions>
                    <v-spacer/>
                    <v-btn 
                      flat 
                      color="primary" 
                      @click="cancel"
                    >
                      Cancel
                    </v-btn>
                    <v-btn 
                      flat 
                      color="primary" 
                      @click="save"
                    >
                      OK
                    </v-btn>
                  </v-card-actions>
                </template>
              </v-date-picker>
            </v-dialog>
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex 
            xs12
            md8 
            offset-md2
          >
            <v-text-field
              v-model="name"
              name="filename"
              label="Video"
              prepend-icon="video"
              single-line
              :append-icon="!!fileName ? 'fa-remove' : ''"
              :append-icon-cb="() => (removeVideo())"
            />

          </v-flex>
          <v-flex xs2>
            <upload-button 
              :title="file_title" 
              :selected-callback="fileSelectedFunc"
            />
          </v-flex>
        </v-layout>
        <v-layout row>
          <v-flex 
            xs12
            md8 
            offset-md2
          >
            <!-- image preview -->
            <v-card-media
              v-if="file"
              :src="fileUrl"
              height="250px"
              contain
            />
          </v-flex>
        </v-layout>
        <v-layout 
          row
          wrap
        >
          <v-flex 
            xs12 
            md8 
            offset-md2
          >
            <v-btn 
              block 
              color="accent" 
              class="white--text"
            >
              Create New Post 
              <v-icon right>send</v-icon>
            </v-btn>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card-text>
  </v-card>
</template>

<script>
import TextEditor from '../../components/TextEditor.vue'
import UploadButton from '../../components/UploadButton.vue'

export default {
    components: {
        TextEditor,
        UploadButton
    },
    props:{
        tab: {
            type: Object,
            required: true
        }
    },
    data: () => ({
        name: '',
        title: '',
        description: '',
        spin: false,
        scheduled_at: null,
        /* modal for scheduled at */
        modal: false,
        /* video related use spatie media library */
        file: null,
        fileUrl: '',
        fileName: ''
    }),
    computed: {
        'file_title' () {
            if (!this.fileName) {
                return 'Upload Video'
            } else {
                return 'Remove Video'
            }
        }
    },
    methods: {
        //! prop function of upload button
        fileSelectedFunc (file) {
            let self = this
            this.fileName = file.name
            this.file = file
            let reader = new FileReader()

            reader.onload = function (event) {
                self.fileUrl = event.target.result
            }
            reader.readAsDataURL(file)
        },
        removeVideo () {
            this.file = null
            this.fileName = ''
            this.fileUrl = ''
        }
    }
}
</script>

<style>

</style>
