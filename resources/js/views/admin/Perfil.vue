<template>
  <v-layout row>
    <v-card width="100%">
      <v-toolbar dark color="primary">
        <v-icon>person</v-icon>
        <v-toolbar-title>{{usuario.nombre_usuario}}</v-toolbar-title>
        <v-spacer></v-spacer>
      </v-toolbar>
      <v-list three-line subheader>
        <v-subheader></v-subheader>
        <v-list-tile avatar>
          <v-list-tile-content>
            <v-list-tile-title>Datos Personales:</v-list-tile-title>
            <v-list-tile-sub-title>Rut: {{usuario.rut_usuario}}</v-list-tile-sub-title>
            <v-list-tile-sub-title>Fecha de Nacimiento: {{usuario.fecha_nac}}</v-list-tile-sub-title>
            <v-list-tile-sub-title>Domicilio: {{usuario.domicilio_usuario}}</v-list-tile-sub-title>
            <v-list-tile-sub-title>Numero de teléfono: {{usuario.telefono}}</v-list-tile-sub-title>
          </v-list-tile-content>
        </v-list-tile>
        <br>
        <v-list-tile avatar>
          <v-list-tile-content>
            <v-list-tile-title>Datos Usuario:</v-list-tile-title>
            <v-list-tile-sub-title>Nombre de Usuario: {{usuario.alias}}</v-list-tile-sub-title>
            <v-list-tile-sub-title>Tipo de Usuario: {{usuario.tipo_usuario}}</v-list-tile-sub-title>
            <v-list-tile-sub-title>Correo Electrónico: {{usuario.email}}</v-list-tile-sub-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
      <v-divider></v-divider>
      <v-subheader>Servicios publicados</v-subheader>
      <v-flex mb-5 ml-5>
        <v-list dense three-line subheader>
          <v-list-tile avatar v-for="item in servicios" :key="item.id">
            <v-list-tile-content>
              <v-list-tile-title>Nombre: {{item.nombre_servicio}}</v-list-tile-title>
              <v-list-tile-sub-title>Descripción: {{item.descripcion_servicio}}</v-list-tile-sub-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-flex>
    </v-card>
    <v-footer dark height="auto" color="blue">
      <v-card flat tile class="indigo lighten-1 white--text text-xs-center" width="100%">
        <v-card-text>
          <!--  <v-btn v-for="icon in icons" :key="icon" class="mx-3 white--text" icon>
          <v-icon size="24px">{{ icon }}</v-icon>
          </v-btn>-->
        </v-card-text>

        <v-card-text class="white--text pt-0"></v-card-text>

        <v-divider></v-divider>

        <v-card-text class="white--text">
          ***************************************************************************************************************************************&copy;2018 —
          <strong>Venta de Servicios *********************************************************************************************************************************</strong>
        </v-card-text>
      </v-card>
    </v-footer>
  </v-layout>
</template>

<script>
export default {
  created() {
    this.initialize();
  },
  data: () => ({
    usuario: {},
    usuarios: [],
    servicios: [],
    headers: []
  }),
  methods: {
    initialize() {
      this.cargarUsuarios();
      this.cargarServicios();
      this.auth();
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
    redirect(link) {
      this.$router.push(link);
    },
    auth() {
      var url = "/auth";
      axios
        .post(url)
        .then(response => {
          this.usuario = response.data;
          console.log("todo bien", response);
        })
        .catch(error => {
          console.log(error);
        });
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
    }
  }
};
</script>

