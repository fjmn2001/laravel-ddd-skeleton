import CompanyCreatorRequest from "@/modules/companies/Application/CompanyCreatorRequest";
import HttpCompanyRepository from "@/modules/companies/Infrastructure/HttpCompanyRepository";
import Company from "@/modules/companies/Domain/Company";

export default class CompanyCreator {
    repository: HttpCompanyRepository

    constructor() {
        this.repository = new HttpCompanyRepository();
    }

    async __invoke(request: CompanyCreatorRequest) {
        const $Company = new Company(
            request.id,
            request.name,
            request.state,
            request.address,
            request.phone
        );
        //
        return await this.repository.save($Company);
    }
}
