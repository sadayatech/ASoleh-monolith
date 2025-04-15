export const konversiStatus = (status) => {
  switch (status) {
    case 'paid':
      return 'Lunas';
    case 'unpaid':
      return 'Belum lunas';
    case 'under-review':
      return 'Sedang ditinjau';
    case 'rejected':
      return 'Ditolak';
    case 'done':
      return 'Selesai';
    default:
      return 'Status tidak diketahui';
  }
};
