<template>
    <div class="container">
        <div class="row jutify-content-center">
            <div class="col-md-12">
                <div v-if="error !== null" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    <strong>{{ error }}</strong>
                </div>

                <div class="card card-default">
                    <div class="card-header">
                        <h5 class="mt-2">Register New User</h5>
                    </div>
                    <div class="card-body">
                        <form>

                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" v-model="name" required autofocus
                                        autocomplete="off" placeholder="Enter your name">
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
                                <label for="role" class="col-sm-4 col-form-label text-md-right">Role</label>
                                <div class="col-md-8">

                                    <select class="form-select" v-model="role_id">
                                        <option v-for="(role, index) in role" :value="index">
                                            {{ role.role_name }}
                                        </option>
                                    </select>
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
                                <label for="password" class="col-md-4 col-form-label text-md-right">Confirm
                                    Password</label>
                                <div class="col-md-8">
                                    <input id="confirm_password" type="password" class="form-control"
                                        v-model="confirm_password" required autocomplete="off"
                                        placeholder="Enter your confirm password">
                                </div>
                            </div>


                            <div class="alert alert-danger" role="alert" v-if="this.is_Error == 1">
                                <p v-for="error of v$.$errors" :key="error.$uid">

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
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-md-12 mt-5">
                <div class="card card-default">
                    <div class="card-header">
                        <h5 class="mt-2">View Users</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID #</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <tr v-for="(user_list, index) in user_list">

                                        <th scope="row">{{ user_list.id }}</th>
                                        <td>{{ user_list.name }}</td>
                                        <td>{{ user_list.email }}</td>
                                        <td><button type="button" class="btn btn-secondary mx-2" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"
                                                v-on:click="getUserEditData(user_list.id)">Edit</button>
                                            <button type="button" class="btn btn-danger"
                                                v-on:click="deleteUser(user_list.id)">Delete</button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>

            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" v-model="edit_name" required
                                        autofocus autocomplete="off" placeholder="Enter your name">
                                </div>
                            </div>


                            <div class="form-group row mt-1">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control" v-model="edit_email" required
                                        autofocus autocomplete="off" placeholder="Enter your email">
                                </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label for="role" class="col-sm-4 col-form-label text-md-right">Role</label>
                                <div class="col-md-8">

                                    <select class="form-select" v-model="edit_role">
                                        <option v-for="(role, index) in role" :value="index" :selected="role.id">
                                            {{ role.role_name }}
                                        </option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row mt-1">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control" v-model="edit_password"
                                        required autocomplete="off" placeholder="Enter your password">
                                </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Confirm
                                    Password</label>
                                <div class="col-md-8">
                                    <input id="confirm_password" type="password" class="form-control"
                                        v-model="confirm_password" required autocomplete="off"
                                        placeholder="Enter your confirm password">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" v-on:click="updateUser(this.edit_id)">Save
                                changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useVuelidate } from '@vuelidate/core'
import { required, helpers, email, minLength, sameAs } from "@vuelidate/validators";
import axios from 'axios';


export default {
    data() {
        return {
            name: "",
            email: "",
            role_id: '',
            password: "",
            confirm_password: "",
            error: null,
            v$: useVuelidate(),
            is_Error: 0,
            role: [],
            user_list: [],
            edit_name: "",
            edit_email: "",
            edit_role: "",
            edit_id: "",
        }
    },
    validations: {
        name: {
            required: helpers.withMessage("Name cannot be empty", required)
        },
        email: {
            required: helpers.withMessage("Email cannot be empty", required),
            email: helpers.withMessage("Email is invalid", email)
        },

        password: {
            required: helpers.withMessage("Password cannot be empty", required),
            minLength: helpers.withMessage("Password has to have a minimum of 8 characters", minLength(8))
        },

        // confirm_password: {
        //     required: helpers.withMessage("Confirm Password cannot be empty", required),
        //     sameAs: sameAs(state.password.password)
        // }
    },
    mounted() {
        axios.get('api/role/index', {
        })
            .then(response => {
                this.role = Array.from(response.data)
                console.log(this.role);
            });

        axios.get('api/user/index', {
        })
            .then(response => {
                this.user_list = this.user_list.concat(response.data)

            });
    },
    methods: {
        handleSubmit(e) {
            this.is_Error = 0;

            e.preventDefault()
            this.v$.$validate();
            if (!this.v$.$error) {
                if (this.password === this.confirm_password) {

                    this.$axios.post('api/register', {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        role_id: this.role_id,
                        confirm_password: this.confirm_password
                    })
                        .then(response => {
                            if (response.data.success) {
                                alert("Account Created");
                                location.reload();

                            } else {
                                this.error = response.data.message
                            }
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                } else alert("Password does not match");
            } else if (this.v$.$error) this.is_Error = 1;

        },
        getUserEditData(id) {
            this.$axios.get('api/user/edit', {
                params: {
                    id: id
                }
            })
                .then(response => {
                    this.edit_name = response.data.name;
                    this.edit_email = response.data.email;
                    this.edit_role = response.data.role;
                    this.edit_id = response.data.id;

                })
                .catch(function (error) {
                    console.error(error);
                })
        },
        updateUser(id) {
            if (this.edit_password === this.confirm_password) {
                this.$axios.post('api/user/update', {
                    id: id,
                    name: this.edit_name,
                    email: this.edit_email,
                    password: this.edit_password,
                    role_id: this.edit_role,
                    confirm_password: this.confirm_password
                })
                    .then(response => {
                        if (response.data.success) {
                            alert("Account Edited");
                            location.reload();

                        } else {
                            this.error = response.data.message
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    })
            } else alert("Password does not match");
        },
        deleteUser(id) {
            this.$axios.get('api/user/delete', {
                params: {
                    id: id
                }
            })
                .then(response => {

                    alert("Account Deleted");
                    location.reload();

                })
                .catch(function (error) {
                    console.error(error);
                })
        }

    },
}
</script>
