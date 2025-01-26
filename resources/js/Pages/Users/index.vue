<script setup>
import DataTable from '@/Shared/DataTable.vue';
import SearchFilter from "@/Shared/SearchFilter.vue";
import SelectList from "@/Shared/SelectList.vue";
import Alert from "@/Shared/Alert.vue";
import { reactive, watch } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";

const props = defineProps({
    users: Array | Object,
    filters: Object,
    success: String
});

const headers = [
    { text: "ID", value: "id" },
    { text: "User Name", value: "name" },
    { text: "Email", value: "email" },
    { text: "Role", value: "role" },
    { text: "", value: "actions" },
];

const form = reactive({
    search: props.filters.search || "",
    count: props.filters.count || "15",
    page: props.filters.page || 1,
});

// Throttled function
const throttledHandler = throttle(() => {
    const query = pickBy(form); // Remove empty or undefined values from form
    const queryParams = Object.keys(query).length ? query : { remember: "forget" };

    router.visit(
        window.route("users.index", queryParams),
        { preserveState: true }
    );
}, 150);

// Watcher for `form`
watch(form, () => {throttledHandler();},{ deep: true });

function deleteUser(id) {
    if (confirm("Are You sure you want to delete this item ?")) {
        this.$inertia.delete("users/" + id);
    }
};
function reset() {
    props.form = {
        search: "",
        page: 1,
        count: "15",
    };
};

</script>

<template>
    <AppLayout title="Users">
        <!-- Success Messgage -->
        <Alert v-if="success" :message="success" />

        <!-- Title -->
        <template #header>User List</template>

        <div class="pt-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-3 flex justify-between items-center">
                    <!--
                        Filters
                    -->
                    <div class="flex max-w-md mr-4">
                        <!-- Select Row Count -->
                        <SelectList v-model="form.count" classes="rounded-l-md" />

                        <!-- Search field -->
                        <SearchFilter v-model="form.search" @reset="reset"></SearchFilter>
                    </div>
                    <!--
                        Create Button
                    -->
                    <Link class="rounded-md py-1 px-4 tracking-wide bg-blue-800 btn btn-shadow" :href="route('users.create')">
                    <span>Add New</span>
                    </Link>
                </div>
                <!--
                    Data Table
                -->
                <DataTable :items="users" :headers="headers" :filters="form">
                    <template v-slot:actions="{ item }">
                        <td class="flex justify-end text-sm leading-5 font-medium space-x-2">
                            <a href="#" class="text-gray-600 hover:text-green-600">View</a>
                            <Link class="text-gray-600 hover:text-blue-600" :href="route('users.edit', item.id)">Edit</Link>
                            <!-- <delete-item :url="`sell_items/${item.id}`"></delete-item> -->
                        </td>
                    </template>
                </DataTable>
            </div>
        </div>
    </AppLayout>
</template>