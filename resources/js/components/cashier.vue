<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdminOrCashier()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Outstandigs</h3>

                <div class="card-tools">
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Payment</th>
                  </tr>
                  
                  <tr v-for="cus in customers" :key="cus.id">
                  <td>{{cus.id}}</td>
                  <td>{{cus.Fname}} {{cus.Lname}}</td>
                  <td><button @click="customerInfo(cus.id)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#invoice">Enter</button></td>

                  </tr>
                  
                  
                 
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    
        <div class="modal fade" id="postdate" tabindex="-1" role="dialog" aria-labelledby="postdateLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="postdateLabel">Post_dated Cheque</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="postdate">
              <div class="modal-body">
                   <div class="form-group">
                  <input v-model="form.chequeNo" type="number" name="chequeNo"
                    placeholder="Cheque Number"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('chequeNo') }">
                  <has-error :form="form" field="chequeNo"></has-error>
                </div>
                 <div class="form-group">
                  <input v-model="form.Chaquedate" type="date" name="Chaquedate"
                    placeholder="Cheque Date"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('Chaquedate') }">
                  <has-error :form="form" field="Chaquedate"></has-error>
                </div>
                 <div class="form-group">
                  <input v-model="form.ChequeBalance" type="number" name="ChequeBalance"
                    placeholder="Cheque Balance"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('ChequeBalance') }">
                  <has-error :form="form" field="ChequeBalance"></has-error>
                </div>
                <div class="form-group">
                  <input v-model="form.Bank" type="text" name="Bank"
                    placeholder="Bank Name"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('Bank') }">
                  <has-error :form="form" field="Bank"></has-error>
                </div>
                <div class="form-group">
                  <input v-model="form.Branch" type="text" name="Branch"
                    placeholder="Branch Name"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('Branch') }">
                  <has-error :form="form" field="Branch"></has-error>
                </div>
                <div class="form-group">
                  <input v-model="form.CustomerID" type="number" name="CustomerID"
                    placeholder="Client Id"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('CustomerID') }">
                  <has-error :form="form" field="CustomerID"></has-error>
                </div>
                
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      <div v-if="!$gate.isAdminOrCashier()">
          <not-found></not-found>
      </div>

        <!-- Modal -->
<div class="modal fade" id="invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-hover">
                  <tbody><tr>
                    <th>Invoice No</th>
                    <th>Outstanding Amount</th>
                    <th>Payment</th>
                    <th>Balance</th>
                  </tr>
                  
                  <tr v-for="out in out" :key="out.OrderNo">
                    <td>{{out.InvoiceNo}}</td>
                    <td>Rs.{{out.InvoiceValue}}</td>
                    <td><input type="number" id="amount" min="0" class="form-control total" step=".01" v-model="out.amount"></td>
                    <td>Rs.{{out.Balance}}</td>
                  </tr>   
        </tbody></table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" @click="save()">Save</button>
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
            customers:{},
            invoices:{},
            out:{},
            out: [{
                    amount:'',
                }],
           form: new Form({
              chequeNo:'',
              ChequeDate:'',
              ChequeBalance:'',
              Branch:'',
              Bank:'',
              CustomerID:'',
              remember: false
           }),
           form2: new Form({
              CustomerID:'',
              Customername:'',
              Totaloutstanding:'',
              Payment:'',
              Setledoutstanding:'',
              remember: false
           })

          }
        },
        methods:{
          postdate(){
            this.form.post('api/postdated_cheques')
            .then(()=>{
              this.form.clear();
              $('#postdate').modal('hide');
                Swal.fire(
                              'Edited!',
                              'Your changes have been added',
                              'success'
                            )  
                //this.$Progress.finish();
                })
                .catch(()=>{
                    
                })
          },
          customerInfo(id){
            axios.get("api/loadOutstanding/"+id).then(({ data }) =>(this.out = data));
            //$("#invoice").modal()
          },
          lordcustomer(){
              axios.get("api/lordcustomer").then(({ data }) => this.customers = data.data);
          },
          save(){
            let dataI = {
                    inc: this.out
                }
                
                axios.post('api/savePayment', {dataI})
                .then( res => {
                    $('#invoice').modal('hide');
                    Swal.fire(
                              'Updated!',
                              'Item has been updated',
                              'success'
                            )
                    console.log(res)
                })
                .catch( e => {
                    console.log(e)
                })
          },

          /* loadinvoice(id){
              axios.get("api/loadinvoice/"+id).then(({ data }) =>(this.invoices = data.data));
         
          } */

        },
        created() {
            this.lordcustomer()
        }
    }
</script>