import CompanyCreatorRequest from "@/modules/companies/Application/CompanyCreatorRequest";
import HttpCompanyRepository from "@/modules/companies/Infrastructure/HttpCompanyRepository";
import Company from "@/modules/companies/Domain/Company";

export default class CompanyCreator {
    repository: HttpCompanyRepository

    constructor() {
        this.repository = new HttpCompanyRepository();
    }

    __invoke(request: CompanyCreatorRequest) {
        const $Company = new Company(
            request.name,
            request.state,
            request.address,
            request.phone
        );
        //
        this.repository.save($Company);
    }
}
