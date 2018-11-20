<template>
  <v-card
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
      <v-btn 
      v-if="servicio.estado=='activo'" @click="actualizarServicio" color="success">Activo</v-btn>
      <v-btn 
      v-if="servicio.estado=='inactivo'" @click="actualizarServicio" color="error">Inactivo</v-btn>
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
</template>

<script>
export default {
  data: () => ({
    rating: 4.3
  }),
  props: {
    servicio: {}
  },
  methods: {
    actualizarServicio() {
      var url = "/servicios/" + this.servicio.id;
      var est;
      if (this.servicio.estado == "activo") {
        est = "inactivo";
      } else {
        est = "activo";
      }
      axios
        .put(url, {
          nombre_servicio: this.servicio.nombre_servicio,
          descripcion_servicio: this.servicio.descripcion_servicio,
          estado: est,
          fecha_publicacion_se: this.servicio.fecha_publicacion_se,
          fecha_finalizacion_se: this.servicio.fecha_finalizacion_se,
          tags_servicio: this.servicio.tags_servicio,
          visitas: this.servicio.visitas,
          creador: this.servicio.creador,
          tipo_pago: this.servicio.tipo_pago,
          precio_servicio: this.servicio.precio_servicio,
          reputacion: this.servicio.reputacion,
          ubicacion: this.servicio.ubicacion
        })
        .then(response => {
          if (this.servicio.estado == "activo") {
            this.servicio.estado = "inactivo";
          } else {
            this.servicio.estado = "activo";
          }
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>