<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'

defineProps({
  canResetPassword: Boolean,
  status: String,
})

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  })
}
</script>

<template>
  <Head title="Login" />
  <main class="d-flex w-100">
    <div class="container d-flex flex-column">
      <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
          <div class="d-table-cell align-middle">

            <div class="text-center mt-4">
              <h1 class="h2">Welcome back!</h1>
              <p class="lead">Sign in to your account to continue</p>
            </div>

            <div class="card">
              <div class="card-body">
                <div class="m-sm-3">
                  <form @submit.prevent="submit">
                    <div class="mb-3">
                      <label class="form-label">Email</label>
                      <input
                        v-model="form.email"
                        class="form-control form-control-lg"
                        type="email"
                        name="email"
                        required
                        placeholder="Enter your email"
                        autofocus
                      />
                      <div v-if="form.errors.email" class="text-danger mt-1">
                        {{ form.errors.email }}
                      </div>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Password</label>
                      <input
                        v-model="form.password"
                        class="form-control form-control-lg"
                        type="password"
                        name="password"
                        required
                        placeholder="Enter your password"
                        autocomplete="current-password"
                      />
                      <div v-if="form.errors.password" class="text-danger mt-1">
                        {{ form.errors.password }}
                      </div>
                    </div>

                    <div class="form-check mb-3">
                      <input
                        v-model="form.remember"
                        type="checkbox"
                        class="form-check-input"
                        id="remember"
                      />
                      <label class="form-check-label" for="remember">
                        Remember me
                      </label>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                      <button
                        type="submit"
                        class="btn btn-lg btn-primary"
                        :disabled="form.processing"
                      >
                        Log in
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="text-center mt-3">
              <Link href="/register">Don't have an account? Sign up</Link>
              <br />
              <Link v-if="canResetPassword" :href="route('password.request')">
                Forgot your password?
              </Link>
            </div>

          </div>
        </div>
      </div>
    </div>
  </main>
</template>
