import {Item} from "@/modules/items/types/Item";
import axios from "axios";
import {useFilters} from "@/modules/items/use/useFilters";
import {useItem} from "@/modules/items/use/useItem";
import {Catalog} from "@/modules/items/types/Catalog";
import {useAuth} from "@/modules/auth/use/useAuth";

export const api = {
    async getItems(): Promise<Item[]> {
        const {filters, orderBy, order, limit, offset} = useFilters();
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/items', {
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
    async getItemsCount(): Promise<number> {
        const {token} = useAuth();
        const {filters, orderBy, order, limit, offset} = useFilters();
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token.value;
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/items/count', {
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
    async createItem(): Promise<Item> {
        const {item} = useItem();
        const response = await axios.post(process.env.VUE_APP_ERP_URL + '/api/items', {
            id: item.value.id,
            code: item.value.code,
            name: item.value.name,
            reference: item.value.reference,
            state: item.value.state,
            companyId: item.value.companyId
        });
        return new Promise(resolve => {
            resolve(response.data);
        });
    },
    async updateItem(): Promise<Item> {
        const {item} = useItem();
        const response = await axios.put(process.env.VUE_APP_ERP_URL + '/api/items/' + item.value.id, {
            code: item.value.code,
            name: item.value.name,
            reference: item.value.reference,
            state: item.value.state,
            companyId: item.value.companyId
        });
        return new Promise(resolve => {
            resolve(response.data);
        });
    },
    async findItem(id: string): Promise<Item> {
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/items/' + id);
        return new Promise(resolve => {
            resolve(response.data);
        });
    },
    async getCatalog(): Promise<Catalog> {
        const {currentCompanyId} = useAuth();
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/items/catalogs/' + currentCompanyId());
        return new Promise(resolve => {
            resolve(response.data);
        });
    },
};
