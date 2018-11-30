<template>
  <v-app id="inspire">
    <v-parallax src="https://cdn.vuetifyjs.com/images/parallax/material.jpg" height="100vh">
      <v-navigation-drawer :clipped="$vuetify.breakpoint.lgAndUp" v-model="drawer" fixed app>
        <v-list dense>
          <template v-for="item in items">
            <v-layout v-if="item.heading" :key="item.heading" row align-center>
              <v-flex xs6>
                <v-subheader v-if="item.heading">{{ item.heading }}</v-subheader>
              </v-flex>
              <v-flex xs6 class="text-xs-center">
                <a href="#!" class="body-2 black--text">EDIT</a>
              </v-flex>
            </v-layout>
            <v-list-group
              v-else-if="item.children"
              v-model="item.model"
              :key="item.text"
              :prepend-icon="item.icon"
              :append-icon="'keyboard_arrow_up'"
            >
              <v-list-tile slot="activator">
                <v-list-tile-content>
                  <v-list-tile-title>{{ item.text }}</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
              <v-list-tile
                v-for="(child, i) in item.children"
                :key="i"
                @click="child.link? redirect(child.link) : redirect('/home')"
              >
                <v-list-tile-action v-if="child.icon">
                  <v-icon>{{ child.icon }}</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                  <v-list-tile-title>{{ child.text }}</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
            </v-list-group>
            <v-list-tile
              v-else
              :key="item.text"
              @click="item.link? redirect(item.link) : redirect('/home')"
            >
              <v-list-tile-action>
                <v-icon>{{ item.icon }}</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>{{ item.text }}</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </template>
        </v-list>
      </v-navigation-drawer>
      <v-toolbar :clipped-left="$vuetify.breakpoint.lgAndUp" color="blue darken-3" dark app fixed>
        <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
          <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
          <span class="hidden-sm-and-down">Venta de Servicios</span>
        </v-toolbar-title>
        <v-text-field
          flat
          solo-inverted
          hide-details
          prepend-inner-icon="search"
          label="Search"
          class="hidden-sm-and-down"
        ></v-text-field>
        <v-spacer></v-spacer>
        <v-btn icon>
          <v-icon>apps</v-icon>
        </v-btn>
        <v-btn icon>
          <v-icon>notifications</v-icon>
        </v-btn>
        <v-btn icon large @click="$emit('logout')">
          <v-avatar size="32px" tile>
            <v-icon>person</v-icon>
          </v-avatar>
        </v-btn>Cerrar Sesión
      </v-toolbar>
      <v-content>
        <v-container fluid fill-height>
          <v-layout justify-center align-center>
            <router-view></router-view>
          </v-layout>
        </v-container>
      </v-content>
    </v-parallax>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
    drawer: null,
    items: [
      { icon: "person", text: "Mi Perfil", link: "/secretaria/perfil" },
      { icon: "visibility", text: "Ver Usuarios", link: "/secretaria/users" },
      {
        icon: "visibility",
        text: "Validar Servicios",
        link: "/secretaria/validar"
      },
      {
        icon: "visibility",
        text: "Ver Servicios",
        link: "/secretaria/servicios"
      },
      {
        icon: "visibility",
        text: "Mis Servicios Contratados",
        link: "/secretaria/serviciosContratados"
      },
      {
        icon: "visibility",
        text: "Servicios Denunciados",
        link: "/secretaria/serviciosDenunciados"
      }
    ]
  }),
  props: {
    source: String
  },
  methods: {
    redirect(link) {
      this.$router.push(link);
    }
  }
};
</script>