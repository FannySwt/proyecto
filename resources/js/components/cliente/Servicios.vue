<template>
  <v-container>
    <v-hover>
      <v-card slot-scope="{ hover }" class="mx-auto" color="grey lighten-4" max-width="600">
        <v-img :aspect-ratio="16/9" src="https://cdn.vuetifyjs.com/images/cards/kitchen.png">
          <v-expand-transition>
            <div
              v-if="hover"
              class="d-flex transition-fast-in-fast-out orange darken-2 v-card--reveal display-3 white--text"
              style="height: 100%;"
            >${{servicio.precio_servicio}}</div>
          </v-expand-transition>
        </v-img>
        <v-card-text class="pt-4" style="position: relative;">
          <div class="font-weight-light grey--text title mb-2">{{servicio.tags_servicio}}</div>
          <h3 class="display-1 font-weight-light orange--text mb-2">{{servicio.nombre_servicio}}</h3>
          <div class="font-weight-light title mb-2">
            {{servicio.descripcion_servicio}}
            <br>
            <br>
            Medios de Pago: {{servicio.tipo_pago}}
            <br>
            <br>
            Ubicación: {{servicio.ubicacion}}
            <br>
            <v-divider></v-divider>
            <v-layout>
              <h5
                class="display-5 font-weight-light mb-2"
              >Disponible: {{servicio.fecha_publicacion_se}} - {{servicio.fecha_finalizacion_se}}</h5>
              <br>
              <br>
              <v-spacer></v-spacer>
              <v-icon small class="mr-2" @click="$emit('editar',servicio)">edit</v-icon>
              <v-icon class="mr-3" small @click="$emit('eliminar',servicio)">delete</v-icon>
            </v-layout>
            <v-layout class="ml-3" justify-start row fill-height>
              <v-icon>thumb_up_alt</v-icon>
              {{servicio.me_gusta}}
              <v-icon class="ml-5">thumb_down_alt</v-icon>
              {{servicio.no_me_gusta}}
            </v-layout>
          </div>
        </v-card-text>
      </v-card>
    </v-hover>

    <v-dialog v-model="dialog2" width="50%">
      <v-card width="100%">
        <v-toolbar dark color="primary">
          <v-icon>person</v-icon>
          <v-toolbar-title>{{perfil_usuario.nombre_usuario}}</v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
        <v-list three-line subheader>
          <v-subheader></v-subheader>
          <v-list-tile avatar>
            <v-list-tile-content>
              <v-list-tile-title>Datos Personales:</v-list-tile-title>
              <v-list-tile-sub-title>Rut: {{perfil_usuario.rut_usuario}}</v-list-tile-sub-title>
              <v-list-tile-sub-title>Fecha de Nacimiento: {{perfil_usuario.fecha_nac}}</v-list-tile-sub-title>
              <v-list-tile-sub-title>Domicilio: {{perfil_usuario.domicilio_usuario}}</v-list-tile-sub-title>
              <v-list-tile-sub-title>Numero de teléfono: {{perfil_usuario.telefono}}</v-list-tile-sub-title>
            </v-list-tile-content>
          </v-list-tile>
          <br>
          <v-list-tile avatar>
            <v-list-tile-content>
              <v-list-tile-title>Datos Usuario:</v-list-tile-title>
              <v-list-tile-sub-title>Nombre de Usuario: {{perfil_usuario.alias}}</v-list-tile-sub-title>
              <v-list-tile-sub-title>Tipo de Usuario: {{perfil_usuario.tipo_usuario}}</v-list-tile-sub-title>
              <v-list-tile-sub-title>Correo Electrónico: {{perfil_usuario.email}}</v-list-tile-sub-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
        <v-divider></v-divider>
        <v-list three-line subheader>
          <v-subheader>Servicios publicados</v-subheader>
          <v-flex mb-5 ml-5>
            <v-list dense three-line subheader>
              <v-list-tile avatar v-for="item in serviciosUsuario" :key="item.id">
                <v-list-tile-content>
                  <v-list-tile-title>Nombre: {{item.nombre_servicio}}</v-list-tile-title>
                  <v-list-tile-sub-title>Descripción: {{item.descripcion_servicio}}</v-list-tile-sub-title>
                </v-list-tile-content>
              </v-list-tile>
            </v-list>
          </v-flex>

          <v-list-tile avatar>
            <v-list-tile-action></v-list-tile-action>
            <v-list-tile-content></v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-card>
      <v-footer dark height="auto">
        <v-card flat tile class="indigo lighten-1 whitetext text-xs-center">
          <v-card-text>
            <!-- <v-btn v-for="icon in icons" :key="icon" class="mx-3 whitetext" icon>
          <v-icon size="24px">{{ icon }}</v-icon>
            </v-btn>-->
          </v-card-text>

          <v-card-text
            class="whitetext pt-0"
          >******************** Copyright © 1999-2018 - Venta de Servicios Chile Ltda - Trabaja con nosotros - Términos y condiciones - Políticas de privacidad - Ayuda. ********************</v-card-text>

          <v-divider></v-divider>

          <v-card-text class="white--text">
            &copy;2018 —
            <strong>Venta de Servicios</strong>
          </v-card-text>
        </v-card>
      </v-footer>
    </v-dialog>
  </v-container>
</template>
<style>
.v-card--reveal {
  align-items: center;
  bottom: 0;
  justify-content: center;
  opacity: 0.5;
  position: absolute;
  width: 100%;
}
</style>

<script>
export default {
  data: () => ({
    rating: 0
  }),
  props: {
    servicio: {}
  },
  watch: {
    servicio: function(val) {
      this.rating = val.reputacion;
    },
    rating: function(val) {
      this.servicio.reputacion = val;
      console.log(this.servicio);
    }
  }
};
</script>