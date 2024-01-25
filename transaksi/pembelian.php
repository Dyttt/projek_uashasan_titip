
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pembelian</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('/img/1920x1080/01.jpg');
      margin: 20px;
    }

    form {
      max-width: 400px;
      margin: 0 auto;
      background-color: #c71533;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input, select {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      box-sizing: border-box;
    }

    button {
      background-color: #4caf50;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #67e06d;
    }

    .btn-group {
      margin-top: 20px;
      text-align: center;
    }

    .btn-group button {
      margin: 0 5px;
    }
  </style>
</head>
<body>

  <form id="purchaseForm">
    <label for="memberName">Nama Member:</label>
    <input type="text" id="memberName" name="memberName" required>

    <label for="packet">Pilih Packet:</label>
    <select id="packet" name="packet" onchange="updateTotalBayar()" required>
      <option value="">Pilih Packet</option>
      <option value="basic">Silver Packet</option>
      <option value="standard">Golden Packet</option>
      <option value="premium">Premium packet</option>
    </select>

    <label for="payment">Metode Pembayaran:</label>
    <select id="payment" name="payment" required>
      <option value="">Pilih Metode Pembayaran</option>
      <option value="credit">Credit</option>
      <option value="cash">Cash</option>
    </select>

    <label for="total_bayar">Total Bayar :</label>
    <input type="text" id="total_bayar" name="total_bayar" readonly required>

    <div class="btn-group">
      <button type="button" onclick="deletePurchase()">Delete</button>
      <button type="submit" onclick="savePurchase()" name="submit">Save</button>
    </div>
  </form>

  <script>
    function updateTotalBayar() {
      var packetSelect = document.getElementById('packet');
      var totalBayarInput = document.getElementById('total_bayar');

      // Harga masing-masing paket
      var hargaSilver = 580000;
      var hargaGolden = 799000;
      var hargaPremium = 1000000;

      // Mendapatkan nilai terpilih dari dropdown
      var selectedPacket = packetSelect.value;

      // Mengupdate total bayar sesuai dengan pilihan paket
      switch (selectedPacket) {
        case 'basic':
          totalBayarInput.value = hargaSilver.toLocaleString('id-ID');
          break;
        case 'standard':
          totalBayarInput.value = hargaGolden.toLocaleString('id-ID');
          break;
        case 'premium':
          totalBayarInput.value = hargaPremium.toLocaleString('id-ID');
          break;
        default:
          totalBayarInput.value = '';
      }
    }

    function deletePurchase() {
      var memberNameInput = document.getElementById('memberName');
      var packetSelect = document.getElementById('packet');
      var paymentSelect = document.getElementById('payment');
      var totalBayarInput = document.getElementById('total_bayar');

      // Mengosongkan nilai input
      memberNameInput.value = '';
      packetSelect.value = '';
      paymentSelect.value = '';
      totalBayarInput.value = '';
    }

    function savePurchase() {
      
      var memberNameInput = document.getElementById('username');
      var packetSelect = document.getElementById('packet');
      var paymentSelect = document.getElementById('payment');
      var totalBayarInput = document.getElementById('total_bayar');

  // Mengumpulkan data pembelian
  var purchaseData = {
    memberName: memberNameInput.value,
    packet: packetSelect.value,
    payment: paymentSelect.value,
    totalBayar: totalBayarInput.value.replace(/\D/g, ''), // Menghapus karakter non-digit dari totalBayar
  };

  // Melakukan request AJAX ke server untuk menyimpan data pembelian
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'https://localhost/uts/d.php', true); // Ganti dengan URL sesuai endpoint server Anda
  xhr.setRequestHeader('Content-Type', 'application/json');

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        alert('Data pembelian berhasil disimpan!');
      } else {
        alert('Gagal menyimpan data pembelian. Silakan coba lagi.');
      }
    }
  };

  xhr.send(JSON.stringify(purchaseData));
}

    // Memanggil updateTotalBayar saat halaman pertama kali dimuat
    updateTotalBayar();
  </script>

</body>
</html>
