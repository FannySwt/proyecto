<template>
  <v-container fluid fill-height>
    <v-layout row justify-center align-center>
      <span class="display-3 font-weight-light indigo--text mb-2">Filtrar Servicios</span>
      <v-flex xs12 justify-center align-center>
        <v-divider></v-divider>
        <v-flex>
          <span class="display-1 font-weight indigo--text mb-2">Filtrar Por:</span>
          <v-radio-group v-model="eleccion" row class="font-weight indigo--text title mb-2">
            <v-radio label="Categoría" value="categoria"></v-radio>
            <v-radio label="Ubicación" value="ubicacion"></v-radio>
            <v-radio label="Método de Pago" value="metodoPago"></v-radio>
            <v-radio label="Precio mínimo" value="pMin"></v-radio>
            <v-radio label="Precio Máximo" value="pMax"></v-radio>
            <v-radio label="Todos" value="todos"></v-radio>
          </v-radio-group>
        </v-flex>
        <v-layout v-if="eleccion == 'categoria'">
          <v-flex xs8>
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
          <v-flex>
            <v-btn color="blue darken-1" mr-5 @click="filtrarCategorias">Filtrar
              <v-icon>search</v-icon>
            </v-btn>
          </v-flex>
        </v-layout>

        <v-layout v-if="eleccion == 'metodoPago'">
          <v-flex xs8>
            <v-select
              v-model="pagoElegido"
              :items="pagos"
              label="Filtrar Metodos de Pagos"
              prepend-icon="filter_list"
              solo
            ></v-select>
          </v-flex>
          <v-flex>
            <v-btn color="blue darken-1" mr-5 @click="filtrarMetodosPagos">Filtrar
              <v-icon>search</v-icon>
            </v-btn>
          </v-flex>
        </v-layout>

        <v-layout xs8 v-if="eleccion == 'ubicacion'">
          <v-flex>
            <v-select
              v-model="ubicacionElegida"
              :items="ubicaciones"
              label="Filtrar Ubicaciones"
              prepend-icon="filter_list"
              solo
            ></v-select>
          </v-flex>
          <v-flex>
            <v-btn color="blue darken-1" mr-5 @click="filtrarUbicaciones">Filtrar
              <v-icon>search</v-icon>
            </v-btn>
          </v-flex>
        </v-layout>
        <v-layout v-if="eleccion == 'pMin'">
          <v-flex xs8>
            <v-text-field
              mask="########"
              v-model="precio_minimo"
              label="Filtrar Precio Mínimo"
              prepend-icon="filter_list"
              solo
            ></v-text-field>
          </v-flex>
          <v-flex>
            <v-btn color="blue darken-1" mr-5 @click="filtrarMinimo">Filtrar
              <v-icon>search</v-icon>
            </v-btn>
          </v-flex>
        </v-layout>

        <v-layout v-if="eleccion == 'pMax'">
          <v-flex xs8>
            <v-text-field
              mask="########"
              v-model="precio_maximo"
              label="Filtrar Precio Máximo"
              prepend-icon="filter_list"
              solo
            ></v-text-field>
          </v-flex>
          <v-flex>
            <v-btn color="blue darken-1" mr-5 @click="filtrarMaximo">Filtrar
              <v-icon>search</v-icon>
            </v-btn>
          </v-flex>
        </v-layout>

        <v-layout v-if="eleccion == 'todos'" column>
          <v-layout>
            <v-flex xs8>
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
          </v-layout>

          <v-layout>
            <v-flex xs8>
              <v-select
                v-model="pagoElegido"
                :items="pagos"
                label="Filtrar Metodos de Pagos"
                prepend-icon="filter_list"
                solo
              ></v-select>
            </v-flex>
          </v-layout>

          <v-layout>
            <v-flex xs8>
              <v-select
                v-model="ubicacionElegida"
                :items="ubicaciones"
                label="Filtrar Ubicaciones"
                prepend-icon="filter_list"
                solo
              ></v-select>
            </v-flex>
          </v-layout>

          <v-layout>
            <v-flex xs8>
              <v-text-field
                mask="########"
                v-model="precio_minimo"
                label="Filtrar Precio Mínimo"
                prepend-icon="filter_list"
                solo
              ></v-text-field>
            </v-flex>
          </v-layout>

          <v-layout>
            <v-flex xs8>
              <v-text-field
                mask="########"
                v-model="precio_maximo"
                label="Filtrar Precio Máximo"
                prepend-icon="filter_list"
                solo
              ></v-text-field>
            </v-flex>
          </v-layout>
          <v-layout xs10 justify-end align-end>
            <v-btn color="blue darken-1" mr-5 @click="filtrarServicios">Filtrar
              <v-icon>search</v-icon>
            </v-btn>
          </v-layout>
        </v-layout>
      </v-flex>

      <v-layout v-if="servicios.length > 0">
        <iterar :servicios="servicios"></iterar>
      </v-layout>
      <v-layout v-else-if="mensaje != ''">
        <v-flex text-xs-center title>{{mensaje}}</v-flex>
      </v-layout>
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
      eleccion: "",
      eleccion: null,
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
    },
    filtrarCategorias() {
      var url = "/filtrarCategorias";
      axios
        .post(url, {
          categoria: this.categoriaElegida
        })
        .then(response => {
          this.servicios = response.data;
          this.mensaje = "Busqueda sin Resultados";
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    filtrarUbicaciones() {
      var url = "/filtrarUbicaciones";
      axios
        .post(url, {
          ubicacion: this.ubicacionElegida
        })
        .then(response => {
          this.servicios = response.data;
          this.mensaje = "Busqueda sin Resultados";
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    filtrarMetodosPagos() {
      var url = "/filtrarMetodosPagos";
      axios
        .post(url, {
          pago: this.pagoElegido
        })
        .then(response => {
          this.servicios = response.data;
          this.mensaje = "Busqueda sin Resultados";
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    filtrarMinimo() {
      var url = "/filtrarMinimo";
      axios
        .post(url, {
          minimo: this.precio_minimo
        })
        .then(response => {
          this.servicios = response.data;
          this.mensaje = "Busqueda sin Resultados";
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    filtrarMaximo() {
      var url = "/filtrarMaximo";
      axios
        .post(url, {
          maximo: this.precio_maximo
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