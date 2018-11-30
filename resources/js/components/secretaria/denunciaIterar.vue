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
    </v-data-iterator>
  </v-container>
</template>

<script>
import Servicios from "./../secretaria/denunciaServicio";

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
    this.cargarDenuncias();
  },
  methods: {
    cargarDenuncias() {
      var url = "/comentariosDenuncia/" + this.servicio.id;
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
    cargarServicios() {
      var url = "/serviciosDenunciados";
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