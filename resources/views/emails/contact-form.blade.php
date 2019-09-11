<html lang="en">
<head>
<title>Sonsy Tradings Invoice</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
}

/* Style the header */
.header {
  background-color: #0086b3;
  padding: 1px;
  text-align: center;
}

/* Create three unequal columns that floats next to each other */
.column {
  float: left;
  padding: 10px;
}


/* Middle column */
.column.middle {
  width: 100%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column.side, .column.middle {
    width: 100%;
  }
}


/*Table styles*/
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

/* Style the footer */
.footer {
  background-color:  #0086b3;
  padding: 16px;
  text-align: center;
}


.sentence{
  text-align: center;
}
h1.head{
  font-size: 40px;    
}
p.address{
  text-align: left;
  font-size: 18px;
}
.header2{
  
  padding: 10px;
}
</style>
</head>
<body>

<div class="header">
  <h1 class="head">Sonsy Trading</h1>
 </div>

<div class="header2">
  <p class="address">Balangoda </p> 
  <p class="address">sonsy@gmail.com </p> 
   <p class="address">+94 71 123 4567</p> 
 
</div>


</div>

<div class="row">
  
  <div class="column middle sentence">
    <h2>Thank you for your paying</h2>
  </div>
  
</div>

<div class="row" >
  <div class="column middle" style="overflow-x:auto;">
  <table>
    <tr>
      <th>Invoice Number</th>
      <th>Invoice Value</th>
      <th>Payment</th>
      <th>Balance</th>
    </tr>
    <tr>
      <td>{{ $data['InvoiceNo']}}</td>
      <td>{{ $data['InvoiceValue']}}</td>
      <td>{{ $data['amount']}}</td>
      <td>{{ $data['Balance']-$data['amount']}}</td>
    </tr>
    
  </table>

  </div>
  
</div>

<div class="footer">
  <p>© 2019 sonsytradings.com All Rights Reserved.</p>
</div>
  
</body>
</html>