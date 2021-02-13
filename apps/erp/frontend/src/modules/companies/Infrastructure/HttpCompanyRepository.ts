import HttpRepository from "@/modules/shared/Infrastructure/HttpRepository";
import Company from "@/modules/companies/Domain/Company";

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

    async matching() {
        return await super.get(process.env.VUE_APP_ERP_URL + '/api/company', {
            //...
        });
    }
}
