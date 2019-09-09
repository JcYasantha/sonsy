<template>
    <li class="nav-item dropdown">
        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @click="markAsRead">
        Notifications<span class="badge badge-danger">{{unreadNotifications.length}}</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <small><a class="dropdown-item" href="#" v-for="notification in allNotifications" :key="notification.data.NewInvoice.id"><strong>New Invoice </strong><br>Invoice No:{{notification.data.NewInvoice.id}} </a></small>
        </div>
      </li>
</template>

<script>
    export default {
        data(){
            return{
                allNotifications:[]
            }  
        },
        methods:{
            markAsRead(){
                axios.get('/mark-all-read/' + window.user.id).then(response =>{

                });
            }
        },
        computed:{
            unreadNotifications(){
                return this.allNotifications.filter(notification=>{
                    return notification.read_at == null;
                })
            }
        },
        mounted() {
            console.log('user',window.user)

            this.allNotifications = window.user.notifications;

            Echo.private('App.User.' + window.user.id)
            .notification((notification) => {
                console.log(notification, 'new notification Real time');
                this.allNotifications.push(notification.notification);
            });
            }
    }
</script>
