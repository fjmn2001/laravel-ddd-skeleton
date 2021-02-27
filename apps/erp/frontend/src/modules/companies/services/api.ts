import {Company} from "@/modules/companies/types/Company";
import axios from "axios";
import {useFilters} from "@/modules/companies/use/useFilters";

const {filters, orderBy, order, limit, offset} = useFilters();

export const api = {
    async getCompanies(): Promise<Company[]> {
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/company', {
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
};
