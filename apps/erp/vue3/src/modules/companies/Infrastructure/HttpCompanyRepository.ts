import HttpRepository from "@/modules/shared/Infrastructure/HttpRepository";
import Company from "@/modules/companies/Domain/Company";
import CompanySearcherRequest from "@/modules/companies/Application/Searcher/CompanySearcherRequest";

export default class HttpCompanyRepository extends HttpRepository {
    async save(company: Company) {
        return await super.post(process.env.VUE_APP_ERP_URL + '/api/company', {
            id: company.id,
            name: company.name,
            state: company.state,
            address: company.address,
            phone: company.phone,
        });
    }

    async matching(request: CompanySearcherRequest) {
        return await super.get(process.env.VUE_APP_ERP_URL + '/api/company', request);
    }

    async find(id: string) {
        return await super.get(process.env.VUE_APP_ERP_URL + '/api/company/' + id, {});
    }

    async update(company: Company) {
        return await super.put(process.env.VUE_APP_ERP_URL + '/api/company/' + company.id, {
            name: company.name,
            state: company.state,
            address: company.address,
            phone: company.phone,
            logo: 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fvuejs.org%2F&psig=AOvVaw2iwaicA5-fgsHJgOFWwde7&ust=1613311099724000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCPik6qyC5-4CFQAAAAAdAAAAABAD'
        });
    }
}
