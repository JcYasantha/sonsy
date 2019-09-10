<template>
    <div class="container">
        <div class="row" v-if="$gate.isAdminOrKeeper()">
        <div class="col-md-12">
        <h3 class="card-title">Stock Items</h3>
          <div class="card">
            <div class="card-header">
              <div class="card-tools">
                  <router-link to="/addStock"><button class="btn btn-success" id="btn-add">Add Item</button></router-link>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Item Name</th>
                  <th>Unit Price</th>
                  <th>Quantity</th>
                  <th>Selling Price</th>
                  <th v-if="$gate.isAdmin()">Modify</th>
                </tr>
                <tr v-for="stock in stocks" :key="stock.ItemNo">
                  <td>{{stock.id}}</td>
                  <td>{{stock.ItemName}}</td>
                  <td>{{stock.UnitPrice}}</td>
                  <td>{{stock.Quantity}}</td>
                  <td>{{stock.SellingPrice}}</td>
                  <td v-if="$gate.isAdmin()">
                      <!--<router-link to="/editStock">Edit</router-link>-->
                      <a href="#" @click="editModal(stock)" data-toggle="modal" data-target="#editIt">Edit</a> <b>|</b>
                      <a href="#" id="del" @click="deleteStock(stock.id)">Delete</a>
                  </td>
                </tr>
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <div v-if="!$gate.isAdminOrKeeper()">
          <not-found></not-found>
      </div>
      <!-- Modal -->
        <div class="modal fade" id="editIt" tabindex="-1" role="dialog" aria-labelledby="EditItTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="EditItTitle">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form @submit.prevent="UpdateItem" id="editForm">
                    <div class="form-row">
                      <div class="form-group col-md-4">
                          <label>Item Name</label>
                          <input v-model="form.ItemName" type="text" name="ItemName"
                              placeholder="Enter Item Name"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('ItemName') }">
                          <has-error :form="form" field="ItemName"></has-error>
                      </div>
                      <div class="form-group col-md-4">
                          <label>Quantity</label>
                          <input v-model="form.Quantity" type="number" name="Quantity"
                              placeholder="Enter Quantity"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('Quantity') }">
                          <has-error :form="form" field="Quantity"></has-error>
                      </div>
                      <div class="form-group col-md-4">
                          <label>Unit Price</label>
                          <input v-model="form.UnitPrice" type="number" name="UnitPrice"
                              placeholder="Enter UnitPrice"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('UnitPrice') }">
                          <has-error :form="form" field="UnitPrice"></has-error>
                      </div>
                      <div class="form-group col-md-6">
                          <label>Supplier Id</label>
                          <input v-model="form.SupplierId" type="text" name="SupplierId"
                              placeholder="Enter SupplierId"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('SupplierId') }">
                          <has-error :form="form" field="SupplierId"></has-error>
                      </div>
                      <div class="form-group col-md-6">
                          <label>Invoice No</label>
                          <input v-model="form.InvoiceNo" type="text" name="InvoiceNo"
                              placeholder="Enter InvoiceNo"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('InvoiceNo') }">
                          <has-error :form="form" field="InvoiceNo"></has-error>
                      </div>
                      <div class="form-group col-md-12">
                          <label>Selling Price</label>
                          <input v-model="form.SellingPrice" type="number" name="SellingPrice"
                              placeholder="Enter SellingPrice"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('SellingPrice') }"> 
                          <has-error :form="form" field="SellingPrice"></has-error>
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
              stocks:{

              },
                form:new Form({
                    id:'',
                    ItemName:'',
                    UnitPrice:'',
                    SupplierId:'',
                    InvoiceNo:'',
                    Quantity:'',
                    SellingPrice:'',

                })
            }
        },
        methods:{
                UpdateItem(){
                  //this.$Progress.start();
                  //console.log("Editing data");
                  this.form.put('api/stocks/'+this.form.id)
                  .then(() => {
                    $('#editIt').modal('hide');
                    Swal.fire(
                              'Updated!',
                              'Item has been updated',
                              'success'
                            )
                            //this.$Progress.finish();
                            Fire.$emit('afterDelete');
                  })
                  .catch(() => {
                   // this.$Progress.fail();
                  });
                },
                editModal(stock){
                  this.form.fill(stock);
                },
                deleteStock(id){
                    //this.form.delete('api/stocks/'+id);
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
                          this.form.delete('api/stocks/'+id).then(()=>{    
                            Swal.fire(
                              'Deleted!',
                              'Your file has been deleted.',
                              'success'
                            )
                            Fire.$emit('afterDelete');
                          //}
                        }).catch(()=>{
                            Swal("Failed!","Something went wrong", "warning");
                        });
                      }
                    })
                },
                loadStock(){
                  if(this.$gate.isAdminOrKeeper()){
                    axios.get("api/stocks").then(({ data }) => this.stocks = data.data);
                  }
                },
                addItem(){
                    this.form.post('api/stock')
                },
                // ItemsLow(){
                //    axios.get("api/lowI").then(({data}) => {this.lowI = data.data});
                //    console.log(lowI.Quantity)
                // }
        },
        created() {
            this.loadStock();
            Fire.$on('afterDelete',()=>{
                this.loadStock();
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
    #btn-add{
        float: right;
    }
</style>
