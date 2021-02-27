import {Company} from "@/modules/companies/types/Company";
import axios from "axios";
import {useFilters} from "@/modules/companies/use/useFilters";
import {useCompany} from "@/modules/companies/use/useCompany";

export const api = {
    async getCompanies(): Promise<Company[]> {
        const {filters, orderBy, order, limit, offset} = useFilters();
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
    async createCompany(): Promise<Company> {
        const {company} = useCompany();
        const response = await axios.post(process.env.VUE_APP_ERP_URL + '/api/company', {
            id: company.value.id,
            name: company.value.name,
            state: company.value.state,
            address: company.value.address,
            phone: company.value.phone,
        });
        return new Promise(resolve => {
            resolve(response.data);
        });
    },
    async updateCompany(): Promise<Company> {
        const {company} = useCompany();
        const response = await axios.put(process.env.VUE_APP_ERP_URL + '/api/company/' + company.value.id, {
            name: company.value.name,
            state: company.value.state,
            address: company.value.address,
            phone: company.value.phone,
            logo: 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fvuejs.org%2F&psig=AOvVaw2iwaicA5-fgsHJgOFWwde7&ust=1613311099724000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCPik6qyC5-4CFQAAAAAdAAAAABAD'
        });
        return new Promise(resolve => {
            resolve(response.data);
        });
    },
    async findCompany(id: string): Promise<Company> {
        const response = await axios.get(process.env.VUE_APP_ERP_URL + '/api/company/' + id);
        return new Promise(resolve => {
            resolve(response.data);
        });
    }
};
