import {useAuth} from "@/modules/auth/use/useAuth";

const {token} = useAuth();

export default {
    mtype: "GET",
    datatype: "json",
    height: "auto",
    autowidth: true,
    rowList: [10, 20, 50, 100],
    rowNum: 10,
    page: 1,
    loadtext: '<p>Cargando...</p>',
    hoverrows: false,
    refresh: true,
    multiselect: true,
    url: process.env.VUE_APP_ERP_URL + '/api/locations',
    colNames: [
        "No. location",
        "Name",
        "Main contact",
        "State",
        '',
        '',
    ],
    colModel: [
        {name: "code", width: 55},
        {name: "name", width: 55},
        {name: "mainContact", width: 55},
        {name: "state", width: 40},
        {name: "options", width: 55, align: 'center'},
        {name: "hiddenOptions", hidden: true}
    ],
    sortname: 'name',
    sortorder: "asc",
    viewrecords: true,
    gridview: true,
    loadBeforeSend: function (jqXHR: { setRequestHeader: (arg0: string, arg1: string | undefined) => void; }) {
        jqXHR.setRequestHeader("Authorization", 'Bearer ' + token.value);
    }
};
