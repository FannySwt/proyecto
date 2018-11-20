<template>
  <v-card
    v-if="servicio.estado == 'activo'"
    class="mx-auto elevation-20"
    color="pink lighten-2"
    dark
  
    height="450px"
  >
    <v-layout justify-space-between >
      <v-flex xs12>
        <v-card-title primary-title >
          <div>
            <div class="h2">{{servicio.nombre_servicio}}</div>
             <v-divider></v-divider>
            <div class="h4">Descripción: {{servicio.descripcion_servicio}}</div>
            <div class="h5 mt-4">Tags: {{servicio.tags_servicio}}</div>
            <div class="h5 mt-2">Precio: {{servicio.precio_servicio}}</div>
            <div class="h5 mt-2">Medios de pago: {{servicio.tipo_pago}}</div>
            <div class="h5 mt-2">Ubicación: {{servicio.ubicacion}}</div>
            <div class="h5 mt-2">Creador del Servicio: {{servicio.creador}}</div>
          </div>
        </v-card-title>
      </v-flex>
      <v-img
        class="shrink ma-2"
        contain
        height="300px"
        src="https://cdn.vuetifyjs.com/images/cards/halcyon.png"
        style="flex-basis: 300px"
      ></v-img>
    </v-layout>
    <v-divider dark></v-divider>
    <v-layout>
      <div class="h5 ml-3">Disponible: {{servicio.fecha_publicacion_se}} - {{servicio.fecha_finalizacion_se}}</div>
      <v-spacer></v-spacer>

<div class="text-xs-center">
    <v-dialog
      v-model="dialog"
      width="500"
    >
      <v-btn 
        @click="actualizarServicio"
        color="info"
        slot="activator"
      >
        Ver
      </v-btn> 
      <v-card
    v-if="servicio.estado == 'activo'"
    class="mx-auto elevation-20"
    color="pink lighten-2"
    dark
  
    height="450px"
  >
    <v-layout justify-space-between >
      <v-flex xs12>
        <v-card-title primary-title >
          <div>
            <div class="h2">{{servicio.nombre_servicio}}</div>
             <v-divider></v-divider>
            <div class="h4">Descripción: {{servicio.descripcion_servicio}}</div>
            <div class="h5 mt-4">Tags: {{servicio.tags_servicio}}</div>
            <div class="h5 mt-2">Precio: {{servicio.precio_servicio}}</div>
            <div class="h5 mt-2">Medios de pago: {{servicio.tipo_pago}}</div>
            <div class="h5 mt-2">Ubicación: {{servicio.ubicacion}}</div>
            <div class="h5 mt-2">Creador del Servicio: {{servicio.creador}}</div>
          </div>
        </v-card-title>
      </v-flex>
      <v-img
        class="shrink ma-2"
        contain
        height="300px"
        src="https://cdn.vuetifyjs.com/images/cards/halcyon.png"
        style="flex-basis: 300px"
      ></v-img>
    </v-layout>
    <v-divider dark></v-divider>
    <v-layout>
      <div class="h5 ml-3">Disponible: {{servicio.fecha_publicacion_se}} - {{servicio.fecha_finalizacion_se}}</div>
      <v-spacer></v-spacer>

      <!--
      <v-btn v-if="!auth" color="info" v-on:click="registro">Contratar</v-btn>-->
    
      <v-btn  color="info" v-if="usuario.tipo_usuario=='secretaria'"  v-on:click="$router.push({name:'secretariaContratar', params: {servicio}})">Contratar</v-btn>
      <v-btn  color="info" v-if="usuario.tipo_usuario=='cliente'"  v-on:click="$router.push({name:'clienteContratar', params: {servicio}})">Contratar</v-btn>
      <v-btn  color="info" v-if="usuario.tipo_usuario=='admin'"  v-on:click="$router.push({name:'adminContratar', params: {servicio}})">Contratar</v-btn>
      <v-btn  v-if="!usuario.tipo_usuario" color="info" v-on:click="registro">Contratar</v-btn>
      
      
    </v-layout>

    <v-card-actions class="h5 ml-1">
      Reputación:
      <span class="grey--text text--lighten-2 caption mr-2">
        ({{ rating }})
      </span>
      <v-rating
        v-model="rating"
        background-color="white"
        color="yellow accent-4"
        dense
        half-increments
        hover
        size="18"
      ></v-rating>
      <div class="layout row reverse fill-height mr-2">
      {{servicio.visitas}}
      <div class="ml-1"></div>
      <v-icon>visibility</v-icon>
      </div>
    </v-card-actions>
  </v-card>
      
    </v-dialog>
  </div>
      <v-btn  color="info" v-if="usuario.tipo_usuario=='secretaria'"  v-on:click="$router.push({name:'secretariaContratar', params: {servicio}})">Contratar</v-btn>
      <v-btn  color="info" v-if="usuario.tipo_usuario=='cliente'"  v-on:click="$router.push({name:'clienteContratar', params: {servicio}})">Contratar</v-btn>
      <v-btn  color="info" v-if="usuario.tipo_usuario=='admin'"  v-on:click="$router.push({name:'adminContratar', params: {servicio}})">Contratar</v-btn>
      <v-btn  v-if="!usuario.tipo_usuario" color="info" v-on:click="registro">Contratar</v-btn>
      
    </v-layout>

    <v-card-actions class="h5 ml-1">
      Reputación:
      <span class="grey--text text--lighten-2 caption mr-2">
        ({{ rating }})
      </span>
      <v-rating
        v-model="rating"
        background-color="white"
        color="yellow accent-4"
        dense
        half-increments
        hover
        readonly
        size="18"
      ></v-rating>
      <div class="layout row reverse fill-height mr-2">
      {{servicio.visitas}}
      <div class="ml-1"></div>
      <v-icon>visibility</v-icon>
      </div>
    </v-card-actions>
  </v-card> 
</template>




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