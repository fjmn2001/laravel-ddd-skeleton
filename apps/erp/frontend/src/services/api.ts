import axios from "axios";
import {TopBarOption} from "@/types/TopBarOption";
import {useAuth} from "@/modules/auth/use/useAuth";

export const api = {
    async getTopBarOptions(): Promise<TopBarOption[]> {
        const {token} = useAuth();
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token.value;
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/menu/top_menu');
        return new Promise(resolve => {
            resolve(response.data);
        });
    },
}
