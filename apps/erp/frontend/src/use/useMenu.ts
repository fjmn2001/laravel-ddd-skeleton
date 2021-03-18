import {ref, Ref} from "vue";
import {TopBarOption} from "@/types/TopBarOption";
import {api} from "@/services/api";
import {LeftBarOption} from "@/types/LeftBarOption";

const leftBarOptions: Ref<LeftBarOption[]> = ref([])
const loadingLeftBar: Ref<boolean> = ref(false);

export function useMenu() {
    const topBarOptions: Ref<TopBarOption[]> = ref([])
    const topBarOptionSelected: Ref<string | null> = ref(null)

    async function getTopBarOptions() {
        topBarOptions.value = await api.getTopBarOptions();
    }

    async function getLeftBarOptions(name: string) {
        loadingLeftBar.value = true;
        topBarOptionSelected.value = name;
        leftBarOptions.value = await api.getLeftBarOptions(name);
        loadingLeftBar.value = false;
    }

    return {
        topBarOptions,
        leftBarOptions,
        topBarOptionSelected,
        loadingLeftBar,
        getTopBarOptions,
        getLeftBarOptions
    }
}
