<template>
  <v-card
    v-if="servicio.estado == 'activo'"
    class="mx-auto elevation-20"
    color="pink lighten-2"
    dark
    height="450px"
  >
    <v-layout justify-space-between>
      <v-flex xs12>
        <v-card-title primary-title>
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
      <div
        class="h5 ml-3"
      >Disponible: {{servicio.fecha_publicacion_se}} - {{servicio.fecha_finalizacion_se}}</div>
      <v-spacer></v-spacer>

      <div class="text-xs-center">
        <v-dialog v-model="dialog" width="500">
          <v-btn v-on:click="contador += 1 " color="info" slot="activator">Ver</v-btn>
          <v-card
            v-if="servicio.estado == 'activo'"
            class="mx-auto elevation-20"
            color="pink lighten-2"
            dark
            height="450px"
          >
            <v-layout justify-space-between>
              <v-flex xs12>
                <v-card-title primary-title>
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
              <div
                class="h5 ml-3"
              >Disponible: {{servicio.fecha_publicacion_se}} - {{servicio.fecha_finalizacion_se}}</div>
              <v-spacer></v-spacer>

              <v-btn v-if="!auth" color="info" v-on:click="registro">Contratar</v-btn>
              <v-btn
                v-if="auth"
                color="info"
                v-on:click="$router.push({name:'clientecontratar'})"
              >Contratar</v-btn>
            </v-layout>

            <v-card-actions class="h5 ml-1">
              Reputación:
              <span class="grey--text text--lighten-2 caption mr-2">({{ rating }})</span>
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
                {{contador}}
                <div class="ml-1"></div>
                <v-icon>visibility</v-icon>
              </div>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </div>

      <v-btn v-if="!auth" color="info" v-on:click="registro">Contratar</v-btn>
      <v-btn v-if="auth" color="info" v-on:click="$router.push({name:'clientecontratar'})">Contratar</v-btn>
    </v-layout>

    <v-card-actions class="h5 ml-1">
      Reputación:
      <span class="grey--text text--lighten-2 caption mr-2">({{ rating }})</span>
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
        {{contador}}
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
  data: () => ({
    contador: 0,
    rating: 4.3,
    dialog: false
  }),
  props: {
    servicio: {}
  },
  components: {
    Servicios,
    Iterar
  },
  computed: {
    auth() {
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
  },
  methods: {
    redirect(link) {
      this.$router.push(link);
    },
    registro: function(event) {
      alert("Primero debes Iniciar Sesión");
    }
  }
};
</script>