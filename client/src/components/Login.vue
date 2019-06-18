<template>
  <v-layout row>
    <v-flex xs6 offset-xs3>
      <panel title="Login">
        <div class="pl-4 pr-4 pt-2 pb-2">
          <v-text-field
            label="Email"
            v-model="email"
            >
          </v-text-field>
          <div class="danger-alert" v-if="errorEmail" v-html="errorEmail"></div>
          <br>
          <v-text-field
            label="Password"
            v-model="password"
            type="password"
            >
          </v-text-field>
          <div class="danger-alert" v-if="errorPassword" v-html="errorPassword"></div>
          <br>
          <div class="danger-alert" v-if="errorMessage" v-html="errorMessage"></div>

          <br>
          <v-btn dark class="cyan" @click="login">Login</v-btn>

        </div>

      </panel>



    </v-flex>
  </v-layout>

</template>

<script>
import AuthenticationService from '@/services/AuthenticationService'

export default {
  data () {
    return {
      email: '',
      password: '',
      errorEmail: null,
      errorPassword:null,
      errorMessage: null,

    }
  },
  methods: {
    async login () {
      try {
        const response = await AuthenticationService.login({
          email: this.email,
          password: this.password
        })
        //console.log(response.data)
        this.$store.dispatch('setToken', response.data.api_token)
        this.$store.dispatch('setUser', response.data.user)

        this.$router.push({
          name: 'Songs'
        })

      } catch (error) {
        this.errorEmail = error.response.data.email
        this.errorPassword = error.response.data.password
        this.errorMessage = error.response.data.message
        console.log("errorEmail: " + this.errorEmail)
        console.log("errorPassword: " + this.errorPassword)
        console.log("errorMessage: " + this.errorMessage)

      }
    }
  }


}
</script>

<style scoped>
.danger-alert{
  color: red;
  background-color: white !important;
}

</style>
