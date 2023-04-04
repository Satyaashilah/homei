import axios from "axios";

export default class ProductServices {
    // getProduct: function () {
    //     cont url = 'http://localhost:8000/homei/web/api/v1/supplier-barang';
    //     axios.get(url, '/index').then(response => {
    //         this.product=response
    //         console.log(this.product)
    //     })
    // }
    async getProducts(params) {

        var paramsStr = new URLSearchParams(params).toString();
        try {
            return await axios.get('http://localhost:8000/homei/web/api/v1/supplier-barang/index?' + paramsStr)
        } catch (error) {

        }
    }
    async getDesa(id) {
        try {
            return await axios.get('http://localhost:8000/homei/web/api/v1/wilayah-desa/index')
        } catch (error) {

        }
    }
    async getKota() {
        try {
            return await axios.get('http://localhost:8000/homei/web/api/v1/wilayah-kota/index')
        } catch (error) {

        }
    }
    async getProvinsi() {
        try {
            return await axios.get('http://localhost:8000/homei/web/api/v1/wilayah-provinsi/index')
        } catch (error) {

        }
    }
}