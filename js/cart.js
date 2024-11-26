// Fungsi untuk menambah atau mengurangi jumlah produk
function updateQuantity(productId, change) {
    var qtyInput = document.getElementById('qty-' + productId);
    if (qtyInput) {
        var currentQty = parseInt(qtyInput.value);
        currentQty += change;

        if (currentQty < 0) currentQty = 0; // Pastikan tidak ada jumlah negatif
        qtyInput.value = currentQty;
    } else {
        console.log("Element qty-" + productId + " tidak ditemukan!");
    }
}

// Fungsi untuk menambah produk ke keranjang (mengirim data ke server)
function addToCart(productId) {
    var qty = document.getElementById('qty-' + productId).value;

    if (qty > 0) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_to_cart.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Tampilkan respon dari server
                alert(xhr.responseText);

                // Jika respon menunjukkan belum login, arahkan ke halaman login
                if (xhr.responseText.includes("Silakan login")) {
                    window.location.href = "login.php";
                }
            }
        };
        xhr.send('product_id=' + productId + '&quantity=' + qty);
    } else {
        alert('Silakan pilih jumlah produk terlebih dahulu!');
    }
}



