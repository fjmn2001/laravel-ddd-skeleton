import {useAuth} from "@/modules/auth/use/useAuth";
import axios from "axios";
import {ClientCategory} from "@/modules/sales_settings/types/ClientCategory";
import {useClientCategory} from "@/modules/sales_settings/use/useClientCategory/useClientCategory";

export const api = {

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
};
