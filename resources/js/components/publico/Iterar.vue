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
      <v-flex
        slot="item"
        slot-scope="props"
        xs4
      >
        <servicios v-bind:servicio="props.item"
        v-on:recargar="cargarServicios" >
          
        </servicios>
      </v-flex>
    </v-data-iterator>
  </v-container>
</template>

<script>
import Servicios from "./../publico/Servicios";

export default {
  data: () => ({
    rowsPerPageItems: [3, 6, 9],
    pagination: {
      rowsPerPage: 6
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