<template>
  <div class="fluid">
    <div class="row justify-content-center" v-if="$gate.isAdmin()">
      <div class="col-md-12">
        <div class="card-deck">
          <div class="card bg-primary">
            <div class="card-body text-white">
              <div class="inner">
                <h3>{{totalCustomers}}</h3>
                <!--For modern browsers-->

                <i class="material-icons float-right">person</i>
                <p>Total Customers</p>
              </div>
            </div>
          </div>
          <div class="card bg-success">
            <div class="card-body text-white">
              <div class="inner">
                <h3>{{totalEmployees}}</h3>
                <i class="material-icons float-right">person_outline</i>
                <p>Total Employees</p>
              </div>
            </div>
          </div>
          <div class="card bg-secondary">
            <div class="card-body text-white">
              <div class="inner">
                <h3>{{totalOrders}}</h3>
                <i class="material-icons float-right">account_balance</i>
                <p>Total Orders In this month</p>
                <!--For modern browsers-->
              </div>
            </div>
          </div>
          <div class="card bg-danger">
            <div class="card-body text-white">
              <div class="inner">
                <h3>{{totalStock}}</h3>
                <i class="material-icons float-right">bar_chart</i>
                <p>Number of Items</p>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" v-if="$gate.isAdmin()">
      <div class="col-md-12 small">
        <h4>Monthly Orders</h4>
        <line-chart :chart-data="datacollection" :height="120"></line-chart>
        <center><h5>Month</h5></center>
      </div>

      <!-- <div id="linechart_material" style="width: 900px; height: 500px"></div> -->
    </div>
    <div v-if="!$gate.isAdmin()">
          <not-dash></not-dash>
      </div>
  </div>
</template>

<script>
// google.charts.load('current', {'packages':['line']});
//       google.charts.setOnLoadCallback(drawChart);
// //import LineChart from './LineChart.js'
//    google.charts.load('current', {'packages':['line']});
//       google.charts.setOnLoadCallback(drawChart);

//     function drawChart() {

//       var data = new google.visualization.DataTable();
//       data.addColumn('number', 'Day');
//       data.addColumn('number', 'Guardians of the Galaxy');

//       data.addRows([
//         [1,  37.8],
//         [2,  30.9],
//         [3,  25.4],
//         [4,  11.7],
//         [5,  11.9],
//         [6,   8.8],
//         [7,   7.6],
//         [8,  12.3],
//         [9,  16.9],
//         [10, 12.8],
//         [11,  5.3],
//         [12,  6.6],
//         [13,  4.8],
//         [14,  4.2]
//       ]);

//       var options = {
//         chart: {
//           title: 'Box Office Earnings in First Two Weeks of Opening',
//           subtitle: 'in millions of dollars (USD)'
//         },
//         width: 900,
//         height: 500
//       };

//       var chart = new google.charts.Line(document.getElementById('linechart_material'));

//       chart.draw(data, google.charts.Line.convertOptions(options));
//     }
import LineChart from "./LineChart.js";
export default {
  components: {
    LineChart
  },
  data() {
    return {
      totalCustomers: "",
      totalOrders: "",
      totalEmployees: "",
      totalIncome: "",
      monthlyOrders: {},
      datacollection: null,
      array: null,
      totalStock:''
      
      //monthlyIncome:{},
    };
  },
  created() {
    this.getTotalCustomers();
    this.getTotalOrders();
    this.getTotalEmployees();
    this.fillData();
    this.getStocks();
    //this.getTotalIncome();
  },
  methods: {
    getTotalCustomers() {
      if(this.$gate.isAdmin()){
        axios
          .get("api/dashTotalCustomer")
          .then(({ data }) => (this.totalCustomers = data));
      }
    },
    getTotalEmployees() {
      if(this.$gate.isAdmin()){
        axios
          .get("api/dashTotalEmployees")
          .then(({ data }) => (this.totalEmployees = data));

      }
    },
    getTotalOrders() {
      if(this.$gate.isAdmin()){
        axios
          .get("api/dashTotalOrders")
          .then(({ data }) => (this.totalOrders = data));

      }
    },
    getStocks() {
      if(this.$gate.isAdmin()){

        axios
          .get("api/dashStock")
          .then(({ data }) => (this.totalStock = data));
      }
    },

    fillData() {
      let Orders;
      let value;
      let jan;
      let arrayValue = new Array();
      if(this.$gate.isAdmin()){
      axios.get("api/chart").then(response => {
        Orders = response.data;

        value = Orders.oder;
        arrayValue = Object.values(value);
        this.datacollection = {
          labels: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
          ],
          datasets: [
            {
              label: "Monthly orders",
              backgroundColor: "#FF0066",
              data: arrayValue
            }
          ]
        };
      });
      }
    }
  }
};
</script>
<style lang="css">
.small{
margin-top:6vh;
}


</style>
