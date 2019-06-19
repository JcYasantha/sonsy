export default class Gate{
    constructor(user){
        this.user=user;
    }

    isAdmin(){
        return this.user.type ==='Admin';
    }

    isAccountant(){
        return this.user.type ==='Accountant';
    }

    isCashier(){
        return this.user.type ==='Cashier';
    }

    isStockKeeper(){
        return this.user.type ==='StockKeeper';
    }
    isAdminOrKeeper(){
        if(this.user.type ==='Admin' || this.user.type ==='StockKeeper'){
            return true;
        }
    }

}
