<template>
  <v-parallax src="https://cdn.vuetifyjs.com/images/parallax/material.jpg" height="100vh">
    <router-view 
      v-on:authenticated="setAuthenticated" 
      v-on:logout="logout"
      >
    </router-view>
  </v-parallax>
</template>

<script>
export default {
  name: "App",
  data() {
    return {
      type: "guest"
    };
  },
  methods: {
    setAuthenticated() {
      var url = "/auth";
      axios
        .post(url)
        .then(response => {
          console.log(response);
          if (response.data != null) {
            this.type = response.data.tipo_usuario;
            this.$router.push({
              path: "/",
              query: { type: this.type }
            });
          } else {
            console.log(response);
            this.$router.push({
              name: "login"
            });
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    logout() {
      var url = "/logout";
      axios
        .post(url, {})
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
      this.type = "guest";
      this.$router.push({
        path: "/",
        query: { type: this.type }
      });
    }
  }
};
</script>
