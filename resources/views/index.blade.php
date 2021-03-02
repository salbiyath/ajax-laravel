<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Ajax Laravel</title>

        {{-- bootstrap --}}
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
            crossorigin="anonymous"
        />

        {{-- vue --}}
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
    </head>
    <body>
        <div id="app">
            <div class="container">
                <h2>Data User</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user , index) in users">
                            <th scope="row">@{{ index }}</th>
                            <td>@{{ user.name }}</td>
                            <td>@{{ user.email }}</td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-sm btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"
                                    v-on:click="editUser(index, user)"
                                >
                                    edit
                                </button>
                                <button
                                    class="btn btn-sm btn-danger"
                                    v-on:click="deleteUser(index, user)"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                {{-- modal --}}
                <div
                    class="modal fade"
                    id="exampleModal"
                    tabindex="-1"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true"
                >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Modal title
                                </h5>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label
                                            for="name"
                                            class="form-label"
                                            >Name</label
                                        >
                                        <input
                                            type="text"
                                            name="name"
                                            class="form-control"
                                            v-model="newName"
                                            id="name"
                                            aria-describedby="name"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <label
                                            for="exampleInputEmail1"
                                            class="form-label"
                                            >Email address</label
                                        >
                                        <input
                                            type="email"
                                            v-model="newEmail"
                                            name="email"
                                            class="form-control"
                                            id="exampleInputEmail1"
                                            aria-describedby="emailHelp"
                                        />
                                    </div>
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                        v-on:click="updateUser(userId)"
                                    >
                                        Submit
                                    </button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                >
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- bootstrap --}}
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
            crossorigin="anonymous"
        ></script>

        {{-- ajax --}}
        <script>
            new Vue({
                el: "#app",
                data: {
                    users: [],
                    newName: "",
                    newEmail: "",
                    userId: "",
                },
                methods: {
                    deleteUser: function (index, user) {
                        this.$http.delete("/api/user/delete/" + user.id).then((response) => {
                                this.users.splice(index, 1);
                            });
                    },
                    editUser: function(index, user){
                        this.newName = user.name;
                        this.newEmail = user.email;
                        this.userId = user.id;

                    },
                    updateUser: function(id){
                        this.$http.put("/api/user/update/" + id, {name: this.newName, email: this.newEmail}).then((response) => {

                            });
                    }
                },
                mounted: function () {
                    // GET /someUrl
                    this.$http.get("/api/user").then((response) => {
                        let result = response.body.data;

                        this.users = result;
                        // error callback
                    });
                },
            });
        </script>
    </body>
</html>
