<template>
    <div class="container">
        <div class="row" v-if="$gate.isAdmin()">
        <div class="col-md-12">
        <h3 class="card-title">Users</h3>
          <div class="card">
            <div class="card-header">
              <div class="card-tools">
                  <button class="btn btn-primary" id="btn-add" data-toggle="modal" data-target="#addUsers">Add Users</button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive no-padding">
              <table class="table">
                <tbody><tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Type</th>
                  <th></th>
                </tr>
                <tr v-for="user in users" :key="user.id">
                  <td>{{user.id}}</td>
                  <td>{{user.name}}</td>
                  <td>{{user.email}}</td>
                  <td>{{user.type}}</td>
                  <td>
                        <!-- <a href="#" id="del" @click="deleteStock(stock.id)"><i class="material-icons icon">delete</i></a> -->
                        <button type="submit" class="btn-sm btn-danger" @click="deleteUser(user.id)">Delete</button>
                  </td>
                </tr>
              </tbody></table>
            </div>
          </div>
        </div>
      </div>
      <div v-if="!$gate.isAdmin()">
          <not-found></not-found>
      </div>
      <!-- Modal -->
        <div class="modal fade" id="addUsers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="adduser" id="editForm">
                    <div class="form-row">
                      <div class="form-group col-md-12">
                          <label>Name</label>
                          <input v-model="form.name" type="text" name="name"
                              placeholder="Name"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                          <has-error :form="form" field="name"></has-error>
                      </div>
                      <div class="form-group col-md-12">
                          <label>Email</label>
                          <input v-model="form.email" type="email" name="email"
                              placeholder="Email"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                          <has-error :form="form" field="email"></has-error>
                      </div>
                      <div class="form-group col-md-12">
                          <label for="type">Type</label>
                            <select id="type" v-model="form.type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                <option selected value="">Choose...</option>
                                <option value="Admin">Admin</option>
                                <option value="StockKeeper">Stock Keeper</option>
                                <option value="Accountant">Accountant</option>
                                <option value="Cashier">Cashier</option>
                            </select>
                            <has-error :form="form" field="type"></has-error>
                      </div>
                      
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Save changes</button>
                  </div>
              </form>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                users:{},
                form:new Form({
                    id:'',
                    name:'',
                    email:'',
                    type:'',
                    
                })
            }
        },
        methods:{
                adduser(){
                    //this.form.post('api/addusers');
                    this.form.post('api/addusers')
                    .then(()=>{
                        $('#addUsers').modal('hide');
                        Swal.fire(
                                'Added!',
                                'New user Added',
                                'success'
                                )
                        Fire.$emit('afterAdded');
                    })
                    .catch(()=>{
                        
                    })
                },
                deleteUser(id){
                    Swal.fire({
                      title: 'Are you sure?',
                      text: "You won't be able to revert this!",
                      type: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                      if (result.value) {
                          this.form.delete('api/users/'+id).then(()=>{    
                            Swal.fire(
                              'Deleted!',
                              'User has been deleted.',
                              'success'
                            )
                            Fire.$emit('afterAdded');
                          //}
                        }).catch(()=>{
                            Swal("Failed!","Something went wrong", "warning");
                        });
                      }
                    })
                },
                loadUsers(){
                    if(this.$gate.isAdmin()){
                        axios.get("api/users").then(({ data }) => this.users = data);
                    }
                },
        },
        created() {
            this.loadUsers();
            Fire.$on('afterAdded',()=>{
                this.loadUsers();
            });
        }
    }
</script>
<style>
    #del{
        color: crimson;
    }
    #del:hover{
      background-color: crimson;
      color: beige;
      transition: 5ms;
    }
  
</style>
