<template>
  <div>
    <v-toolbar flat color="blue">
      <v-toolbar-title>Usuarios</v-toolbar-title>
      <v-divider
        class="mx-2"
        inset
        vertical
      ></v-divider>
    
      <v-dialog v-model="dialog" max-width="500px">
      <!--  <v-btn slot="activator" color="primary" dark class="mb-2">Nuevo Usuario</v-btn> -->
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>
          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.rut_usuario" label="Rut"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.nombre_usuario" label="Nombre"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.email" label="Email"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.password" label="Password"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.alias" label="Alias"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.fecha_nac" label="Fecha"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.domicilio_usuario" label="Domicilio"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.telefono" label="Telefono"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.tipo_usuario" label="tipo_usuario"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.fecha_contratacion" label="Contratacion"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.reputacion_cliente" label="Reputacion"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.estado_cliente" label="Estado"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.tipo_cliente" label="Tipo"></v-text-field>
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
      :items="usuarios"
      hide-actions
      class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.rut_usuario }}</td>
        <td class="text-xs-center">{{ props.item.nombre_usuario }}</td>
        <td class="text-xs-center">{{ props.item.email }}</td>
        <td class="text-xs-center">{{ props.item.telefono }}</td>
        <td class="text-xs-center">{{ props.item.alias }}</td>
        <td class="text-xs-center">{{ props.item.tipo_usuario }}</td>
        <td class="justify-center align-center layout px-0">
         <!-- <v-icon
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
          </v-icon>  -->
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
      { text: "Rut", align: "left", value: "rut_usuario" },
      { text: "Nombre", value: "nombre_usuario" },
      { text: "Email", value: "email" },
      { text: "Telefono", value: "telefono" },
      { text: "Alias", value: "alias" },
      { text: "Tipo de Usuario", value: "tipo_usuario" }
      // { text: "Actions", value: "name", sortable: false },
    ],
    usuarios: [],
    editedIndex: -1,
    editedItem: {
      id: 0,
      rut_usuario: "",
      nombre_usuario: "",
      email: "",
      password: "",
      alias: "",
      fecha_nac: "",
      domicilio_usuario: "",
      telefono: "",
      tipo_usuario: "",
      fecha_contratacion: "",
      reputacion_cliente: "",
      estado_cliente: "",
      tipo_cliente: ""
    },
    defaultItem: {
      id: 0,
      rut_usuario: "",
      nombre_usuario: "",
      email: "",
      password: "",
      alias: "",
      fecha_nac: "",
      domicilio_usuario: "",
      telefono: "",
      tipo_usuario: "",
      fecha_contratacion: "",
      reputacion_cliente: "",
      estado_cliente: "",
      tipo_cliente: ""
    }
  }),
  /*
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nuevo Usuario" : "Editar Usuarios";
    }
  },*/

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
      this.cargarUsuarios();
    },

    editItem(item) {
      this.editedIndex = this.usuarios.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const id = item.id;
      confirm("Estas seguro de querer eliminar este usuario?") &&
        this.eliminarUsuario(id);
      this.cargarUsuarios();
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    save() {
      var url = "/hash";
      axios
        .post(url, {
          password: this.editedItem.password
        })
        .then(response => {
          this.editedItem.password = response.data;
          if (this.editedIndex > -1) {
            this.actualizarUsuario();
          } else {
            this.guardarUsuario();
          }
          this.cargarUsuarios();
          this.close();
        })
        .catch(error => {
          console.log(error);
        });
    },
    cargarUsuarios() {
      var url = "/usuarios";
      axios
        .get(url)
        .then(response => {
          this.usuarios = response.data;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    guardarUsuario() {
      var url = "/usuarios";
      axios
        .post(url, {
          rut_usuario: this.editedItem.rut_usuario,
          nombre_usuario: this.editedItem.nombre_usuario,
          email: this.editedItem.email,
          password: this.editedItem.password,
          alias: this.editedItem.alias,
          fecha_nac: this.editedItem.fecha_nac,
          domicilio_usuario: this.editedItem.domicilio_usuario,
          telefono: this.editedItem.telefono,
          tipo_usuario: this.editedItem.tipo_usuario,
          fecha_contratacion: this.editedItem.fecha_contratacion,
          reputacion_cliente: this.editedItem.reputacion_cliente,
          estado_cliente: this.editedItem.estado_cliente,
          tipo_cliente: this.editedItem.tipo_cliente
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    actualizarUsuario() {
      var url = "/usuarios/" + this.editedItem.id;
      axios
        .put(url, {
          rut_usuario: this.editedItem.rut_usuario,
          nombre_usuario: this.editedItem.nombre_usuario,
          email: this.editedItem.email,
          password: this.editedItem.password,
          alias: this.editedItem.alias,
          fecha_nac: this.editedItem.fecha_nac,
          domicilio_usuario: this.editedItem.domicilio_usuario,
          telefono: this.editedItem.telefono,
          tipo_usuario: this.editedItem.tipo_usuario,
          fecha_contratacion: this.editedItem.fecha_contratacion,
          reputacion_cliente: this.editedItem.reputacion_cliente,
          estado_cliente: this.editedItem.estado_cliente,
          tipo_cliente: this.editedItem.tipo_cliente
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    eliminarUsuario(id) {
      var url = "/usuarios/" + id;
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
