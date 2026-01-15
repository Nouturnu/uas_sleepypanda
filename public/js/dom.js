// Menjalankan skrip hanya setelah halaman HTML selesai dimuat
window.onload = function() {
    
    // Ambil semua elemen yang kita butuhkan
    const img1 = document.getElementById('img1');
    const img2 = document.getElementById('img2');
    const img3 = document.getElementById('img3');
    
    const basket = document.getElementById('basket');
    const basketStatus = document.getElementById('basketstat');
    
    const textParagraph = document.getElementById('text1');
    const pageBody = document.getElementById('bd');
    
    const btnChangeText = document.getElementById('chtext');
    const btnChangeBg = document.getElementById('bccol');

    // --- Fungsi untuk memperbarui hitungan bunga ---
    function updateFlowerCount() {
        const count = basket.getElementsByTagName('img').length;
        basketStatus.textContent = 'The flower basket currently contains ' + count + ' flowers.';
    }

    // --- Fungsi untuk menambah bunga ke keranjang ---
    function addFlower(event) {
        const originalImage = event.target;
        const newFlower = originalImage.cloneNode(true);
        
        // Buat agar bunga di keranjang bisa diklik untuk dihapus
        newFlower.addEventListener('click', removeFlower);
        
        basket.appendChild(newFlower);
        updateFlowerCount();
    }
    
    // --- Fungsi untuk menghapus bunga dari keranjang ---
    function removeFlower(event) {
        const flowerToRemove = event.target;
        flowerToRemove.remove();
        updateFlowerCount();
    }

    // --- Tambahkan event ke tombol Ubah Warna Teks ---
    btnChangeText.addEventListener('click', function() {
        const newColor = prompt('Input your color:');
        if (newColor) {
            textParagraph.style.color = newColor;
        }
    });
    
    // --- Tambahkan event ke tombol Ubah Warna Latar Belakang ---
    btnChangeBg.addEventListener('click', function() {
        const newColor = prompt('Input your color:');
        if (newColor) {
            pageBody.style.backgroundColor = newColor;
        }
    });

    // --- Pasang event listener ke 3 gambar bunga di atas ---
    img1.addEventListener('click', addFlower);
    img2.addEventListener('click', addFlower);
    img3.addEventListener('click', addFlower);
    
    // Set hitungan awal
    updateFlowerCount();
};