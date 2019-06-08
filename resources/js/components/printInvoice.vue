<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h3 style="text-align: center;">SONSY TRADING</h3>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                InvoiceNo:{},
                form:new Form({
            
                }),
            }      
        },
        method:{
            invoiceLastId(){
                axios.get("api/invoiceget").then(({data}) => (this.InvoiceNo = data));
            },
            customerInfo(){
                this.form.check('api/customer/'+this.form.id)
                  .then(() => {
                    
                  })
                  .catch(() => {
                   // this.$Progress.fail();
                  });
            }
        },
        created() {
            this.invoiceLastId();
        }
    }
</script>
