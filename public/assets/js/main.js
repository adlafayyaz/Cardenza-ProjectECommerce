/* Main JavaScript for E‑Shop front‑end */
document.addEventListener('DOMContentLoaded', () => {
    // Tangani tombol "Add to Cart"
    const cartButtons = document.querySelectorAll('.add-to-cart');
    cartButtons.forEach(btn => {
        btn.addEventListener('click', function (event) {
            event.preventDefault();
            const productId = this.dataset.productId;
            addToCart(productId);
        });
    });

    // Tangani toggle favorit
    const favButtons = document.querySelectorAll('.toggle-favorite');
    favButtons.forEach(btn => {
        btn.addEventListener('click', function (event) {
            event.preventDefault();
            const productId = this.dataset.productId;
            toggleFavourite(productId, this);
        });
    });
});

/**
 * Tambahkan produk ke cart dengan AJAX sederhana.
 * @param {string|number} productId
 */
function addToCart(productId) {
    fetch('/cart/add/' + productId, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ quantity: 1 })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Produk ditambahkan ke keranjang');
                // TODO: update counter di navbar
            } else {
                alert(data.message || 'Gagal menambahkan ke keranjang');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan');
        });
}

/**
 * Toggle produk favorit (tambah/hapus).
 * @param {string|number} productId
 * @param {HTMLElement} element
 */
function toggleFavourite(productId, element) {
    fetch('/favorites/toggle/' + productId, {
        method: 'POST'
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                element.classList.toggle('active');
            } else {
                alert(data.message || 'Gagal mengubah favorit');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan');
        });
}
