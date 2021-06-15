interface DefaultCatalog {
    id: string,
    title: string
}

export interface Catalog {
    itemStates: DefaultCatalog
    states: DefaultCatalog[]
}
