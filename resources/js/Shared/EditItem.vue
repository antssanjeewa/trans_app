<template>
  <div>
    <button
      :class="{
        'text-gray-600 hover:text-blue-600': !text,
      }"
      @click="dialog = true"
      :disabled="disabled"
    >
      {{ text }}
    </button>

    <!-- Delete Account Confirmation Modal -->
    <jet-dialog-modal :show="dialog" @close="dialog = false">
      <template #title>Edit Item</template>

      <template #content>
        Are you want to EDIT this item? Only ADMINs are allowed to do this.
        Please enter an administrator password to proceed.
        <div class="mt-4">
          <text-input class="mt-1 block w-3/4" placeholder="Not Required" />
          <text-input
            :type="dialog ? 'password' : 'text'"
            class="mt-1 block w-3/4"
            placeholder="Enter Admin Password"
            v-model="form.password"
            :error="error"
            @keyup.enter.native="cancelComfirmed"
          />
        </div>
      </template>

      <template #footer>
        <button class="btn text-orange-500" @click="close">Cancel</button>
        <button class="btn bg-green-500 text-white" @click="cancelComfirmed">
          Process
        </button>
      </template>
    </jet-dialog-modal>
  </div>
</template>

<script>
import JetDialogModal from "@/Jetstream/DialogModal";
import TextInput from "@/Shared/TextInput";
export default {
  components: {
    JetDialogModal,
    TextInput,
  },
  props: {
    request_type: {
      default: "get",
    },
    disabled: {
      default: false,
    },
    text: {
      default: "Edit",
    },
    item_id: {
      required: true,
    },
    url: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      dialog: false,
      error: null,
      form: {
        password: null,
      },
    };
  },
  methods: {
    close() {
      this.form.password = null;
      this.dialog = false;
    },
    cancelComfirmed() {
      let login = encodeURIComponent(this.form.password);
      return fetch(`/users/permission?pass=${login}`)
        .then((response) => {
          if (!response.ok) {
            throw new Error(response.statusText);
          }
          this.error = null;
          if (this.request_type == "post") {
            this.$inertia.post(this.route(this.url, this.item_id));
          } else {
            this.$inertia.get(this.route(this.url, this.item_id));
          }
          this.close();
        })
        .catch((error) => {
          this.error = "Password Not Match";
        });
    },
  },
  // methods: {
  //   deleteItem() {
  //     this.$swal({
  //       title: "Are you sure?",
  //       text: "You won't be able to revert this!",
  //       icon: "warning",
  //       showCancelButton: true,
  //       confirmButtonColor: "#3085d6",
  //       cancelButtonColor: "#d33",
  //       confirmButtonText: "Yes, delete it!",
  //     }).then((result) => {
  //       if (result.isConfirmed) {
  //         this.$inertia.delete(this.url);
  //       }
  //     });
  //   },

  // },
};
</script>
