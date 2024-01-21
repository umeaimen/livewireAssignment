import $ from 'jquery'
import NioApp from '../vendors/nioapp/nioapp.min.js'
import Swal from 'sweetalert2'
import toastr from 'toastr';
console.log('custom');
document.addEventListener("livewire:initialized", () => {

    Livewire.on("open-main-modal", (data) => {
        $("#main-modal").show();
        $("body").addClass("modal-open");
        $("body").append('<div class="modal-backdrop fade show"></div>');
        $("#main-modal").addClass("show");
    });

    /**
     * hide offcanvas modal
     */
    Livewire.on("close-main-modal", (data) => {
        $("#main-modal").hide();
        $("body").removeClass("modal-open");
        $(".modal-backdrop").remove();
        $("#main-modal").removeClass("show");
    });

    Livewire.on('datatable', (data) => {
        console.log('datatable');
        // $('.datatable-init').DataTable().destroy();
        NioApp.DataTable.init('.datatable-init').destroy();
        NioApp.DataTable.init();
    });
    /**
     * generic toastr alert when dispacth event
     * from livewire component
     */
    Livewire.on("alert", (data) => {console.log(data);
            toastr.clear();
            NioApp.Toast(data[0].message, data[0].type, {
              position: 'bottom-right'
            });
    });
    Livewire.on("swal-alert", function ([data]) {
        Swal.fire({
            title: data?.title ?? "Are you sure?",
            text: data?.description,
            icon: data?.iconType ?? "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                if (data?.type === "delete") {
                    console.log(data);
                    Livewire.dispatch("delete", { id: data?.id });
                }
            }
        });
    });
});