<template>
  <v-container fluid fill-height>
    <v-layout column justify-center align-center>
      <span class="display-3 font-weight-light indigo--text mb-2">Filtrar Ingresos</span>
      <v-flex xs12 justify-center align-center>
        <v-divider></v-divider>

        <v-flex xs10>
          <v-select
            v-model="ubicacionElegida"
            :items="ubicacion"
            label="Filtrar ubicación"
            prepend-icon="filter_list"
            solo
          ></v-select>
        </v-flex>

        <v-flex xs10 align-center justify-center>
          <v-menu
            :close-on-content-click="false"
            v-model="menu"
            :nudge-right="40"
            lazy
            transition="scale-transition"
            offset-y
            full-width
            min-width="290px"
          >
            <v-text-field
              solo
              slot="activator"
              v-model="fecha_inicio"
              label="Fecha inicial"
              prepend-icon="event"
              readonly
            ></v-text-field>
            <v-date-picker v-model="fecha_inicio" @input="menu = false"></v-date-picker>
          </v-menu>
        </v-flex>

        <v-flex xs10 align-center justify-center>
          <v-menu
            :close-on-content-click="false"
            v-model="menu2"
            :nudge-right="40"
            lazy
            transition="scale-transition"
            offset-y
            full-width
            min-width="290px"
          >
            <v-text-field
              slot="activator"
              label="Fecha Final"
              prepend-icon="event"
              readonly
              solo
              v-model="fecha_final"
            ></v-text-field>
            <v-date-picker v-model="fecha_final" @input="menu2 = false"></v-date-picker>
          </v-menu>
        </v-flex>
        <v-layout xs10 justify-end align-end>
          <v-btn color="blue darken-1" mr-5 @click="filtrarIngresos">Filtrar
            <v-icon>search</v-icon>
          </v-btn>
        </v-layout>
      </v-flex>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>

      <v-flex xs10 align-center justify-center>
        <v-dialog v-model="dialog" @click="dialog=true" width="100pv">
          <v-card>
            <v-card-title
              class="headline indigo lighten-2"
              primary-title
            >Ingresos por Rango Seleccionado</v-card-title>

            <v-card-text>
              <v-list-tile-content>
                <v-list-tile-sub-title class="font-light title purple--text mb-2">Consulta</v-list-tile-sub-title>
                <v-list-tile-sub-title
                  class="font-weight indigo--text darken-3 ml-5 mb-2"
                >Ubicación: {{ubicacionElegida}}</v-list-tile-sub-title>
                <v-list-tile-sub-title
                  class="font-weight indigo--text ml-5 mb-2"
                >Fecha inicial: {{fecha_inicio}}</v-list-tile-sub-title>
                <v-list-tile-sub-title
                  class="font-weight indigo--text ml-5 mb-2"
                >Fecha Final: {{fecha_final}}</v-list-tile-sub-title>
                <br>
                <v-list-tile-sub-title
                  class="font-weight black--text mb-2"
                >De acuerdo a la información seleccionada, en ese período de tiempo se obtuvo un ingreso total de ${{ingreso_total}} pesos.</v-list-tile-sub-title>
              </v-list-tile-content>
            </v-card-text>

            <v-divider></v-divider>

            <v-data-table :headers="headers" :items="servicios" hide-actions class="elevation-1">
              <template slot="items" slot-scope="props">
                <td>{{ props.item.nombre_servicio }}</td>
                <td class="text-xs-center">{{ props.item.descripcion_servicio }}</td>
                <td class="text-xs-center">{{ props.item.fecha_publicacion_se }}</td>
                <td class="text-xs-center">{{ props.item.fecha_finalizacion_se }}</td>
                <td class="text-xs-center">{{ props.item.tipo_pago }}</td>
                <td class="text-xs-center">{{ props.item.usuarios_contratando_count }}</td>
                <td class="text-xs-center">{{ props.item.precio_servicio }}</td>
                <td
                  class="text-xs-center"
                >{{props.item.precio_servicio*props.item.usuarios_contratando_count}}</td>
                <td class="justify-center align-center layout px-0"></td>
              </template>
            </v-data-table>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="primary" flat @click="dialog = false">Aceptar</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  created() {
    this.initialize();
  },
  data() {
    return {
      ubicacion: [],
      ubicacionElegida: "",
      id: [],
      menu: false,
      menu2: false,
      dialog: false,
      fecha_inicio: "",
      fecha_final: "",
      servicios: [],
      headers: [
        { text: "Nombre Servicio", align: "left", value: "nombre_servicio" },
        { text: "Descripción", value: "descripcion_servicio" },
        { text: "Fecha Publicación", value: "fecha_publicacion_se" },
        { text: "Fecha Finalización", value: "fecha_finalizacion_se" },
        { text: "Tipo de Pago", value: "tipo_pago" },
        {
          text: "N° de veces contratado",
          value: "usuarios_contratando_count"
        },
        { text: "Precio Servicio", value: "precio_servicio" },
        { text: "Ingreso Total", value: "name", sortable: false }
      ]
    };
  },
  computed: {
    ingreso_total() {
      var total = 0;
      this.servicios.forEach(element => {
        total =
          total + element.precio_servicio * element.usuarios_contratando_count;
      });
      return total;
    }
  },
  methods: {
    remove(item) {
      this.chips.splice(this.chips.indexOf(item), 1);
      this.chips = [...this.chips];
      console.log(item);
    },
    initialize() {
      this.cargarUbicacion();
    },
    consultar() {
      this.dialog = true;
    },
    cargarUbicacion() {
      var url = "/ubicacionServicios";
      axios
        .get(url)
        .then(response => {
          this.ubicacion = response.data;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    filtrarIngresos() {
      var url = "/filtrarIngresos";
      axios
        .post(url, {
          ubicacion: this.ubicacionElegida,
          fecha_publicacion_se: this.fecha_inicio,
          fecha_finalizacion_se: this.fecha_final
        })
        .then(response => {
          this.dialog = true;
          this.servicios = response.data;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>