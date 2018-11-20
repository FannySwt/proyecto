<template>
  <div>
    <v-toolbar flat color="white">
      <v-toolbar-title>Métodos de Pagos</v-toolbar-title>
      <v-divider
        class="mx-2"
        inset
        vertical
      ></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <v-btn slot="activator" color="primary" dark class="mb-2">Nuevo Método de Pago</v-btn>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>
          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.tipo_pago" label="Método de Pago"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.banco" label="Banco"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.tipo_cuenta" label="Tipo de Cuenta"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.cantidad_cuota" label="Cantidad de Cuotas"></v-text-field>
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
      :items="metodosPagos"
      hide-actions
      class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.tipo_pago }}</td>
        <td class="text-xs-center">{{ props.item.banco }}</td>
        <td class="text-xs-center">{{ props.item.tipo_cuenta }}</td>
        <td class="text-xs-center">{{ props.item.cantidad_cuota }}</td>
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
    </v-data-table>
  </div>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
    headers: [
      { text: "Tipo de Pago", align: "left", value: "tipo_pago" },
      { text: "Banco", align: "left", value: "banco" },
      { text: "Tipo de Cuentas", value: "tipo_cuenta" },
      { text: "Cantidad de Cuotas", value: "cantidad_cuota" },
      { text: "Actions", value: "name", sortable: false }
    ],

    metodosPagos: [],
    editedIndex: -1,
    editedItem: {
      id: 0,
      tipo_pago: "",
      banco: "",
      tipo_cuenta: "",
      cantidad_cuota: ""
    },
    defaultItem: {
      id: 0,
      tipo_pago: "",
      banco: "",
      tipo_cuenta: "",
      cantidad_cuota: ""
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1
        ? "Nuevo Método de Pago"
        : "Editar Método de Pago";
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
      this.cargarMetodosPagos();
    },

    editItem(item) {
      this.editedIndex = this.metodosPagos.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const id = item.id;
      confirm("Estas seguro de querer eliminar este método de pago?") &&
        this.eliminarMetodosPagos(id);
      this.cargarMetodosPagos();
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
        this.actualizarMetodosPagos();
      } else {
        this.guardarMetodosPagos();
      }
      this.cargarMetodosPagos();
      this.close();
    },
    cargarMetodosPagos() {
      var url = "/metodosPagos";
      axios
        .get(url)
        .then(response => {
          this.metodosPagos = response.data;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    guardarMetodosPagos() {
      var url = "/metodosPagos";
      axios
        .post(url, {
          tipo_pago: this.editedItem.tipo_pago,
          banco: this.editedItem.banco,
          tipo_cuenta: this.editedItem.tipo_cuenta,
          cantidad_cuota: this.editedItem.cantidad_cuota
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    actualizarMetodosPagos() {
      var url = "/metodosPagos/" + this.editedItem.id;
      axios
        .put(url, {
          tipo_pago: this.editedItem.tipo_pago,
          banco: this.editedItem.banco,
          tipo_cuenta: this.editedItem.tipo_cuenta,
          cantidad_cuota: this.editedItem.cantidad_cuota
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    eliminarMetodosPagos(id) {
      var url = "/metodosPagos/" + id;
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
