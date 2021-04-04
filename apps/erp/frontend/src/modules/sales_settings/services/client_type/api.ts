import {useAuth} from "@/modules/auth/use/useAuth";
import {useClientType} from "@/modules/sales_settings/use/useClientType/useClientType";
import {ClientType} from "@/modules/sales_settings/types/ClientType";
import axios from "axios";
import {useClientTypeFilters} from "@/modules/sales_settings/use/useClientType/useClientTypeFilters";

export const api = {

    async getClientTypes(): Promise <ClientType[]> {
        const {token} = useAuth();
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token.value;
        const {filters, orderBy, order, limit, offset} = useClientTypeFilters();
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/client_types', {
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

    async createClientType(): Promise<ClientType> {
        const {user} = useAuth();
        const {clientType} = useClientType();
        const response = await axios.post(process.env.VUE_APP_ERP_URL + '/api/client_type', {
            id: clientType.value.id,
            name: clientType.value.name,
            description: clientType.value.description,
            state: clientType.value.state,
            companyId: user.value?.company.id,
        });
        return new Promise(resolve => {
            resolve(response.data);
        });
    },

    async fincClientType(id: string): Promise <ClientType> {
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/client_type/' + id);
        return new Promise(resolve => {
            resolve(response.data)
        })
    },

    async getClientTypeOptions(id: string): Promise<string> {
        const {token} = useAuth();
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token.value;
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/client_type/options/' + id);
        return new Promise(resolve => {
            resolve(response.data);
        });
    },

    async getClientTypeStates(id: string): Promise<string> {
        const {token} = useAuth();
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token.value;
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/client_type/states/' + id);
        return new Promise(resolve => {
            resolve(response.data);
        });
    },

    async updateClientType(): Promise<ClientType> {
        const {clientType} = useClientType();
        const response = await axios.put(process.env.VUE_APP_ERP_URL + '/api/client_type/' + clientType.value.id, {
            id: clientType.value.id,
            name: clientType.value.name,
            description: clientType.value.description,
            state: clientType.value.state,
            companyId: clientType.value.companyId,
        });

        return new Promise(resolve => {
            resolve(response.data);
        });
    }
};
