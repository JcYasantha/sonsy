@component('mail::message')

<html>
<head>
</head>
<body>

<div class="card">
  <div class="card-header">
  <h2>Sonsy Trading</h2>
        <div class="form-row">
            <div class="form-group col">
                <p>{{ $data['CustomerID']}}</p>

            </div>
            <div class="form-group col">
                <p>Sonsy Trading</p>
                <p>Balangoda</p>
                <p>sonsytrading@gmail.com</p>
                <p>+94586235845</p>
            </div>
        </div>
  </div>
  <div class="card-body">
    <h2 style="align-center;">Thank for Your Payment</h2>
    <p>Your Payment</p>
    <div >
        <table class="table table-bordered">
                  <tbody><tr>
                    
                    <th>Invoice No</th>
                    <th>Value</th>
                    <th>Payment</th>
                    <th>Balance</th>
                  </tr>
                  
                  <tr>
                    
                    <td>{{ $data['InvoiceNo']}}</td>
                    <td>{{ $data['InvoiceValue']}}</td>
                    <td>{{ $data['amount']}}</td>
                    <td>{{ $data['Balance']-$data['amount']}}</td>
                  </tr>   
        </tbody></table>
      </div>
 </div>
  
  <div class="card-footer">Footer</div>
</div>

</body>
</html>

@endcomponent


<!-- <strong>Id</strong>{{ $data['CustomerID']}}
<strong>Invoice No</strong>{{ $data['InvoiceNo']}}
<strong>Invoice Value</strong>{{ $data['InvoiceValue']}}
<strong>Payment</strong>{{ $data['amount']}}
<strong>Balance</strong>{{ $data['Balance']-$data['amount']}} -->