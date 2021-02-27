import {Company} from "@/modules/companies/types/Company";
import axios from "axios";
import CompanySearcherRequest from "@/modules/companies/Application/Searcher/CompanySearcherRequest";

export const api = {
    async getCompanies(): Promise<Company[]> {
        const data = new CompanySearcherRequest([], 'created_at', 'desc', 10, 0)
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/company', {
            params: data
        });
        return new Promise(resolve => {
            resolve(response.data);
        });
    },
};
