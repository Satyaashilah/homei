import axios from "axios";
const login =  "http://localhost:8000/homei/web/api/v1/auth/login";
export default class LoginServices {
    async login(username, password) {
        // var paramsStr = new URLSearchParams(params).toString();
        try {
            const response = await axios.post(login, {
                username: username,
                password: password,
            });
            return response.data;
        } catch (error) {
            throw error;
        }
    }
    // async postRegister() {

    //     // var paramsStr = new URLSearchParams(params).toString();
    //     try {
    //         await axios.post('http://localhost:8000/homei/web/api/v1/auth/register');
    //     } catch (error) {

    //     }
    // }
}