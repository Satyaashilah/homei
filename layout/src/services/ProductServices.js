import axios from "axios";

export default class ProductServices {
    async getProduct() {
        try {
            return await axios.get('http://localhost:8000/homei/web/api/v1/master-material/index')
        } catch (error) {

        }
    }
}