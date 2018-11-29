<template>
  <v-hover>
    <v-card slot-scope="{ hover }" class="mx-auto" color="grey lighten-4" max-width="600">
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
            <v-btn
              v-if="servicio.estado=='activo'"
              @click="actualizarServicio"
              color="success"
            >Activo</v-btn>
            <v-btn
              v-if="servicio.estado=='inactivo'"
              @click="actualizarServicio"
              color="error"
            >Inactivo</v-btn>
          </v-layout>
          <v-layout class="ml-3" justify-start row fill-height>
            <v-icon>thumb_up_alt</v-icon>
            {{servicio.me_gusta}}
            <v-icon class="ml-5">thumb_down_alt</v-icon>
            {{servicio.no_me_gusta}}
          </v-layout>
        </div>
      </v-card-text>
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
          me_gusta: this.servicio.me_gusta,
          no_me_gusta: this.servicio.no_me_gusta,
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