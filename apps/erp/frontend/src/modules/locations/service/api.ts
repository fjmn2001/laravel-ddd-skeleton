import axios from "axios";
import {Filter} from "@/types/Filter";
import {Location} from "@/modules/locations/type/Location";

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
}
