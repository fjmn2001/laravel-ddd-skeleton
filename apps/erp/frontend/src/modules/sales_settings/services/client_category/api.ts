import {useAuth} from "@/modules/auth/use/useAuth";
import axios from "axios";
import {ClientCategory} from "@/modules/sales_settings/types/ClientCategory";
import {useClientCategory} from "@/modules/sales_settings/use/useClientCategory/useClientCategory";
import {useItemCategoryFilters} from "@/modules/inventory_settings/use/useItemCategoryFilters";

export const api = {

    async getClientCategories(): Promise <ClientCategory[]> {
        const {token} = useAuth();
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token.value;
        const {filters, orderBy, order, limit, offset} = useItemCategoryFilters();
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/client_categories', {
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

    async createClientCategory(): Promise<ClientCategory> {
        const {user} = useAuth();
        const {clientCategory} = useClientCategory();
        const response = await axios.post(process.env.VUE_APP_ERP_URL + '/api/client_category', {
            id: clientCategory.value.id,
            name: clientCategory.value.name,
            description: clientCategory.value.description,
            state: clientCategory.value.state,
            companyId: user.value?.company.id,
        });
        return new Promise(resolve => {
            resolve(response.data);
        });
    },

    async fincClientCategory(id: string): Promise <ClientCategory> {
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/client_category/' + id);
        return new Promise(resolve => {
            resolve(response.data)
        })
    },

    async getClientCategoryOptions(id: string): Promise<string> {
        const {token} = useAuth();
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token.value;
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/client_category/options/' + id);
        return new Promise(resolve => {
            resolve(response.data);
        });
    },

    async getClientCategoryStates(id: string): Promise<string> {
        const {token} = useAuth();
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token.value;
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/client_category/states/' + id);
        return new Promise(resolve => {
            resolve(response.data);
        });
    },

    async updateClientCategory(): Promise<ClientCategory> {
        const {clientCategory} = useClientCategory();
        const response = await axios.put(process.env.VUE_APP_ERP_URL + '/api/client_category/' + clientCategory.value.id, {
            id: clientCategory.value.id,
            name: clientCategory.value.name,
            description: clientCategory.value.description,
            state: clientCategory.value.state,
            companyId: clientCategory.value.companyId,
        });

        return new Promise(resolve => {
            resolve(response.data);
        });
    },

    async updateClientCategoryState(id: string, state: string): Promise<ClientCategory> {
        const response = await axios.put(process.env.VUE_APP_ERP_URL + '/api/client_category/state/' + id, {
            id,
            state
        });
        return new Promise(resolve => {
            resolve(response.data);
        });
    },
};
