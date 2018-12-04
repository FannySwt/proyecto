<template>
  <v-container>
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
            v-if="usuario.tipo_usuario=='secretaria' && !estaContratado"
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
            v-if="usuario.tipo_usuario=='cliente' && !estaContratado"
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
            v-if="usuario.tipo_usuario=='admin' && !estaContratado"
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
              <h5
                class="display-5 font-weight-light mb-2"
              >Disponible: {{servicio.fecha_publicacion_se}} - {{servicio.fecha_finalizacion_se}}</h5>
              <br>
              <br>
              <v-spacer></v-spacer>
              <div class="text-xs-center">
                <v-layout>
                  <v-btn v-if="!logueado" @click="registro" color="info">Ver</v-btn>
                  <v-btn v-else @click="actualizarServicio" color="info">Ver</v-btn>
                </v-layout>
              </div>
            </v-layout>
          </div>
        </v-card-text>
        <v-layout>
          <div class="h4 font-weight-light blue--text mb-2">
            <v-flex xs12 justify-start>Ver información del usuario
              <v-btn @click="verPerfil(servicio.user_id)" fab small color="info">
                <v-icon>search</v-icon>
              </v-btn>
            </v-flex>
          </div>
        </v-layout>
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

    <v-dialog v-model="dialog2" width="50%">
      <v-card width="100%">
        <v-toolbar dark color="primary">
          <v-icon>person</v-icon>
          <v-toolbar-title>{{perfil_usuario.nombre_usuario}}</v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
        <v-list three-line subheader>
          <v-subheader></v-subheader>
          <v-list-tile avatar>
            <v-list-tile-content>
              <v-list-tile-title>Datos Personales:</v-list-tile-title>
              <v-list-tile-sub-title>Rut: {{perfil_usuario.rut_usuario}}</v-list-tile-sub-title>
              <v-list-tile-sub-title>Fecha de Nacimiento: {{perfil_usuario.fecha_nac}}</v-list-tile-sub-title>
              <v-list-tile-sub-title>Domicilio: {{perfil_usuario.domicilio_usuario}}</v-list-tile-sub-title>
              <v-list-tile-sub-title>Numero de teléfono: {{perfil_usuario.telefono}}</v-list-tile-sub-title>
            </v-list-tile-content>
          </v-list-tile>
          <br>
          <v-list-tile avatar>
            <v-list-tile-content>
              <v-list-tile-title>Datos Usuario:</v-list-tile-title>
              <v-list-tile-sub-title>Nombre de Usuario: {{perfil_usuario.alias}}</v-list-tile-sub-title>
              <v-list-tile-sub-title>Tipo de Usuario: {{perfil_usuario.tipo_usuario}}</v-list-tile-sub-title>
              <v-list-tile-sub-title>Correo Electrónico: {{perfil_usuario.email}}</v-list-tile-sub-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
        <v-divider></v-divider>
        <v-list three-line subheader>
          <v-subheader>Servicios publicados</v-subheader>
          <v-flex mb-5 ml-5>
            <v-list dense three-line subheader>
              <v-list-tile avatar v-for="item in serviciosUsuario" :key="item.id">
                <v-list-tile-content>
                  <v-list-tile-title>Nombre: {{item.nombre_servicio}}</v-list-tile-title>
                  <v-list-tile-sub-title>Descripción: {{item.descripcion_servicio}}</v-list-tile-sub-title>
                </v-list-tile-content>
              </v-list-tile>
            </v-list>
          </v-flex>

          <v-list-tile avatar>
            <v-list-tile-action></v-list-tile-action>
            <v-list-tile-content></v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-card>
      <v-footer dark height="auto">
        <v-card flat tile class="indigo lighten-1 whitetext text-xs-center">
          <v-card-text>
            <!-- <v-btn v-for="icon in icons" :key="icon" class="mx-3 whitetext" icon>
          <v-icon size="24px">{{ icon }}</v-icon>
            </v-btn>-->
          </v-card-text>

          <v-card-text
            class="whitetext pt-0"
          >******************** Copyright © 1999-2018 - Venta de Servicios Chile Ltda - Trabaja con nosotros - Términos y condiciones - Políticas de privacidad - Ayuda. ********************</v-card-text>

          <v-divider></v-divider>

          <v-card-text class="white--text">
            &copy;2018 —
            <strong>Venta de Servicios</strong>
          </v-card-text>
        </v-card>
      </v-footer>
    </v-dialog>

    <v-dialog v-model="dialog" width="50%">
      <v-card class="mx-auto" color="grey lighten-4" max-width="600">
        <v-img :aspect-ratio="16/9" src="https://cdn.vuetifyjs.com/images/cards/kitchen.png">
          <v-expand-transition>
            <div
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
            v-if="usuario.tipo_usuario=='secretaria' && !estaContratado"
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
            v-if="usuario.tipo_usuario=='cliente' && !estaContratado"
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
            v-if="usuario.tipo_usuario=='admin' && !estaContratado"
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
              <h5
                class="display-5 font-weight-light mb-2"
              >Disponible: {{servicio.fecha_publicacion_se}} - {{servicio.fecha_finalizacion_se}}</h5>
              <br>
              <br>
              <v-spacer></v-spacer>
            </v-layout>
          </div>
        </v-card-text>
        <v-layout>
          <div class="h4 font-weight-light blue--text mb-2">
            <v-flex xs12 justify-start>Ver información del usuario
              <v-btn @click="verPerfil(servicio.user_id)" fab small color="info">
                <v-icon>search</v-icon>
              </v-btn>
            </v-flex>
          </div>
        </v-layout>
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
  </v-container>
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
    this.inicialize();
  },
  data: () => ({
    logueado: false,
    rating: 4.3,
    dialog: false,
    dialog2: false,
    servicios: [],
    usuario: {},
    perfil_usuario: {},
    serviciosUsuario: [],
    serviciosContratados: [],
    headers: []
  }),
  props: {
    servicio: {}
  },
  computed: {
    estaContratado() {
      const servicio = this.serviciosContratados.find(
        item => item.id == this.servicio.id
      );
      if (servicio) return true;
      else false;
    }
  },
  components: {
    Servicios,
    Iterar
  },
  methods: {
    redirect(link) {
      this.$router.push(link);
    },
    inicialize() {
      this.cargarServiciosContratados();
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
          ubicacion: this.servicio.ubicacion,
          denunciado: this.servicios.denunciado
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
          if (this.usuario != "") {
            this.logueado = true;
          } else {
            this.logueado = false;
          }

          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    cargarServiciosContratados() {
      var url = "/serviciosContratados";
      axios
        .get(url)
        .then(response => {
          this.serviciosContratados = response.data;
          console.log(this.serviciosContratados);
        })
        .catch(error => {
          console.log(error);
        });
    },
    verPerfil(id) {
      var url = "/usuarios/" + id;
      axios
        .get(url)
        .then(response => {
          this.perfil_usuario = response.data;
          this.cargarServicios();
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    cargarServicios() {
      var url = "/serviciosCreadosPorUsuario/" + this.perfil_usuario.id;
      axios
        .get(url)
        .then(response => {
          this.serviciosUsuario = response.data;
          this.dialog2 = true;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>