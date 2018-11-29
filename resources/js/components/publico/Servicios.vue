<template>
  <v-hover>
    <v-card
      v-if="servicio.estado == 'activo'"
      slot-scope="{ hover }"
      class="mx-auto"
      color="grey lighten-4"
      max-width="600"
    >
      <v-img :aspect-ratio="16/9" src="https://cdn.vuetifyjs.com/images/cards/kitchen.png">
        <v-expand-transition>
          <div
            v-if="hover"
            class="d-flex transition-fast-in-fast-out orange darken-2 v-card--reveal display-3 white--text"
            style="height: 100%;"
          >${{servicio.precio_servicio}}</div>
        </v-expand-transition>
      </v-img>
      <v-card-text class="pt-4" style="position: relative;">
        <v-btn
          absolute
          color="orange"
          class="white--text"
          fab
          large
          right
          top
          v-if="usuario.tipo_usuario=='secretaria'"
          v-on:click="$router.push({name:'secretariaContratar', params: {servicio}})"
        >
          <v-icon>add_shopping_cart</v-icon>
        </v-btn>
        <v-btn
          absolute
          color="orange"
          class="white--text"
          fab
          large
          right
          top
          v-if="usuario.tipo_usuario=='cliente'"
          v-on:click="$router.push({name:'clienteContratar', params: {servicio}})"
        >
          <v-icon>add_shopping_cart</v-icon>
        </v-btn>
        <v-btn
          absolute
          color="orange"
          class="white--text"
          fab
          large
          right
          top
          v-if="usuario.tipo_usuario=='admin'"
          v-on:click="$router.push({name:'adminContratar', params: {servicio}})"
        >
          <v-icon>add_shopping_cart</v-icon>
        </v-btn>
        <v-btn
          v-if="!usuario.tipo_usuario"
          absolute
          color="orange"
          class="white--text"
          fab
          large
          right
          top
          v-on:click="registro"
        >
          <v-icon>add_shopping_cart</v-icon>
        </v-btn>
        <div class="font-weight-light grey--text title mb-2">{{servicio.tags_servicio}}</div>
        <h3 class="display-1 font-weight-light orange--text mb-2">{{servicio.nombre_servicio}}</h3>
        <div class="font-weight-light title mb-2">
          {{servicio.descripcion_servicio}}
          <br>
          <br>
          Medios de Pago: {{servicio.tipo_pago}}
          <br>
          <br>
          Ubicación: {{servicio.ubicacion}}
          <br>
          <v-divider></v-divider>
          <v-layout>
            Disponible: {{servicio.fecha_publicacion_se}} - {{servicio.fecha_finalizacion_se}}
            <br>
            <br>
            <v-spacer></v-spacer>
            <div class="text-xs-center">
              <v-btn @click="actualizarServicio" slot="activador" color="info">Ver</v-btn>
              <v-dialog v-model="dialog" width="500">
                <v-card class="mx-auto" color="grey lighten-4" max-width="600">
                  <v-img
                    :aspect-ratio="16/9"
                    src="https://cdn.vuetifyjs.com/images/cards/kitchen.png"
                  >
                    <v-expand-transition>
                      <div
                        v-if="hover"
                        class="d-flex transition-fast-in-fast-out orange darken-2 v-card--reveal display-3 white--text"
                        style="height: 100%;"
                      >${{servicio.precio_servicio}}</div>
                    </v-expand-transition>
                  </v-img>
                  <v-card-text class="pt-4" style="position: relative;">
                    <v-btn
                      v-if="!auth"
                      absolute
                      color="orange"
                      class="white--text"
                      fab
                      large
                      right
                      top
                      v-on:click="registro"
                    >
                      <v-icon>add_shopping_cart</v-icon>
                    </v-btn>
                    <v-btn
                      absolute
                      color="orange"
                      class="white--text"
                      fab
                      large
                      right
                      top
                      v-if="usuario.tipo_usuario=='secretaria'"
                      v-on:click="$router.push({name:'secretariaContratar', params: {servicio}})"
                    >
                      <v-icon>add_shopping_cart</v-icon>
                    </v-btn>
                    <v-btn
                      absolute
                      color="orange"
                      class="white--text"
                      fab
                      large
                      right
                      top
                      v-if="usuario.tipo_usuario=='cliente'"
                      v-on:click="$router.push({name:'clienteContratar', params: {servicio}})"
                    >
                      <v-icon>add_shopping_cart</v-icon>
                    </v-btn>
                    <v-btn
                      absolute
                      color="orange"
                      class="white--text"
                      fab
                      large
                      right
                      top
                      v-if="usuario.tipo_usuario=='admin'"
                      v-on:click="$router.push({name:'adminContratar', params: {servicio}})"
                    >
                      <v-icon>add_shopping_cart</v-icon>
                    </v-btn>
                    <v-btn
                      absolute
                      color="orange"
                      class="white--text"
                      fab
                      large
                      right
                      top
                      v-if="!usuario.tipo_usuario"
                      v-on:click="registro"
                    ></v-btn>
                    <div class="font-weight-light grey--text title mb-2">{{servicio.tags_servicio}}</div>
                    <h3
                      class="display-1 font-weight-light orange--text mb-2"
                    >{{servicio.nombre_servicio}}</h3>
                    <div class="font-weight-light title mb-2">
                      {{servicio.descripcion_servicio}}
                      <br>
                      <br>
                      Medios de Pago: {{servicio.tipo_pago}}
                      <br>
                      <br>
                      Ubicación: {{servicio.ubicacion}}
                      <br>
                      <v-divider></v-divider>
                      <v-layout>
                        Disponible: {{servicio.fecha_publicacion_se}} - {{servicio.fecha_finalizacion_se}}
                        <br>
                        <br>
                        <v-spacer></v-spacer>
                      </v-layout>
                    </div>
                  </v-card-text>
                  <v-layout class="ml-3" justify-start row fill-height>
                    <v-icon>thumb_up_alt</v-icon>
                    {{servicio.me_gusta}}
                    <v-icon class="ml-5">thumb_down_alt</v-icon>
                    {{servicio.no_me_gusta}}
                  </v-layout>
                  <div class="layout row reverse fill-height mr-2">
                    {{servicio.visitas}}
                    <div class="ml-1"></div>
                    <v-icon>visibility</v-icon>
                  </div>
                </v-card>
              </v-dialog>
            </div>
          </v-layout>
        </div>
      </v-card-text>
      <v-layout class="ml-3" justify-start row fill-height>
        <v-icon>thumb_up_alt</v-icon>
        {{servicio.me_gusta}}
        <v-icon class="ml-5">thumb_down_alt</v-icon>
        {{servicio.no_me_gusta}}
      </v-layout>
      <div class="layout row reverse fill-height mr-2">
        {{servicio.visitas}}
        <div class="ml-1"></div>
        <v-icon>visibility</v-icon>
      </div>
    </v-card>
  </v-hover>
</template>
<style>
.v-card--reveal {
  align-items: center;
  bottom: 0;
  justify-content: center;
  opacity: 0.5;
  position: absolute;
  width: 100%;
}
</style>


<script>
import Iterar from "./../../components/publico/Iterar";
import Servicios from "./../../components/publico/Servicios";
export default {
  created() {
    this.auth();
  },
  data: () => ({
    rating: 4.3,
    dialog: false,
    servicios: [],
    usuario: {}
  }),
  props: {
    servicio: {}
  },
  components: {
    Servicios,
    Iterar
  },
  methods: {
    redirect(link) {
      this.$router.push(link);
    },
    registro: function(event) {
      alert("Primero debes Iniciar Sesión");
    },
    actualizarServicio() {
      var url = "/servicios/" + this.servicio.id;
      axios
        .put(url, {
          nombre_servicio: this.servicio.nombre_servicio,
          descripcion_servicio: this.servicio.descripcion_servicio,
          estado: this.servicio.estado,
          fecha_publicacion_se: this.servicio.fecha_publicacion_se,
          fecha_finalizacion_se: this.servicio.fecha_finalizacion_se,
          tags_servicio: this.servicio.tags_servicio,
          visitas: this.servicio.visitas + 1,
          creador: this.servicio.creador,
          tipo_pago: this.servicio.tipo_pago,
          precio_servicio: this.servicio.precio_servicio,
          reputacion: this.servicio.reputacion,
          ubicacion: this.servicio.ubicacion
        })
        .then(response => {
          this.servicio.visitas++;
          this.$emit("recargar");
          this.dialog = true;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    auth() {
      var url = "/auth";
      axios
        .post(url)
        .then(response => {
          this.usuario = response.data;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  bool_auth() {
    var url = "/auth";
    axios
      .post(url)
      .then(response => {
        if (response.data != null) {
          return true;
        }
        return false;
        console.log(response);
      })
      .catch(error => {
        console.log(error);
      });
  }
};
</script>