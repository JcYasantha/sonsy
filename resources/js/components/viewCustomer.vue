<template>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Customers details</h3>

            <div class="card-tools">
              <div class="input-group input-group-sm mt-1">
                <input
                  type="search"
                  class="form-control form-control-navbar"
                  @keyup="searchit"
                  v-model="query"
                  placeholder="Search"
                  aria-label="Search"
                />
                <div class="input-group-append">
                  <button class="btn btn-navbar" @click="searchit">
                    <i class="material-icons icon">search</i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <th>ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Telephone Number</th>
                  <th>NIC</th>
                  <th>City</th>
                  <th>View Indvoices and other details</th>
                </tr>

                <tr v-for="view in views.data" :key="view.id">
                  <td>{{view.id}}</td>
                  <td>{{view.Fname}}</td>
                  <td>{{view.Lname}}</td>

                  <td>{{view.No}}</td>
                  <td>{{view.NicNo}}</td>
                  <td>{{view.City}}</td>

                  <td>
                    <center>
                      <a href="#">
                        <button
                          type="button"
                          class="btn btn-primary"
                          data-toggle="modal"
                          @click="users(view.id);totalOutstanding(view.id);"
                          data-target="#viewdetails"
                        >View</button>
                      </a>
                    </center>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <div class="card-footer">
          <pagination :data="views" @pagination-change-page="getResults">
            <span slot="prev-nav">&lt; Previous</span>
            <span slot="next-nav">Next &gt;</span>
          </pagination>
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div
      class="modal fade"
      id="viewdetails"
      tabindex="-1"
      role="dialog"
      aria-labelledby="viewdetailsLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="viewdetailsLabel">Outstanding and Payments Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>Invoice No</th>
                    <th>Invoice Value</th>
                    <th>Outstanding</th>
                  </tr>
                  <tr v-for="Outstandings in viewsOutstanding" :key="Outstandings.InvoiceNo">
                    <td>{{Outstandings.InvoiceNo}}</td>
                    <td>{{Outstandings.InvoiceValue}}</td>
                    <td>{{Outstandings.Balance}}</td>
                  </tr>
                  <tr>
                    <td>
                      <b>Total Outstanding:</b>
                      <p style="float:right;">Rs.</p>
                    </td>
                    <td>
                      <b>{{total}}</b>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->

            <div></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
 <script>
export default {
  data() {
    return {
      views: {},
      viewsOutstanding: {},
      total: "",
      query:"",
    
      
    };
  },
  methods: {
    searchit(){
        let query=this.query;
        
        axios.get("api/findUser?q="+ query)
        .then((data)=>{
            this.views=data.data;
        })
        .catch(()=>{

        })
        
      },
    getResults(page = 1) {
      axios.get("api/View?page=" + page).then(response => {
        this.views = data.data;
      });
    },
    loadViewCustomer() {
      axios.get("api/View").then(({ data }) => (this.views = data));
    },
    users(id) {
      //window.alert(id);
      axios
        .get("api/ViewOutstanding/" + id)
        .then(({ data }) => (this.viewsOutstanding = data));
    },
    totalOutstanding(id) {
      axios
        .get("api/totalOutstanding/" + id)
        .then(({ data }) => (this.total = data));
    }
  },
  created() {
    this.loadViewCustomer();
  }
};
</script>