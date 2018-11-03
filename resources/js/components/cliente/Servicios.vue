<template>
  <v-card
    class="mx-auto elevation-20"
    color="indigo lighten-2"
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
      <v-icon 
            small
            class="mr-2"
            @click="$emit('editar',servicio)"
          >
            edit
      </v-icon>
      <v-icon
        class="mr-3"
            small
            @click="$emit('eliminar',servicio)"
          >
            delete
          </v-icon>
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
        readonly
        half-increments
        hover
        size="18"
      ></v-rating>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  data: () => ({
    rating: 0
  }),
  props: {
    servicio: {}
  },
  watch: {
    servicio: function(val) {
      this.rating = val.reputacion;
    },
    rating: function(val) {
      this.servicio.reputacion = val;
      console.log(this.servicio);
    }
  }
};
</script>