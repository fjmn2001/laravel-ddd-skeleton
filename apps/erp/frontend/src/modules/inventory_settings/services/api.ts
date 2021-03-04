import {useAuth} from "@/modules/auth/use/useAuth";
import axios from "axios";
import {ItemCategory} from "@/modules/inventory_settings/types/ItemCategory";
import {useItemCategoryFilters} from "@/modules/inventory_settings/use/useItemCategoryFilters";

export const api = {
    async getItemCategories(): Promise<ItemCategory[]> {
        const {token} = useAuth();
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token.value;
        const {filters, orderBy, order, limit, offset} = useItemCategoryFilters();
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/item_categories', {
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
