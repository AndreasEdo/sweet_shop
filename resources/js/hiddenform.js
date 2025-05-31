function getOrCreateForm() {
    let form = document.getElementById('cartForm');
    if (!form) {
        form = document.createElement('form');
        form.id = 'cartForm';
        form.action = "{{ route('cart.add') }}";
        form.method = 'POST';
        form.style.display = 'none';

        // CSRF Token - dengan fallback jika meta tag tidak ada
        let csrfToken = '';
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        if (csrfMeta) {
            csrfToken = csrfMeta.content;
        } else {
            console.warn('CSRF meta tag not found, using empty token');
        }

        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = csrfToken;

        const productInput = document.createElement('input');
        productInput.type = 'hidden';
        productInput.name = 'product_id';
        productInput.id = 'product_id';

        const quantityInput = document.createElement('input');
        quantityInput.type = 'hidden';
        quantityInput.name = 'quantity';
        quantityInput.value = '1';

        form.appendChild(csrf);
        form.appendChild(productInput);
        form.appendChild(quantityInput);
        document.body.appendChild(form);
    }
    return form;
}

document.addEventListener("DOMContentLoaded", function () {
    document.body.addEventListener('click', function(e) {
        if (e.target.closest('.add-to-cart')) {
            e.preventDefault();
            const button = e.target.closest('.add-to-cart');
            const productId = button.getAttribute('data-product-id');

            const form = document.createElement('form');
            form.action = window.cartAddRoute; // Menggunakan variabel global
            form.method = 'POST';
            form.style.display = 'none';

            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = window.csrfToken;

            const productInput = document.createElement('input');
            productInput.type = 'hidden';
            productInput.name = 'product_id';
            productInput.value = productId;

            const quantityInput = document.createElement('input');
            quantityInput.type = 'hidden';
            quantityInput.name = 'quantity';
            quantityInput.value = '1';

            form.appendChild(csrf);
            form.appendChild(productInput);
            form.appendChild(quantityInput);
            document.body.appendChild(form);
            form.submit();
        }
    });
});
