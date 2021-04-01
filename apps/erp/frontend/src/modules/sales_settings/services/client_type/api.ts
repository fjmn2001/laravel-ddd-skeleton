import {useAuth} from "@/modules/auth/use/useAuth";
import {useClientType} from "@/modules/sales_settings/use/useClientType/useClientType";
import {ClientType} from "@/modules/sales_settings/types/ClientType";
import axios from "axios";

export const api = {


    async createClientType(): Promise<ClientType> {
        const {user} = useAuth();
        const {clientType} = useClientType();
        const response = await axios.post(process.env.VUE_APP_ERP_URL + '/api/client_category', {
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
};
