export default class CompanyCreatorRequest {
    name: string
    state: string
    address: string
    phone: string

    constructor(
        name: string,
        state: string,
        address: string,
        phone: string
    ) {
        this.name = name;
        this.state = state;
        this.address = address;
        this.phone = phone;
    }
}
