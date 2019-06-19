<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add Order</div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <select name="customer" id="customer" class="form-control">
                                            <option value="0" selected="true" disabled="true">Select the Customer</option>
                                            <option value="1">customer 1</option>
                                        </select><br><br><br>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <table class="table table-bordered" id="protable">
                                    <thead>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th style="text-align:center;"><a href="#" class="addrow" @click="addrow()"><i class="material-icons icon">add</i></a></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select name="itemname[]" id="itemname" class="form-control itemname">
                                                    <option value="0" selected="true" disabled="true" >select</option>
                                                         <option value="stock.ItemNo" v-for="stock in stocks" :key="stock.ItemNo">{{stock.ItemName}}</option>
                                                    
                                                </select>
                                            </td>
                                            <td><input type="text" name="qty[]" class="form-control qty"></td>
                                            <td><input type="text" name="amount[]" class="form-control amount"></td>
                                            <td style="text-align:center;"><a href="#" class="remove" style="color:red;" @click="remove()"><i class="material-icons icon">close</i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
                stocks : {}
            }
        },
        methods:{
            loadStock(){
                axios.get("api/stock").then(({data}) => (this.stocks = data));
            },
            addrow(){
                var tr ='<tr>'+
                    '<td>'+
                    '<select name="itemname[]" id="itemname" class="form-control itemname">'+
                    '<option value="0" selected="true" disabled="true" >select</option>'+
                    '<option value="stock.ItemNo" v-for="stock in stocks" :key="stock.ItemNo">{{stock.ItemName}}</option>'+
                    '</select>'+
                    '</td>'+
                    '<td><input type="text" name="qty[]" class="form-control qty"></td>'+
                    '<td><input type="text" name="amount[]" class="form-control amount"></td>'+
                    '<td style="text-align:center;"><a href="#" class="remove" style="color:red;" @click="remove()"><i class="material-icons icon">close</i></a></td>'+
                    '</tr>';
                $('tbody').append(tr);
            },
            remove(){
                alert('dasd');
            }
            
        },
        created() {
            this.loadStock();
        }
    }
</script>
<style>
    #del{
        color: crimson;
    }
    #btn-add{
        float: right;
    }
</style>
