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
        <servicios 
          v-bind:servicio="props.item" 
          v-on:editar="editarServicio"
          v-on:eliminar="eliminarServicio">
        </servicios>
      </v-flex>
    </v-data-iterator>
  </v-container>
</template>

<script>
import Servicios from "./../cliente/Servicios";

export default {
  data: () => ({
    rowsPerPageItems: [3, 6, 9],
    pagination: {
      rowsPerPage: 6
    }
  }),
  methods: {
    editarServicio(servicio) {
      console.log(servicio);
      this.$emit("editar", servicio);
    },
    eliminarServicio(servicio) {
      console.log(servicio);
      this.$emit("eliminar", servicio);
    }
  },
  components: {
    Servicios
  },
  props: {
    servicios: []
  }
};
</script>