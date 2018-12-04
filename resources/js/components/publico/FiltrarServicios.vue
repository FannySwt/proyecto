<template>
  <v-container fluid fill-height>
    <v-layout row justify-center align-center>
      <span class="display-3 font-weight-light indigo--text mb-2">Filtrar Ingresos</span>
      <v-flex xs12 justify-center align-center>
        <v-divider></v-divider>

        <v-flex xs10>
          <v-select
            v-model="categoriaElegida"
            :items="categorias"
            label="Filtrar Categorías"
            prepend-icon="filter_list"
            solo
            item-text="nombre_categoria"
            item-value="id"
          ></v-select>
        </v-flex>

        <v-flex xs10>
          <v-select
            v-model="pagoElegido"
            :items="pagos"
            label="Filtrar Metodos de Pagos"
            prepend-icon="filter_list"
            solo
          ></v-select>
        </v-flex>

        <v-flex xs10>
          <v-select
            v-model="ubicacionElegida"
            :items="ubicaciones"
            label="Filtrar Ubicaciones"
            prepend-icon="filter_list"
            solo
          ></v-select>
        </v-flex>

        <v-flex xs10>
          <v-text-field
            mask="########"
            v-model="precio_minimo"
            label="Filtrar Precio Mínimo"
            prepend-icon="filter_list"
            solo
          ></v-text-field>
        </v-flex>

        <v-flex xs10>
          <v-text-field
            mask="########"
            v-model="precio_maximo"
            label="Filtrar Precio Máximo"
            prepend-icon="filter_list"
            solo
          ></v-text-field>
        </v-flex>

        <v-layout xs10 justify-end align-end>
          <v-btn color="blue darken-1" mr-5 @click="filtrarServicios">Filtrar
            <v-icon>search</v-icon>
          </v-btn>
        </v-layout>
        <v-layout v-if="servicios.length > 0">
          <iterar :servicios="servicios"></iterar>
        </v-layout>
        <v-layout v-else-if="mensaje != ''">
          <v-flex text-xs-center title>{{mensaje}}</v-flex>
        </v-layout>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import Iterar from "./../publico/IterarFiltros";
export default {
  created() {
    this.initialize();
  },
  data() {
    return {
      ubicaciones: [],
      categorias: [],
      pagos: [],
      servicios: [],
      ubicacionElegida: "",
      categoriaElegida: "",
      pagoElegido: "",
      precio_minimo: "",
      precio_maximo: "",
      id: [],
      servicios: [],
      mensaje: ""
    };
  },
  computed: {},
  methods: {
    initialize() {
      this.cargarUbicacion();
      this.cargarCategorias();
      this.cargarMetodosPagos();
    },
    cargarUbicacion() {
      var url = "/ubicacionServicios";
      axios
        .get(url)
        .then(response => {
          this.ubicaciones = response.data;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    cargarCategorias() {
      var url = "/mostrarCategorias";
      axios
        .get(url)
        .then(response => {
          this.categorias = response.data;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    cargarMetodosPagos() {
      var url = "/mostrarPagos";
      axios
        .get(url)
        .then(response => {
          this.pagos = response.data;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },

    filtrarServicios() {
      var url = "/filtrarServicios";
      axios
        .post(url, {
          ubicacion: this.ubicacionElegida,
          categoria: this.categoriaElegida,
          pago: this.pagoElegido,
          precioMinimo: this.precio_minimo,
          precioMaximo: this.precio_maximo
        })
        .then(response => {
          this.servicios = response.data;
          this.mensaje = "Busqueda sin Resultados";
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  components: {
    Iterar
  }
};
</script>