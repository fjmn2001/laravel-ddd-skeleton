import CompanyCreatorRequest from "@/modules/companies/Application/CompanyCreatorRequest";

export default class CompanyCreator {
    __invoke(request: CompanyCreatorRequest) {
        console.log(request.name);
        console.log(request.phone);
    }
}
