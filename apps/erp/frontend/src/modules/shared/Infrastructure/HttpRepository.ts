import axios, {AxiosInstance} from "axios";

export default class HttpRepository {
    axios: AxiosInstance;

    constructor() {
        this.axios = axios;
    }

    async post(url: string, data: object) {
        this.axios.post(url, data);
    }
}
