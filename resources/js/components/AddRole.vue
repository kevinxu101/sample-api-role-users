<template>
    <div class="container">
        <div class="row jutify-content-center">
            <div class="col-md-12">


                <div class="card card-default">
                    <div class="card-header">
                        <h5>Add New Role</h5>
                    </div>
                    <div class="card-body">
                        <form>

                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label text-md-right">Role Name</label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" v-model="role_name" required
                                        autofocus autocomplete="off" placeholder="Enter role name">
                                </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label for="description"
                                    class="col-sm-4 col-form-label text-md-right">Description</label>
                                <div class="col-md-8">
                                    <textarea id="description" type="text" class="form-control"
                                        v-model="role_description" required autofocus autocomplete="off"
                                        placeholder="Enter role description" rows="3"></textarea>
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
                                        Create Role
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
                                        <th scope="col">Role Name</th>
                                        <th scope="col">Role Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <tr v-for="(roles, index) in roles">

                                        <th scope="row">{{ roles.id }}</th>
                                        <td>{{ roles.role_name }}</td>
                                        <td>{{ roles.role_description }}</td>
                                        <td><button type="button" class="btn btn-secondary mx-2" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"
                                                v-on:click="getRoleEditData(roles.id)">Edit</button>
                                            <button type="button" class="btn btn-danger"
                                                v-on:click="deleteRole(roles.id)">Delete</button>
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
                                <label for="name" class="col-sm-4 col-form-label text-md-right">Role Name</label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" v-model="edit_role_name" required
                                        autofocus autocomplete="off" placeholder="Enter role name">
                                </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label for="description"
                                    class="col-sm-4 col-form-label text-md-right">Description</label>
                                <div class="col-md-8">
                                    <textarea id="description" type="text" class="form-control"
                                        v-model="edit_role_description" required autofocus autocomplete="off"
                                        placeholder="Enter role description" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" v-on:click="updateRole(this.edit_id)">Save
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


export default {
    data() {
        return {
            role_name: "",
            role_description: "",
            edit_role_name: "",
            edit_role_description: "",
            edit_id: "",
            v$: useVuelidate(),
            is_Error: 0,
            roles: []
        }
    },
    validations: {

        role_name: {
            required: helpers.withMessage("Role name cannot be empty", required)
        },
        role_description: {
            required: helpers.withMessage("Role Description cannot be empty", required)
        }


    },
    mounted() {
        axios.get('index', {
        })
            .then(response => {
                this.roles = this.roles.concat(response.data)
                console.log(this.roles);

            });
    },
    methods: {
        handleSubmit(e) {
            this.is_Error = 0;

            e.preventDefault()
            this.v$.$validate();
            this.$axios.post('add', {
                role_name: this.role_name,
                role_description: this.role_description,
            })
                .then(response => {
                    if (response.data.success) {
                        alert("Role Created");
                    } else {
                        this.error = response.data.message
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        getRoleEditData(id) {
            this.$axios.get('edit', {
                params: {
                    id: id
                }
            })
                .then(response => {
                    this.edit_role_name = response.data.role_name;
                    this.edit_role_description = response.data.role_description;
                    this.edit_id = response.data.id;
                })
                .catch(function (error) {
                    console.error(error);
                })
        },
        updateRole(id) {
            if (this.edit_password === this.confirm_password) {
                this.$axios.post('update', {
                    id: id,
                    edit_role_name: this.edit_role_name,
                    edit_role_description: this.edit_role_description,

                })
                    .then(response => {
                        if (response.data.success) {
                            alert("Role Edited");
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
        deleteRole(id) {
            this.$axios.get('delete', {
                params: {
                    id: id
                }
            })
                .then(response => {

                    alert("Role Deleted");
                    location.reload();

                })
                .catch(function (error) {
                    console.error(error);
                })
        }
    },


}
</script>
