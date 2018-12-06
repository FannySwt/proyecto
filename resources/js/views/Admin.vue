<template>
  <v-app class="container-fluid">
    <v-parallax :src="require('./../assets/material.jpg')" height="100pv">
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
      <v-footer dark height="auto">
        <v-card width="100%" flat tile class="indigo lighten-1 white--text text-xs-center">
          <v-card-text>
            <!--  <v-btn v-for="icon in icons" :key="icon" class="mx-3 white--text" icon>
          <v-icon size="24px">{{ icon }}</v-icon>
            </v-btn>-->
          </v-card-text>

          <v-card-text
            class="white--text pt-0"
          >*********************************************************************************************** Copyright © 1999-2018 - Venta de Servicios Chile Ltda - Trabaja con nosotros - Términos y condiciones - Políticas de privacidad - Ayuda. ***********************************************************************************************</v-card-text>

          <v-divider></v-divider>
          <v-card-text class="white--text">
            &copy;2018 —
            <strong>Venta de Servicios</strong>
          </v-card-text>
        </v-card>
      </v-footer>
    </v-parallax>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
    drawer: null,
    items: [
      { icon: "person", text: "Mi Perfil", link: "/admin/perfil" },
      { icon: "person_add", text: "Usuarios", link: "/admin/users" },
      { icon: "add", text: "Categorías", link: "/admin/categorias" },
      { icon: "cake", text: "Mis Servicios", link: "/admin/servicios" },
      {
        icon: "credit_card",
        text: "Métodos de Pago",
        link: "/admin/metodosPagos"
      },
      {
        icon: "cake",
        text: "Contratar Servicios",
        link: "/admin/verServicios"
      },
      {
        icon: "visibility",
        text: "Mis Servicios Contratados",
        link: "/admin/serviciosContratados"
      },
      {
        icon: "search",
        text: "Filtrar Servicios",
        link: "/admin/filtrarServicios"
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