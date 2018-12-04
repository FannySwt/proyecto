<template>
  <router-view v-on:authenticated="setAuthenticated" v-on:logout="logout"></router-view>
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
        .post(url)
        .then(response => {
          console.log(response);
          this.type = "guest";
          this.$router.push({
            path: "/",
            name: "home",
            query: { type: this.type }
          });
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
