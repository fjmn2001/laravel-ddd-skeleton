export interface Client {
    id: string,
    name: string,
    lastname: string,
    dni: string,
    dniType: string,
    clientType: string,
    clientCategory: string,
    frequentClientNumber: string,
    state: string,
    phones: object[],
    emails: object[],
}
