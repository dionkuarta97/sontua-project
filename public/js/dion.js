const flashdata = $(".flash-data").data("flashdata");
const flashdata2 = $(".flash-data2").data("flashdata2");
let aa;

if (flashdata) {
  Swal.fire({
    text: flashdata,
    icon: "success",
  });
}

if (flashdata2) {
  Swal.fire({
    title: flashdata2,
    icon: "error",
  });
}

$(document).on("click", ".konfirm", function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal.fire({
    title: "Apakah Kamu Yakin",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yakin",
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    }
  });
});

$(document).on("click", ".konfirmF", function (e) {
  e.preventDefault();
  var form = $(this).parents("form");

  Swal.fire({
    title: "Apakah Kamu Yakin",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yakin",
  }).then((result) => {
    if (result.value) {
      form.submit();
    }
  });
});
