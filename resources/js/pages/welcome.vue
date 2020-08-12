<template>
  <section class="login">
    <div class="row">
      <div class="col-lg-8 m-auto">
        <!-- <card :title="$t('login')" class="card-login"> -->
        <card class="card-login">
          <form @submit.prevent="login" @keydown="form.onKeydown($event)">
            <div class="form-group row justify-content-center mt-4">
              <div class="col-md-12">
                <img src="/img/logo_dark2.png" alt="" width="123" height="100">
              </div>
            </div>
            <!-- Email -->
            <div class="form-group row justify-content-center">
              <!-- <label class="col-md-3 col-form-label text-md-right">{{ $t('email') }}</label> -->
              <span class="mdi mdi-account iconos"></span>
              <div class="col-md-7">
                <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }"
                 class="form-control texto" type="email" name="email" autocomplete="off">
                <has-error :form="form" field="email" />
              </div>
            </div>

            <!-- Password -->
            <div class="form-group row justify-content-center">
              <!-- <label class="col-md-3 col-form-label text-md-right">{{ $t('password') }}</label> -->
              <span class="mdi mdi-shield-key-outline iconos"></span>
              <div class="col-md-7">
                <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }"
                class="form-control texto" type="password" name="password" autocomplete="off">
                <has-error :form="form" field="password" />
              </div>
            </div>

            <!-- Remember Me -->
            <div class="form-group row">
              <div class="col-md-3" />
              <div class="col-md-7 d-flex">
                <!-- <checkbox v-model="remember" name="remember">
                  {{ $t('remember_me') }}
                </checkbox> -->
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-7 offset-md-3">
                <!-- Submit Button -->
                <v-button :loading="form.busy">
                  {{ $t('login') }}
                </v-button>

                <!-- GitHub Login Button -->
                <!-- <login-with-github /> -->
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-md-12">
                <router-link :to="{ name: 'password.request' }" class="small ml-auto my-auto">
                  {{ $t('forgot_password') }}
                </router-link>
              </div>
            </div> -->
          </form>
        </card>
      </div>
    </div>
  </section>
</template>

<script>
import Form from 'vform'
import LoginWithGithub from '~/components/LoginWithGithub'

export default {
  middleware: 'guest',

  components: {
    LoginWithGithub
  },

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/login')
      if (data.mensaje) {
        this.$Helper.notificacion('warning','Usuario Inactivo',data.mensaje)
        return
      }
      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')
      this.$store.dispatch('menu/fetchMenu')

      // Redirect home.
      this.$router.push({ name: 'dashboard.principal' })
    }
  }
}
</script>
<style lang="scss" scoped>
.login{
  body{
    background-color: midnightblue;
    // background:url('/img/fondo_login.png') no-repeat center fixed;
  }
  // background:url('/img/fondo_login.png') no-repeat center fixed;
  .iconos{
    color: white;
  }
  .texto{
    font-size: 13px;
    background: content-box;
    color: whitesmoke;
  }
  .card-login{
    // background-color: #05052bab;
    background-color: midnightblue;
    border: none;
    width: 309px;
    text-align: center;
    border-radius: 7px;
    height: 379px;
    margin: auto;
    margin-top: 97px;
  }
}
</style>
