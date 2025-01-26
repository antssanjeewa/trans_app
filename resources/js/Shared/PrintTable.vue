<template>
  <div class="my-auto ml-4">
    <button
      class="
        bg-gray-300
        hover:bg-gray-400
        focus:outline-none
        px-3
        py-2
        rounded-md
        mr-3
      "
      @click="getData"
    >
      <Icon icon="printer" classes="fill-current h-5 w-5 text-gray-700" />
    </button>
  </div>
</template>

<script>
export default {
  props: {
    items: {
      required: true,
    },
    headers: {
      required: true,
    },
    form: {
      required: true,
    },
    route_link: {
      required: true,
    },
    title: {
      type: String,
      default: "Item List Report",
    },
  },
  data() {
    return {
      date: new Date().toDateString(),
    };
  },
  methods: {
    getData() {
      let query = {};
      Object.assign(query, this.form);
      query.count = this.items.meta.total;
      this.$inertia.replace(this.route(`${this.route_link}.index`, query), {
        onFinish: () => this.printList(),
      });
    },
    closePrint() {
      this.$inertia.replace(this.route(`${this.route_link}.index`, this.form));
    },
    printList() {
      var summery = document.getElementById("summery");
      var prtContent = document.getElementById("print_id");
      // let header = `
      //     <div class="header-wrap">
      //         <div >
      //             <p class="large">Sadaham Book Shop</p>
      //             <p>Mahameuna Bodhignana Asapuwa,</p>
      //             <p>Rajasinghe Mw,</p> <p>Hewagama,</p>
      //             <p>Kaduwela.</p> <p>Tel: 0112 537 337</p>
      //         </div>
      //         <div>
      //             <p class="large">INVOICE</p>
      //             <p>Date: 11/29/2020</p>
      //             <p>Bill To</p>
      //             <p>0</p>
      //         </div>
      //      </div>
      //      <div class="header-bottom">
      //      Customer Total Balance		 LKR 280.00
      //      </div>

      // `;
      let printWindow = window.open("");

      printWindow.document.write("<html><head><title>Item List</title>");
      printWindow.document.write(
        `<style>
            table {
                width : 100%;
                text-align: left;
            }
            table, td {
                border-collapse: collapse;
                height:30px;
            }
            td {
                border: 1px solid #585656;
            }
            th {
                border: 1px solid #585656;
                height:35px;
                background-color: #3b3b3c;
                color: white;
            }

            tr:nth-child(even) {
                background-color: #c5c7ca;
            }
            b{
              font-size: 20px;
            }
            .px-5 > div{
              margin: auto 0;
            }
            p {
               margin: 0;
            }
            a{
              text-decoration:none;
              color:black;
            }
            .large{
              font-size: x-large;
            }
            
            h1{
              text-align : center;
            }
            .flex{
              display:flex;
            }
            .text-3xl{
              font-size: 1.875rem;
              margin: 20px 0;
            }
            .justify-between{
              justify-content: space-between;
            }
            .print-none{
                display: none;
            }
            .overflow-x-auto{
              width:100%;
            }
            
            .header-wrap{
              display:flex;
              justify-content: space-between;
              line-height: 1.5;
              margin-bottom:10px;
            }
            .header-bottom{
              margin-bottom:20px;
            }
            

        </style>`
      );
      printWindow.document.write("</head><body >");
      printWindow.document.write("<p> " + this.date + " </p>");
      // printWindow.document.write(header);
      if (summery) printWindow.document.write(summery.outerHTML);
      else printWindow.document.write("<h1> " + this.title + " </h1>");
      printWindow.document.write(prtContent.innerHTML);
      printWindow.document.write("</></html>");

      printWindow.document.close();
      printWindow.focus();
      printWindow.print();
      this.closePrint();
      // printWindow.close();
    },
  },
};
</script>