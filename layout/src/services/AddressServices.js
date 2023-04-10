import axios from "axios";

export default class AddressServices {
    async getDesa() {
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