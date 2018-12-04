2<template>
  <v-container fluid grid-list-md>
    <v-data-iterator
      :items="servicios"
      :rows-per-page-items="rowsPerPageItems"
      :pagination.sync="pagination"
      content-tag="v-layout"
      row
      wrap
    >
      <v-flex slot="item" slot-scope="props" xs4>
        <servicios v-bind:servicio="props.item" v-on:recargar="cargarServicios"></servicios>
      </v-flex>
      <template slot="no-data">
        <div class="font-weight-light title mb-2 ml-5">Aún no haz contratado servicios.</div>
      </template>
    </v-data-iterator>
  </v-container>
</template>

<script>
import Servicios from "./../publico/Servicios";

export default {
  data: () => ({
    rowsPerPageItems: [3, 6, 9],
    pagination: {
      rowsPerPage: 9
    },
    servicios: []
  }),
  created() {
    this.cargarServicios();
  },
  methods: {
    cargarServicios() {
      var url = "/serviciosActivos";
      axios
        .get(url)
        .then(response => {
          this.servicios = response.data;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  components: {
    Servicios
  },
  props: {}
};
</script>