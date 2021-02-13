import axios, {AxiosInstance} from "axios";

export default class HttpRepository {
    axios: AxiosInstance;

    constructor() {
        this.axios = axios;
        this.axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token');
    }

    async post(url: string, data: object) {
        return await this.axios.post(url, data);
    }
}
