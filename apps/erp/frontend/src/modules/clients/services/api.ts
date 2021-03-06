import {Client} from "@/modules/clients/types/Client";
import axios from "axios";
import {useFilters} from "@/modules/shared/use/useFilters";

export const api = {
    async getClients(): Promise<Client[]> {
        const {filters, orderBy, order, limit, offset} = useFilters();
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/client', {
            params: {
                filters: filters.value,
                orderBy: orderBy.value,
                order: order.value,
                limit: limit.value,
                offset: offset.value
            }
        });
        return new Promise(resolve => {
            resolve(response.data);
        });
    },
}
