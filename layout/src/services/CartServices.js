import axios from "axios";

export default class CartServices {
    // getProduct: function () {
    //     cont url = 'http://localhost:8000/homei/web/api/v1/supplier-barang';
    //     axios.get(url, '/index').then(response => {
    //         this.product=response
    //         console.log(this.product)
    //     })
    // }
    async getProducts() {

        // var paramsStr = new URLSearchParams(params).toString();
        try {
            return await axios.get('http://localhost:8000/homei/web/api/v1/supplier-order-cart/index');
        } catch (error) {

        }
    }
}