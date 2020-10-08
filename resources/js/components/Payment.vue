<template>
<div class="container">
    <DashboardNavbar />
    <div class="box text-center mt-5  text-success boarder-white">
        <div>
            <h4>Before you can create post you have to pay just 1000Naira only</h4>
        </div>
        <paystack :amount="amount" :email="email" :paystackkey="paystackkey" :reference="reference" :callback="callback" :close="close" :embed="false" class="btn btn-primary border-round">
            <i class="fas fa-money-bill-alt"></i>
            Make Payment
        </paystack>
    </div>
</div>
</template>

<script>
import paystack from 'vue-paystack';
import axios from 'axios';
import DashboardNavbar from './DashboardNavbar'

export default {
    components: {
        paystack,
        DashboardNavbar
    },
    data() {
        return {
            paystackkey: "pk_test_9835b97ad73a8330f5d07a7848620af5f3c41366", //paystack public key
            email: "", // Customer email
            amount: 100000, // in kobo
            paid: true
        }
    },
    computed: {
        reference() {
            let text = "";
            let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for (let i = 0; i < 10; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }
    },
    mounted() {
        axios.get('/auth/me', {
                headers: {
                    Authorization: 'Bearer' + localStorage.getItem('token')
                }
            })
            .then(response => {

                this.User = response.data[0].original
                this.email = response.data[0].original.email
                this.posts = response.data[0].original.posts

                this.id = this.User.id
                console.log(this.User)

            })

    },
    methods: {
        callback: function (response) {
            if (response.status = "success") {

                console.log('It was suucessful')
                axios.put('auth/paid' + this.id, {
                    paid: this.paid,

                }).then(this.$router.push('/paymentsuccess'))
            } else {
                response.status = false
                console.log('Not successful')
            }

        },
        close: function () {
            console.log("Payment closed")
        }
    }
}
</script>
