

/*bootstrap 5*/
$(document).ready(function () {
    // $("#modal-popup-video").modal('show');
    // $('#modal-popup-video').on('hidden.bs.modal', function () {
    //     $("#modal-popup-image").modal('show');
    //     console.log("video closed")
    //     $("#modal-popup-video iframe").attr("src", "");
    // });
    // if ($('#modal-popup-video')[0]) {
    //     $("#modal-popup-image").modal('hide');
    // } else {
    //     $("#modal-popup-image").modal('show');
    // }



    const myModal = new bootstrap.Modal('#modal-popup-image');
    myModal.show();
    
    const carousel = new bootstrap.Carousel('#myCarousel')
});


/*bootstrap 3*/
// $(document).ready(function () {
//     $("#modal-popup-video").modal('show');
//     $('#modal-popup-video').on('hidden.bs.modal', function () {
//         $("#modal-popup-image").modal('show');
//         console.log("video closed")
//         $("#modal-popup-video iframe").attr("src", "");
//     });
//     $('#modal-popup-image').on('hidden.bs.modal', function () {
//         // $('.deals ,.D-prev ,.D-next').removeClass('d-none');
//     });
//     if ($('#modal-popup-video')[0]) {
//         $("#modal-popup-image").modal('hide');
//     } else {
//         $("#modal-popup-image").modal('show');
//     }
//     jQuery('.deals .close').on('click', function () {
//         jQuery('.deals ').addClass('d-none');
//     });
//     $('#offon').on('click', function () {
//         $('.deals ').toggleClass('d-none');
//     });
// });