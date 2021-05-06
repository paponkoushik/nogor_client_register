<template>
    <div class="container">
        <div class="mt-5">
            <div class="card">
                <div class="card-header text-center">Clients</div>
                <div class="card-body">
                    <div class="alert alert-success" role="alert" v-if="alert">
                        {{alert}}
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody v-if="clients.length">
                        <tr v-for="(client,index) in clients" :key="index">
                            <td>{{ client.name.charAt(0).toUpperCase() + client.name.slice(1) }}</td>
                            <td>{{ client.email }}</td>
                            <td>{{ client.gender.charAt(0).toUpperCase() + client.gender.slice(1) }}</td>
                            <td>
                                <a :href="/client/ + client.id" class="btn btn-outline-primary">Edit</a>
                                <button class="btn btn-outline-danger" @click.prevent="deleteClient(client.id)">Delete</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AllClients",
    data() {
        return {
            clients: [],
            alert: '',
        }
    },
    created() {
        this.getClients();
    },
    methods: {
        getClients() {
            axios.get('/clients')
                .then(({data}) => {
                    this.clients = data;
                }).catch(error => {

                });
        },
        deleteClient(id) {
            axios.delete('/delete/' + id)
                .then(({data}) => {
                    this.alert = data.message;
                    setTimeout(() => {
                        this.alert = '';
                        location.reload();
                    }, 2500);
                })
                .catch(error => {
                });
        }
    }
}
</script>

<style scoped>

</style>
