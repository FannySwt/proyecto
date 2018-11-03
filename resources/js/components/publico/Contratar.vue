<template>
  <div>
    <v-btn slot="activator">
    </v-btn>
    <v-card>
      <v-card-title
        class="grey lighten-4 py-4 title">
        <span class="headline">Contratar Servicio</span>
      </v-card-title>
      <v-container grid-list-sm class="pa-4">
          <v-layout row wrap>
            <v-flex xs12 align-center justify-space-between>
              <v-layout align-center>
                <v-avatar size="40px" class="mr-3">
                  <img
                    src="//ssl.gstatic.com/s2/oz/images/sge/grey_silhouette.png"
                    alt=""
                  >
                </v-avatar>
                <v-text-field v-model="editedItem.fecha_contratacion" label="Fecha de Contratación"></v-text-field>
              </v-layout>
            </v-flex>
            <v-flex xs6>
              <v-text-field v-model="editedItem.descuento_tipo_cliente" label="Descuento Tipo de Cliente" prepend-icon="dialpad"></v-text-field>
            </v-flex>
            <v-flex xs12>
              <v-text-field v-model="editedItem.tipo_pago" label="Tipo de Pago" prepend-icon="mail"></v-text-field>
            </v-flex>
            <v-flex xs12>
              <v-text-field v-model="editedItem.numero_tarjeta" label="Numero de Tarjeta" prepend-icon="dialpad"></v-text-field>
            </v-flex> 
            <v-flex xs12>
              <v-text-field v-model="editedItem.numero_cuota" label="Numero de Cuotas" prepend-icon="phone" mask="phone"></v-text-field>
            </v-flex>
        </v-layout>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="info"  @click="redirect('/home')">Cancelar</v-btn>
          <v-btn color="error" @click.native="save">Contratar Servicio</v-btn>
        </v-card-actions>
      </v-container>
    </v-card>

  </div>
</template>

<script>
import Fecha from "./../../components/Fecha";
export default {
  data: () => ({
    date: new Date().toISOString().substr(0, 10),
    menu: false,
    modal: false,
    menu2: false,
    tipo_usuario: ["cliente"],
    tipo_usuario_elegido: "",
    dialog: false,
    headers: [
      { text: "Rut", align: "left", value: "rut_usuario" },
      { text: "Nombre", value: "nombre_usuario" },
      { text: "Email", value: "email" },
      { text: "Telefono", value: "telefono" },
      { text: "Alias", value: "alias" },
      { text: "Tipo de Usuario", value: "tipo_usuario" },
      { text: "Actions", value: "name", sortable: false }
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
    redirect(link) {
      this.$router.push(link);
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
          tipo_usuario: this.tipo_usuario_elegido,
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
          tipo_usuario: this.tipo_usuario_elegido,
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
  },
  components: {
    Fecha
  }
};
</script>
