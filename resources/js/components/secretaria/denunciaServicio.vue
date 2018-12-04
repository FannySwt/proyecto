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
        <v-divider></v-divider>
        <v-layout>
          <div class="font-weight-light title mb-2">Motivos de Denuncias del Servicio</div>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="1000px">
            <v-btn
              slot="activator"
              class="justify-end"
              @click="verDenuncias()"
              color="info"
              dark
            >Ver</v-btn>

            <v-card>
              <v-card-title
                class="headline blue lighten-2"
                primary-title
              >Motivos de Denuncias del Servicio</v-card-title>
              <br>
              <v-layout>
                <div class="headline lighten-2 title ml-5 mb-2 i">Comentarios</div>
                <v-spacer></v-spacer>
                <div class="headline lighten-2 title mr-5 mb-2 i">Acción</div>
              </v-layout>
              <v-data-table :headers="headers" :items="denuncia" hide-actions class="elevation-1">
                <template slot="items" item-key slot-scope="props">
                  <v-layout>
                    <v-flex xs11>
                      <div class="headline lighten-2 title mb-2 ml-5 i">-{{ props.item.comentario }}</div>
                    </v-flex>
                    <v-spacer></v-spacer>
                    <v-flex xs1 justify-center align-center>
                      <v-icon big @click="eliminar(props.item)">delete</v-icon>
                    </v-flex>
                    <br>
                  </v-layout>
                  <v-divider></v-divider>
                </template>
                <template slot="no-data">
                  <div class="font-weight-light title mb-2 ml-5">No hay Denuncias para mostrar.</div>
                </template>
              </v-data-table>
              <v-divider></v-divider>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" flat @click="dialog = false">Aceptar</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-layout>
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
    rating: 4.3,
    dialog: false,
    denuncia: [],
    headers: []
  }),
  props: {
    servicio: {}
  },
  computed: {
    idServicio() {
      return this.servicio.id;
    }
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
    },
    verDenuncias() {
      var url = "/comentariosDenuncia/" + this.idServicio;
      axios
        .get(url)
        .then(response => {
          this.denuncia = response.data;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    eliminar(servicio) {
      var url = "/denuncias/" + servicio.id;
      axios
        .delete(url)
        .then(response => {
          console.log("eliminado", response);
          this.verDenuncias();
          close();
        })
        .catch(error => {
          console.log(error);
        });
    },
    close() {
      dialog = false;
    }
  }
};
</script>