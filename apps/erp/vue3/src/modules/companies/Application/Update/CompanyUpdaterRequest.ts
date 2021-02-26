export default class CompanyUpdaterRequest {
    id: string;
    name: string
    state: string
    address: string
    phone: string

    constructor(
        id: string,
        name: string,
        state: string,
        address: string,
        phone: string
    ) {
        this.id = id;
        this.name = name;
        this.state = state;
        this.address = address;
        this.phone = phone;
    }
}
