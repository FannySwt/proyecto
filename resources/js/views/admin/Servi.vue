<template>
  <div>
    <v-toolbar flat color="white">
      <v-toolbar-title>Usuarios</v-toolbar-title>
      <v-divider
        class="mx-2"
        inset
        vertical
      ></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <v-btn slot="activator" color="primary" dark class="mb-2">Nuevo Servicio</v-btn>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>
          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.nombre_servicio" label="Nombre"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.descripcion_servicio" label="Descripción"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.estado" label="Estado"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.fecha_publicacion_se" label="Fecha de publicacion"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.fecha_finalizacion_se" label="Fecha de finalización"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.tags_servicio" label="Tags"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
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
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.precio_servicio" label="Precio"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4 
                v-if="tipo_pago_elegido.tipo_pago == 'Tarjeta'">
                  <v-select
                  label ="Cantidad de Cuotas"
                  :items="cuotas"
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.visitas" label="Visitas"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.creador" label="Creador del servicio"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.ubicacion" label="Ubicación"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.reputacion" label="Reputación"></v-text-field>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click.native="close">Cancelar</v-btn>
            <v-btn color="blue darken-1" flat @click.native="save">Guardar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="servicios"
      hide-actions
      class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.nombre_servicio }}</td>
        <td class="text-xs-center">{{ props.item.descripcion_servicio }}</td>
        <td class="text-xs-center">{{ props.item.estado }}</td>
        <td class="text-xs-center">{{ props.item.fecha_publicacion_se }}</td>
        <td class="text-xs-center">{{ props.item.fecha_finalizacion_se }}</td>
        <td class="text-xs-center">{{ props.item.tags_servicio }}</td>
        <td class="text-xs-center">{{ props.item.tipo_pago }}</td>
        <td class="text-xs-center">{{ props.item.precio_servicio }}</td>
        <td class="text-xs-center">{{ props.item.ubicacion }}</td>
        <td class="text-xs-center">{{ props.item.reputacion }}</td>
        <td class="justify-center align-center layout px-0">
          <v-icon
            small
            class="mr-2"
            @click="editItem(props.item)"
          >
            edit
          </v-icon>
          <v-icon
            small
            @click="deleteItem(props.item)"
          >
            delete
          </v-icon>
        </td>
      </template>
      <template slot="no-data">
        <v-btn color="primary" @click="initialize">Reiniciar</v-btn>
      </template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data: () => ({
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
      { text: "ubicacion", value: "ubicacion" },
      { text: "Reputación", value: "reputacion" },
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
      visitas: "",
      creador: "",
      ubicacion: "",
      reputacion: ""
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
      visitas: "",
      creador: "",
      ubicacion: "",
      reputacion: ""
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
      this.cargarMetodosPago();
    },

    editItem(item) {
      this.editedIndex = this.servicios.indexOf(item);
      this.editedItem = Object.assign({}, item);
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
    },
    guardarServicio() {
      var url = "/usuarios/" + this.editedItem.user_id + "/servicios";
      axios
        .post(url, {
          nombre_servicio: this.editedItem.nombre_servicio,
          descripcion_servicio: this.editedItem.descripcion_servicio,
          estado: this.editedItem.estado,
          fecha_publicacion_se: this.editedItem.fecha_publicacion_se,
          fecha_finalizacion_se: this.editedItem.fecha_finalizacion_se,
          tags_servicio: this.editedItem.tags_servicio,
          cuotas_aceptadas: this.editedItem.cuotas_aceptadas,
          visitas: this.editedItem.visitas,
          creador: this.editedItem.creador,

          reputacion: this.editedItem.reputacion
        })
        .then(response => {
          console.log(response);
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
          estado: this.editedItem.estado,
          fecha_publicacion_se: this.editedItem.fecha_publicacion_se,
          fecha_finalizacion_se: this.editedItem.fecha_finalizacion_se,
          tags_servicio: this.editedItem.tags_servicio,
          cuotas_aceptadas: this.editedItem.cuotas_aceptadas,
          visitas: this.editedItem.visitas,
          creador: this.editedItem.creador,

          reputacion: this.editedItem.reputacion
        })
        .then(response => {
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
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    cargarMetodosPago() {
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
  }
};
</script>
