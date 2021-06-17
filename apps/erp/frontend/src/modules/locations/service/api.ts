import axios from "axios";
import {Filter} from "@/types/Filter";
import {Location} from "@/modules/locations/type/Location";
import {useAuth} from "@/modules/auth/use/useAuth";

const {token} = useAuth();
axios.defaults.headers.common['Authorization'] = 'Bearer ' + token.value;

export const api = {
    async getLocations(
        filters: Filter[],
        orderBy: string,
        order: string,
        limit: number,
        offset: number
    ): Promise<Location[]> {
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/locations', {
            params: {filters, orderBy, order, limit, offset}
        });
        return new Promise(resolve => {
            resolve(response.data);
        });
    },
    async getLocationsCount(
        filters: Filter[],
    ): Promise<number> {
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/locations/count', {
            params: {filters}
        });
        return new Promise(resolve => {
            resolve(response.data);
        });
    },
}
