<template>
    <v-container>
        holaa
    <ServiciosPage></ServiciosPage>
    </v-container>
</template>


<script>
import Servicios from "./../secretaria/Servicios";
import ServiciosPage from "./../../components/contratar/Servicios";

export default {
  data: () => ({
    servicios: []
  }),
  created() {
    this.cargarServicios();
  },
  methods: {
    cargarServicios() {
      var url = "/servicios";
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
    Servicios,
    ServiciosPage
  },
  props: {}
};
</script>