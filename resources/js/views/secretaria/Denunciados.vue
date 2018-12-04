<template>
  <v-container fluid fill-height>
    <iterar v-on:recargar="cargarServicios"></iterar>
    <v-divider></v-divider>
  </v-container>
</template>


<script>
import Iterar from "./../../components/secretaria/denunciaIterar";
export default {
  data: () => ({
    tipo_pago: [],
    cuotas: [],
    tipo_pago_elegido: "",
    dialog: false,
    servicios: [],
    headers: [
      { text: "Nombre Servicio", align: "left", value: "nombre" },
      { text: "Descripción", value: "descripcion_servicio" },
      { text: "Estado", value: "estado" },
      { text: "Fecha Publicación", value: "fecha_publicacion_se" },
      { text: "Fecha Finalización", value: "fecha_finalizacion_se" },
      { text: "Tags Servicio", value: "tags_servicio" },
      { text: "Tipo de Pago", value: "tipo_pago" },
      { text: "Precio Servicio", value: "precio_servicio" },
      { text: "Reputación", value: "reputacion" },
      { text: "Actions", value: "name", sortable: false }
    ],
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
      no_me_gusta: "",
      denunciado: ""
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
      no_me_gusta: "",
      denunciado: ""
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
    },
    editItem(item) {
      this.editedIndex = this.servicios.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
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
    Iterar
  }
};
</script>
