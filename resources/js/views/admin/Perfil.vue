<template>
  <v-layout row>
    <v-card>
      <v-toolbar dark color="primary" full-width>
        <v-toolbar-title></v-toolbar-title>
        <v-spacer></v-spacer>
      </v-toolbar>
      <v-list three-line subheader>
        <v-subheader>User Controls</v-subheader>
        <v-list-tile avatar>
          <v-list-tile-content>
            <v-list-tile-title>Content filtering</v-list-tile-title>
            <v-list-tile-sub-title>Set the content filtering level to restrict apps that can be downloaded</v-list-tile-sub-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile avatar>
          <v-list-tile-content>
            <v-list-tile-title>Password</v-list-tile-title>
            <v-list-tile-sub-title>Require password for purchase or use password to restrict purchase</v-list-tile-sub-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
      <v-divider></v-divider>
      <v-list three-line subheader>
        <v-subheader>General</v-subheader>
        <v-list-tile avatar>
          <v-list-tile-action>
            <v-checkbox v-model="notifications"></v-checkbox>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Notifications</v-list-tile-title>
            <v-list-tile-sub-title>Notify me about updates to apps or games that I downloaded</v-list-tile-sub-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile avatar>
          <v-list-tile-action>
            <v-checkbox v-model="sound"></v-checkbox>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Sound</v-list-tile-title>
            <v-list-tile-sub-title>Auto-update apps at any time. Data charges may apply</v-list-tile-sub-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile avatar>
          <v-list-tile-action>
            <v-checkbox v-model="widgets"></v-checkbox>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Auto-add widgets</v-list-tile-title>
            <v-list-tile-sub-title>Automatically add home screen widgets</v-list-tile-sub-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-card>
    <v-footer dark height="auto">
      <v-card flat tile class="indigo lighten-1 white--text text-xs-center">
        <v-card-text>
          <v-btn v-for="icon in icons" :key="icon" class="mx-3 white--text" icon>
            <v-icon size="24px">{{ icon }}</v-icon>
          </v-btn>
        </v-card-text>

        <v-card-text
          class="white--text pt-0"
        >Phasellus feugiat arcu sapien, et iaculis ipsum elementum sit amet. Mauris cursus commodo interdum. Praesent ut risus eget metus luctus accumsan id ultrices nunc. Sed at orci sed massa consectetur dignissim a sit amet dui. Duis commodo vitae velit et faucibus. Morbi vehicula lacinia malesuada. Nulla placerat augue vel ipsum ultrices, cursus iaculis dui sollicitudin. Vestibulum eu ipsum vel diam elementum tempor vel ut orci. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</v-card-text>

        <v-divider></v-divider>

        <v-card-text class="white--text">
          &copy;2018 —
          <strong>Vuetify</strong>
        </v-card-text>
      </v-card>
    </v-footer>
  </v-layout>
</template>

<script>
export default {
  data: () => ({
    created() {
      this.initialize();
    }
  }),
  methods: {
    initialize() {
      this.cargarUsuarios();
      this.auth();
    },
    cargarUsuarios() {
      var url = "/usuarios";
      axios
        .get(url)
        .then(response => {
          this.usuarios = response.data;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    redirect(link) {
      this.$router.push(link);
    },
    auth() {
      var url = "/auth";
      axios
        .post(url)
        .then(response => {
          this.usuario = response.data;
          console.log("todo bien", response);
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

