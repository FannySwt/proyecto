<template>
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
        <servicio v-bind:servicio="props.item"></servicio>
      </v-flex>
      <template slot="no-data">
        <div class="font-weight title indigo mb-2 ml-5"></div>
      </template>
    </v-data-iterator>
  </v-container>
</template>

<script>
import Servicio from "./../publico/Servicios";

export default {
  data: () => ({
    rowsPerPageItems: [3, 6, 9],
    pagination: {
      rowsPerPage: 9
    }
  }),
  components: {
    Servicio
  },
  props: {
    servicios: undefined
  }
};
</script>