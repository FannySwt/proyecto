<template>
  <div>
    <v-toolbar flat color="white">
      <v-toolbar-title>Categorías</v-toolbar-title>
      <v-divider class="mx-2" inset vertical></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <v-btn slot="activator" color="primary" dark class="mb-2">Nueva Categoría</v-btn>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>
          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.nombre_categoria" label="Nombre"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.descripcion_categoria" label="descripcion"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.estado_categoria" label="estado"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field
                    v-model="editedItem.cantidad_publicaciones"
                    label="cantidad publicaciones"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.edad_recomendada" label="edad recomendada"></v-text-field>
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
    <v-data-table :headers="headers" :items="categorias" hide-actions class="elevation-1">
      <template slot="items" slot-scope="props">
        <td>{{ props.item.nombre_categoria }}</td>
        <td class="text-xs-center">{{ props.item.descripcion_categoria }}</td>
        <td class="text-xs-center">{{ props.item.estado_categoria }}</td>
        <td class="text-xs-center">{{ props.item.cantidad_publicaciones }}</td>
        <td class="text-xs-center">{{ props.item.edad_recomendada }}</td>
        <td class="justify-center align-center layout px-0">
          <v-icon small class="mr-2" @click="editItem(props.item)">edit</v-icon>
          <v-icon small @click="deleteItem(props.item)">delete</v-icon>
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
    dialog: false,
    headers: [
      { text: "Nombre Categoría", align: "left", value: "nombre_categoria" },
      { text: "Descripción Categoría", value: "descripcion_categoria" },
      { text: "Estado Categoría", value: "estado_categoria" },
      { text: "Cantidad Publicaciones", value: "cantidad_publicaciones" },
      { text: "Edad Recomendada", value: "edad_recomendada" },
      { text: "Actions", value: "name", sortable: false }
    ],

    categorias: [],
    editedIndex: -1,
    editedItem: {
      id: 0,
      nombre_categoria: "",
      descripcion_categoria: "",
      cantidad_publicaciones: "",
      edad_recomendada: ""
    },
    defaultItem: {
      id: 0,
      nombre_categoria: "",
      descripcion_categoria: "",
      cantidad_publicaciones: "",
      edad_recomendada: ""
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nueva Categoría" : "Editar Categorías";
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
      this.cargarCategorias();
    },

    editItem(item) {
      this.editedIndex = this.categorias.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const id = item.id;
      confirm("Estas seguro de querer eliminar esta categoría?") &&
        this.eliminarCategorias(id);
      this.cargarCategorias();
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
        this.actualizarCategorias();
      } else {
        this.guardarCategorias();
      }
      this.cargarCategorias();
      this.close();
    },
    cargarCategorias() {
      var url = "/categorias";
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
    guardarCategorias() {
      var url = "/categorias";
      axios
        .post(url, {
          nombre_categoria: this.editedItem.nombre_categoria,
          descripcion_categoria: this.editedItem.descripcion_categoria,
          estado_categoria: this.editedItem.estado_categoria,
          cantidad_publicaciones: this.editedItem.cantidad_publicaciones,
          edad_recomendada: this.editedItem.edad_recomendada
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    actualizarCategorias() {
      var url = "/categorias/" + this.editedItem.id;
      axios
        .put(url, {
          nombre_categoria: this.editedItem.nombre_categoria,
          descripcion_categoria: this.editedItem.descripcion_categoria,
          estado_categoria: this.editedItem.estado_categoria,
          cantidad_publicaciones: this.editedItem.cantidad_publicaciones,
          edad_recomendada: this.editedItem.edad_recomendada
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    eliminarCategorias(id) {
      var url = "/categorias/" + id;
      axios
        .delete(url)
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
