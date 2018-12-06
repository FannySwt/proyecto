<template>
  <v-app class="container fluid">
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
          <span class="hidden-sm-and-down"></span>
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
        <v-btn icon large v-on:click="$router.push({name:'homeUsers'})">
          <v-icon>add_circle</v-icon>
        </v-btn>Crea tu cuenta
        <v-btn icon large v-on:click="$router.push({name:'login'})">
          <v-avatar size="32px" tile>
            <v-icon>person</v-icon>
          </v-avatar>
        </v-btn>Ingresa
        <v-btn icon large v-on:click="$router.push({name:'homeAyuda'})">
          <v-avatar size="32px" tile>
            <v-icon>person</v-icon>
          </v-avatar>
        </v-btn>Ayuda
      </v-toolbar>
      <v-content>
        <v-container fluid fill-height>
          <v-layout justify-center align-center>
            <router-view></router-view>
            <v-layout justify-center align-center>
              <v-layout align-center justify-center>
                <v-flex xs12>
                  <v-form
                    ref="form"
                    v-model="input.valid"
                    lazy-validation
                    v-on:submit.prevent="submit"
                  >
                    <v-card class="elevation-12">
                      <v-toolbar dark color="primary">
                        <v-toolbar-title>Iniciar sesion</v-toolbar-title>
                        <v-spacer></v-spacer>
                      </v-toolbar>
                      <v-card-text>
                        <v-text-field
                          prepend-icon="person"
                          name="login"
                          label="Login"
                          type="text"
                          v-model="input.login"
                          :rules="input.loginRules"
                          required
                        ></v-text-field>
                        <v-text-field
                          id="password"
                          prepend-icon="lock"
                          name="password"
                          label="Password"
                          type="password"
                          v-model="input.password"
                          :rules="input.passwordRules"
                          required
                        ></v-text-field>
                      </v-card-text>
                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" :disabled="!input.valid" type="submit">Login</v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-form>
                </v-flex>
              </v-layout>
            </v-layout>
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
          >******************************************************************************* Copyright © 1999-2018 - Venta de Servicios Chile Ltda - Trabaja con nosotros - Términos y condiciones - Políticas de privacidad - Ayuda. **********************************************************************************</v-card-text>

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
    drawer: null,
    dialog: false,
    items: [
      { icon: "cake", text: "Servicios", link: "/home/servicios" },
      { icon: "art_track", text: "Sobre Nosotros", link: "/home/about" }
    ],
    input: {
      valid: true,
      password: "",
      passwordRules: [
        v => !!v || "El password es requerido",
        v =>
          (v && v.length >= 4) ||
          "El password nececita por lo menos 4 caracteres"
      ],
      login: "",
      loginRules: [v => !!v || "El usuario es requerido"]
    }
  }),
  props: {
    source: String
  },
  methods: {
    submit() {
      if (this.$refs.form.validate()) {
        var url = "/login";
        axios
          .post(url, {
            email: this.input.login,
            password: this.input.password
          })
          .then(response => {
            console.log(response);
            this.$emit("authenticated");
          })
          .catch(error => {
            this.$emit("logout");
            console.log(error);
          });
      }
    },
    redirect(link) {
      this.$router.push(link);
    }
  }
};
</script>
