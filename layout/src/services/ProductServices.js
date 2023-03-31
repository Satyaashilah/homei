import axios from "axios";

export default class ProductServices {
    async getProduct(page) {
        try {
            return await axios.get('http://localhost:8000/homei/web/api/v1/supplier-barang/index?page='+page)
        } catch (error) {

        }
    }
}