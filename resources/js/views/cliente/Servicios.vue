<template>
  <v-container fluid fill-height>
    <v-btn fab bottom right color="pink" dark fixed @click="crear">
      <v-icon>add</v-icon>
    </v-btn>
    <v-dialog v-model="dialog" max-width="500px">
      <v-card>
        <v-card-title>
          <span class="headline">{{ formTitle }}</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12>
                <v-text-field v-model="editedItem.nombre_servicio" label="Nombre"></v-text-field>
              </v-flex>
              <v-flex xs12>
                <v-text-field v-model="editedItem.descripcion_servicio" label="Descripción"></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
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
                    slot="activator"
                    v-model="editedItem.fecha_publicacion_se"
                    label="Fecha de publicación"
                    prepend-icon="event"
                    readonly
                  ></v-text-field>
                  <v-date-picker v-model="editedItem.fecha_publicacion_se" @input="menu = false"></v-date-picker>
                </v-menu>
              </v-flex>
              <v-flex xs12 sm6 md4>
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
                    v-model="editedItem.fecha_finalizacion_se"
                    label="Fecha de Finalización"
                    prepend-icon="event"
                    readonly
                  ></v-text-field>
                  <v-date-picker v-model="editedItem.fecha_finalizacion_se" @input="menu2 = false"></v-date-picker>
                </v-menu>
              </v-flex>
              <v-flex xs12>
                <v-text-field v-model="editedItem.tags_servicio" label="Tags"></v-text-field>
              </v-flex>
              <v-flex xs12>
                <v-select
                  :items="tipo_pago"
                  item-text="tipo_pago"
                  item-value="tipo_pago"
                  label="Metodo de Pago"
                  v-model="tipo_pago_elegido"
                  v-on:change="cambioTipoPago"
                  return-object
                ></v-select>
              </v-flex>
              <v-flex xs12>
                <v-text-field v-model="editedItem.precio_servicio" label="Precio"></v-text-field>
              </v-flex>
              <v-flex xs12>
                <v-text-field v-model="editedItem.creador" label="Creador del servicio"></v-text-field>
              </v-flex>
              <v-flex xs12>
                <v-text-field v-model="editedItem.ubicacion" label="Ubicación"></v-text-field>
              </v-flex>
              <v-flex xs12 v-if="editar">
                <v-text-field v-model="editedItem.visitas" label="visitas"></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click.native="close">Cancelar</v-btn>
          <v-btn v-if="!editar" color="blue darken-1" flat @click="guardarServicio">Guardar</v-btn>
          <v-btn v-if="editar" color="blue darken-1" flat @click="actualizarServicio">Editar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <Iterar :servicios="servicios" v-on:editar="editItem" v-on:eliminar="deleteItem">></Iterar>
  </v-container>
</template>


<script>
import Iterar from "./../../components/cliente/Iterar";
export default {
  data: () => ({
    date: new Date().toISOString().substr(0, 10),
    menu: false,
    modal: false,
    menu2: false,
    editar: false,
    tipo_pago: [],
    cuotas: [],
    tipo_pago_elegido: "",
    dialog: false,
    headers: [
      { text: "Nombre Servicio", align: "left", value: "nombre" },
      { text: "Descripción", value: "descripcion_servicio" },
      { text: "Estado", value: "estado" },
      { text: "Fecha Publicación", value: "fecha_publicacion_se" },
      { text: "Fecha Finalización", value: "fecha_finalizacion_se" },
      { text: "Tags Servicio", value: "tags_servicio" },
      { text: "Tipo de Pago", value: "tipo_pago" },
      { text: "Precio Servicio", value: "precio_servicio" },
      { text: "Me Gusta", value: "me_gusta" },
      { text: "No me Gusta", value: "no_me_gusta" },
      { text: "Actions", value: "name", sortable: false }
    ],
    servicios: [],
    editedIndex: -1,
    editedItem: {
      id: 0,
      nombre_servicio: "",
      descripcion_servicio: "",
      estado: "",
      fecha_publicacion_se: "",
      fecha_finalizacion_se: "",
      tags_servicio: "",
      tipo_pago: "",
      precio_servicio: "",
      visitas: "",
      creador: "",
      ubicacion: "",
      me_gusta: "",
      no_me_gusta: ""
    },
    defaultItem: {
      id: 0,
      nombre_servicio: "",
      descripcion_servicio: "",
      estado: "",
      fecha_publicacion_se: "",
      fecha_finalizacion_se: "",
      tags_servicio: "",
      tipo_pago: "",
      precio_servicio: "",
      visitas: "",
      creador: "",
      ubicacion: "",
      me_gusta: "",
      no_me_gusta: ""
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nuevo Servicio" : "Editar Servicios";
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      this.cargarServicios();
      this.cargarMetodosPagos();
    },

    editItem(item) {
      this.editedIndex = this.servicios.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
      this.editar = true;
      this.tipo_pago_elegido = item.tipo_pago;
      console.log("servicio", item);
    },
    crear() {
      this.editar = false;
      this.dialog = true;
    },

    deleteItem(item) {
      const id = item.id;
      confirm("Estas seguro de querer eliminar este Servicio?") &&
        this.eliminarServicio(id);
      this.cargarServicios();
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    save() {
      if (this.editedIndex > -1) {
        this.actualizarServicio();
      } else {
        this.guardarServicio();
      }
      this.cargarServicios();
      this.close();
    },
    cargarServicios() {
      var url = "/serviciosUsuario";
      axios
        .get(url)
        .then(response => {
          this.servicios = response.data;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    guardarServicio() {
      var url = "/servicios/";
      axios
        .post(url, {
          nombre_servicio: this.editedItem.nombre_servicio,
          descripcion_servicio: this.editedItem.descripcion_servicio,
          estado: "inactivo",
          fecha_publicacion_se: this.editedItem.fecha_publicacion_se,
          fecha_finalizacion_se: this.editedItem.fecha_finalizacion_se,
          tags_servicio: this.editedItem.tags_servicio,
          visitas: 0,
          creador: this.editedItem.creador,
          tipo_pago: this.tipo_pago_elegido.tipo_pago,
          precio_servicio: this.editedItem.precio_servicio,
          me_gusta: this.editedItem.me_gusta,
          no_me_gusta: this.editedItem.no_me_gusta,
          ubicacion: this.editedItem.ubicacion
        })
        .then(response => {
          console.log(response);
          this.cargarServicios();
        })
        .catch(error => {
          console.log(error);
        });
    },
    actualizarServicio() {
      var url = "/servicios/" + this.editedItem.id;
      axios
        .put(url, {
          nombre_servicio: this.editedItem.nombre_servicio,
          descripcion_servicio: this.editedItem.descripcion_servicio,
          estado: "inactivo",
          fecha_publicacion_se: this.editedItem.fecha_publicacion_se,
          fecha_finalizacion_se: this.editedItem.fecha_finalizacion_se,
          tags_servicio: this.editedItem.tags_servicio,
          visitas: 0,
          creador: this.editedItem.creador,
          tipo_pago: this.tipo_pago_elegido,
          precio_servicio: this.editedItem.precio_servicio,
          me_gusta: this.editedItem.me_gusta,
          no_me_gusta: this.editedItem.no_me_gusta,
          ubicacion: this.editedItem.ubicacion
        })
        .then(response => {
          this.cargarServicios();
          this.close();
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    eliminarServicio(id) {
      var url = "/servicios/" + id;
      axios
        .delete(url)
        .then(response => {
          this.cargarServicios();
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    cargarMetodosPagos() {
      var url = "/metodosPagos";
      axios
        .get(url)
        .then(response => {
          this.tipo_pago = response.data;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    cambioTipoPago() {
      console.log(this.tipo_pago_elegido);
      this.cuotas = this.tipo_pago_elegido.cuotas;
    }
  },
  components: {
    Iterar
  }
};
</script>
