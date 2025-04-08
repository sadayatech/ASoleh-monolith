export const konversiStatus = (status) => {
    switch (status) {
        case "paid":
            return "Sudah bayar";
        case "unpaid":
            return "Belum bayar";
        case "under-review":
            return "Sedang ditinjau";
        case "rejected":
            return "Ditolak";
        case "done":
            return "Selesai";
        default:
            return "Status tidak diketahui";
    }
};
