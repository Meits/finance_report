<template>
    <div>
        <div class="alert alert-danger" v-if="error && !success">
            <p>There was an error, unable to complete registration.</p>
        </div>
        <div class="container register_wrap">
            <form class="col s12" autocomplete="off"  v-on:submit.prevent="register" method="post">

            <div class="row">
              <h3>Registration</h3>
              <div class="alert alert-success" v-if="success">
                <p>Registration completed. You can now <router-link :to="{name:'login'}">sign in.</router-link></p>
              </div>
            </div>
      <div class="row">
                    <div class="input-field col s12">
                      <input id="name" v-model="name" type="text" class="validate">
                      <label for="name">Name</label>
                    </div>
                  </div>
      <div class="row">
              <div class="input-field col s12">
                <input id="email" v-model="email" type="email" class="validate">
                <label for="email">Email</label>
              </div>
            </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" v-model="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <input id="password_confirmation" v-model="password_confirmation" type="password" class="validate">
          <label for="password_confirmation">Password</label>
        </div>
      </div>


       <button class="btn waves-effect waves-light" type="submit" name="action">Submit
          <i class="material-icons right">send</i>
        </button>

            </form>
        </div>
  </div>
</template>

<script>
import Preloader from './parts/Preloader.vue';

export default{
  data: function () {
    return {
      error: false,
      success : false,
      email : '',
      password : '',
      name: '',
      password_confirmation: '',
    }
  },
  methods : {
    clearFields : function () {
        this.error = false;
        this.success = false;
        this.email = '';
        this.password = '';
        this.name = '';
        this.password_confirmation = '';
    },
    register : function () {
        var app = this
        this.$auth.register({
            data: {
                email: app.email,
                password: app.password,
                name : app.name,
                password_confirmation : app.password_confirmation
            },
            success: function () {
                app.success = true;
                M.toast({html: 'Registration completed.',classes: ['teal lighten-2']});
                this.clearFields();
            },
            error: function (resp) {
                app.error = true;
                app.errors = resp.response.data.errors;
            },
            redirect: null,
            url : '/api/auth/register'
        });
    }
  }
}
</script>

<style scoped>

</style>