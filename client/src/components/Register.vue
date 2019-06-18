<template>
  <v-layout row>
    <v-flex xs6 offset-xs3>
      <panel title="Register">
        <div class="pl-4 pr-4 pt-2 pb-2">
          <form
          name="tab-tracker-form"
          autocomplete="off">
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
              autocomplete="new-password"
              >
            </v-text-field>
            <div class="danger-alert" v-if="errorPassword" v-html="errorPassword"></div>
            <br>
            <div class="danger-alert" v-if="errorMessage" v-html="errorMessage"></div>
            <br>
            <v-btn dark class="cyan" @click="register">Register</v-btn>
            </form>

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
      //error: null
      errorEmail: null,
      errorPassword: null,
      errorMessage: null

    }
  },
  methods: {
    async register () {
      try {
        const response = await AuthenticationService.register({
          email: this.email,
          password: this.password
        })

        this.$store.dispatch('setToken', response.data.api_token)
        this.$store.dispatch('setUser', response.data.user)

        this.$router.push({
          name: 'Songs'
        })
      } catch (error) {
        this.errorMessage = error.response.data.message
        this.errorEmail = error.response.data.errors.email[0]
        this.errorPassword = error.response.data.errors.password[0]
        console.log(error.response.data.errors.email[0])
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
