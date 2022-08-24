<template>
    <div class="container">
        <div class="row jutify-content-center">
            <div class="col-md-8">
                <div v-if="error !== null" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    <strong>{{error}}</strong>
                </div>

                <div class="card card-default">
                    <div class="card-header"><h5>Register New User</h5></div>
                    <div class="card-body">
                        <form>

                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" v-model="name" required
                                           autofocus autocomplete="off"  placeholder="Enter your name">
                                </div>
                            </div>
                        

                            <div class="form-group row mt-1">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control" v-model="email" required
                                           autofocus autocomplete="off" placeholder="Enter your email">
                                </div>
                            </div>


                            <div class="form-group row mt-1">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control" v-model="password"
                                           required autocomplete="off" placeholder="Enter your password">
                                </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                <div class="col-md-8">
                                    <input id="confirm_password" type="password" class="form-control" v-model="confirm_password"
                                           required autocomplete="off" placeholder="Enter your confirm password">
                                </div>
                            </div>
                            
                            <div class="alert alert-danger" role="alert" v-if="this.is_Error == 1">
                                <p
                                v-for="error of v$.$errors"
                                :key="error.$uid"
                                >

                                <strong>{{ error.$message }}</strong>
                                </p>
                            </div>
                            <div class="form-group row mt-1 mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-success" @click="handleSubmit">
                                        Register
                                    </button>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-8 offset-md-4">
                                    <small class="text-muted">
                                        Have an account? Please
                                        <router-link to="/login" >login</router-link>
                                    </small>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
  import { useVuelidate } from '@vuelidate/core'
  import { required, helpers, email, minLength, sameAs } from "@vuelidate/validators";


    export default {
        data() {
            return {
                name: "",
                email: "",
                password: "",
                confirm_password: "",
                error: null,
                v$: useVuelidate(),
                is_Error: 0,
            }
        },
        validations: {

                name: { 
                    required: helpers.withMessage("First Name cannot be empty", required) },
                email: {
                    required: helpers.withMessage("Email cannot be empty", required),
                    email: helpers.withMessage("Email is invalid", email) },

                password: {
                    required: helpers.withMessage("Password cannot be empty", required),
                    minLength: helpers.withMessage("Password has to have a minimum of 8 characters", minLength(8)) },

                // confirm_password: {
                //     required: helpers.withMessage("Confirm Password cannot be empty", required),
                //     sameAs : sameAs(function() {return this.password}.bind(this))}
        },
        methods: {
            handleSubmit(e) {
                this.is_Error = 0;

                e.preventDefault()
                  this.v$.$validate();
                  if (!this.v$.$error) {
                    this.$axios.get('/sanctum/csrf-cookie').then(response => {
                        this.$axios.post('api/register', {
                            name: this.name,
                            email: this.email,
                            password: this.password,
                            confirm_password:this.confirm_password
                        })
                        .then(response => {
                            if (response.data.success) {
                                 window.location.href = "/login"
                            } else {
                                this.error = response.data.message
                            }
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                    })

                }else if(this.v$.$error) this.is_Error = 1;

            }
        },

        beforeRouteEnter(to, from, next) {
            if (window.Laravel.isLoggedin) {
                return next('dashboard');
            }
            next();
        }
    }
</script>
