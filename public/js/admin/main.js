// Config datatable language
const datatableConfigLanguage = {
    decimal: "",
    emptyTable: "Chưa có dữ liệu",
    info: "Hiển thị _START_ đến _END_ của _TOTAL_ kết quả",
    infoEmpty: "Hiển thị 0 đến 0 của 0 kết quả",
    infoFiltered: "(lọc _MAX_ kết quả)",
    infoPostFix: "",
    thousands: ",",
    lengthMenu: "Phân trang _MENU_",
    loadingRecords: "Đang tải...",
    processing: "",
    search: "Tìm kiếm:",
    zeroRecords: "Không tìm thấy kết quả nào",
    paginate: {
        first: "Đầu",
        last: "Cuối",
        next: "Tiếp",
        previous: "Lùi",
    },
};

// Init Notification
function showNotification(
    title,
    message,
    position,
    bgColor,
    icon,
    hideAfter = 3000
) {
    $.toast({
        heading: title,
        text: message,
        position: position,
        loaderBg: bgColor,
        icon: icon,
        hideAfter: hideAfter,
        stack: 1,
        showHideTransition: "fade",
    });
}