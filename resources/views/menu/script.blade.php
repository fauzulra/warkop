<script>
    (function() {
        // ====================================
        // RESTAURANT ORDER SYSTEM - REFACTORED
        // ====================================

        // ========== GLOBALS ==========
        let cart = [];
        let currentTotal = 0;
        let isEditMode = false;
        let editingItemId = null;

        // Data add-ons (injected from blade)
        const addOnsData = @json($addons);

        // ========== HELPERS ==========
        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount).replace('IDR', 'Rp');
        }

        function parseCurrencyToInt(text) {
            if (!text && text !== 0) return 0;
            const digits = String(text).replace(/[^0-9]/g, '');
            return Number(digits) || 0;
        }

        function showSuccessMessage(message) {
            const existingToast = document.querySelector('.success-toast');
            if (existingToast) existingToast.remove();

            const toast = document.createElement('div');
            toast.className =
                'success-toast fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50';
            toast.style.animation = 'fadeIn 0.3s ease-in';
            toast.innerHTML = `<i class="fas fa-check mr-2"></i>${message}`;

            document.body.appendChild(toast);

            setTimeout(() => {
                if (toast.parentNode) {
                    toast.style.animation = 'fadeOut 0.3s ease-out';
                    setTimeout(() => toast.remove(), 300);
                }
            }, 3000);
        }

        // ========== MODAL CREATION & HELPERS ==========
        function createAddOnsModal() {
            // Prevent duplicate
            if (document.getElementById('addOnsModal')) return document.getElementById('addOnsModal');

            const modalHtml = `
        <div id="addOnsModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-xl max-w-md w-full p-6 max-h-[90vh] overflow-y-auto">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Tambah ke Pesanan</h3>
                        <button id="closeAddOnsModal" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h4 id="modalMenuName" class="font-semibold text-gray-900"></h4>
                        <p id="modalMenuPrice" class="text-emerald-600 font-bold"></p>
                    </div>

                    <div id="addOnsSection" class="mb-6">
                        <h5 class="font-medium text-gray-700 mb-3">Pilih Add-ons (Opsional)</h5>
                        <div id="addOnsList" class="space-y-2"></div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Khusus</label>
                        <textarea id="itemNote" rows="3" placeholder="Contoh: Pedas, tidak pakai bawang, dll..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent resize-none"></textarea>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="font-medium">Total Harga:</span>
                            <span id="modalTotal" class="text-xl font-bold text-emerald-600"></span>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button id="cancelAddOns" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">Batal</button>
                        <button id="confirmAddToCart" class="flex-1 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition duration-200">Tambah ke Pesanan</button>
                    </div>
                </div>
            </div>
        </div>
        `;

            document.body.insertAdjacentHTML('beforeend', modalHtml);
            const modal = document.getElementById('addOnsModal');

            // Close handlers
            document.getElementById('closeAddOnsModal').onclick = closeAddOnsModal;
            document.getElementById('cancelAddOns').onclick = closeAddOnsModal;

            // Delegate change events inside modal for add-on checkboxes
            modal.addEventListener('change', function(e) {
                if (e.target && e.target.classList && e.target.classList.contains('addon-checkbox')) {
                    updateModalTotal();
                }
            });

            return modal;
        }

        function showAddOnsModal(menuId, menuName, menuPrice, menuCategory) {
            const modal = document.getElementById('addOnsModal') || createAddOnsModal();
            const availableAddOns = addOnsData[menuCategory] || [];

            isEditMode = false;
            editingItemId = null;

            document.getElementById('modalMenuName').textContent = menuName;
            document.getElementById('modalMenuPrice').textContent = formatCurrency(menuPrice);

            document.getElementById('addOnsList').innerHTML = '';
            document.getElementById('itemNote').value = '';

            const confirmBtn = document.getElementById('confirmAddToCart');
            confirmBtn.textContent = 'Tambah ke Pesanan';
            confirmBtn.dataset.originalQuantity = '';
            confirmBtn.dataset.editMode = '';

            if (availableAddOns.length > 0) {
                document.getElementById('addOnsSection').style.display = 'block';
                availableAddOns.forEach(addon => {
                    const addonHtml = `
                    <label class="flex items-center justify-between p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                        <div class="flex items-center">
                            <input type="checkbox" class="addon-checkbox mr-3" value="${addon.id}" data-name="${addon.name}" data-price="${addon.price}">
                            <span class="text-sm font-medium">${addon.name}</span>
                        </div>
                        <span class="text-sm text-emerald-600 font-semibold">${formatCurrency(addon.price)}</span>
                    </label>
                `;
                    document.getElementById('addOnsList').insertAdjacentHTML('beforeend', addonHtml);
                });
            } else {
                document.getElementById('addOnsSection').style.display = 'none';
            }

            // Attach confirm handler (replace previous)
            confirmBtn.onclick = () => confirmAddToCart(menuId, menuName, menuPrice, menuCategory);

            updateModalTotal();
            modal.classList.remove('hidden');
        }

        function closeAddOnsModal() {
            const modal = document.getElementById('addOnsModal');
            if (modal) modal.classList.add('hidden');
            isEditMode = false;
            editingItemId = null;
        }

        function updateModalTotal() {
            const modalMenuPriceEl = document.getElementById('modalMenuPrice');
            if (!modalMenuPriceEl) return;
            const basePrice = parseCurrencyToInt(modalMenuPriceEl.textContent);
            const selectedAddOns = document.querySelectorAll('.addon-checkbox:checked');

            let addOnsTotal = 0;
            selectedAddOns.forEach(checkbox => {
                addOnsTotal += parseInt(checkbox.dataset.price || 0, 10);
            });

            const total = basePrice + addOnsTotal;
            const modalTotal = document.getElementById('modalTotal');
            if (modalTotal) modalTotal.textContent = formatCurrency(total);
        }

        // ========== CART FUNCTIONS ==========
        function confirmAddToCart(menuId, menuName, menuPrice, menuCategory) {
            const selectedAddOns = [];
            document.querySelectorAll('.addon-checkbox:checked').forEach(checkbox => {
                selectedAddOns.push({
                    id: parseInt(checkbox.value, 10),
                    name: checkbox.dataset.name,
                    price: parseInt(checkbox.dataset.price || 0, 10)
                });
            });

            const itemsNote = document.getElementById('itemNote')?.value?.trim() || '';
            const addOnsPrice = selectedAddOns.reduce((s, a) => s + (a.price || 0), 0);
            const totalItemPrice = (parseInt(menuPrice, 10) || 0) + addOnsPrice;


            if (isEditMode && editingItemId) {
                const itemIndex = cart.findIndex(item => item.id === editingItemId);
                if (itemIndex !== -1) {
                    const confirmBtn = document.getElementById('confirmAddToCart');
                    const originalQuantity = parseInt(confirmBtn.dataset.originalQuantity || 1, 10) || 1;

                    cart[itemIndex] = {
                        id: editingItemId,
                        menuId,
                        name: menuName,
                        basePrice: menuPrice,
                        addOns: selectedAddOns,
                        note: itemsNote,
                        totalPrice: totalItemPrice,
                        quantity: originalQuantity,
                        category: menuCategory
                    };
                }
                showSuccessMessage('Item berhasil diperbarui!');
            } else {
                const existingItem = cart.find(item =>
                    item.menuId === menuId &&
                    JSON.stringify(item.addOns) === JSON.stringify(selectedAddOns) &&
                    item.note === itemsNote
                );

                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    const cartItemId = Date.now();
                    cart.push({
                        id: cartItemId,
                        menuId,
                        name: menuName,
                        basePrice: menuPrice,
                        addOns: selectedAddOns,
                        note: itemsNote,
                        totalPrice: totalItemPrice,
                        quantity: 1,
                        category: menuCategory
                    });
                }
                showSuccessMessage('Item berhasil ditambahkan ke pesanan!');
            }

            renderCart();
            updateCartSummary();
            closeAddOnsModal();

        }

        function renderCart() {
            const cartItems = document.getElementById('cartItems');
            if (!cartItems) return;

            if (cart.length === 0) {
                cartItems.innerHTML = `
                <div class="text-center text-gray-500 py-8">
                    <i class="fas fa-shopping-cart text-4xl mb-3"></i>
                    <p>Belum ada item yang dipilih</p>
                </div>
            `;
                return;
            }

            cartItems.innerHTML = cart.map(item => {
                const addOnsHtml = item.addOns && item.addOns.length > 0 ?
                    `<div class="mb-2"><p class="text-xs font-medium text-gray-700 mb-1">Add-ons:</p>
                    ${item.addOns.map(addon => `<span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1 mb-1">${addon.name} (+${formatCurrency(addon.price)})</span>`).join('')}
                   </div>` :
                    '';

                const noteHtml = item.note ?
                    `<div class="mb-2"><p class="text-xs font-medium text-gray-700">Catatan:</p><p class="text-xs text-gray-600 bg-yellow-50 p-2 rounded">${item.note}</p></div>` :
                    '';

                return `
                <div class="border-b border-gray-100 last:border-b-0 py-4">
                    <div class="flex items-start justify-between mb-2">
                        <div class="flex-1">
                            <h5 class="font-semibold text-gray-900">${item.name}</h5>
                            <p class="text-sm text-gray-600">Base: ${formatCurrency(item.basePrice)}</p>
                        </div>
                        <button onclick="removeFromCart(${item.id})" class="text-red-600 hover:text-red-700 p-1">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                    </div>
                    ${addOnsHtml}
                    ${noteHtml}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <button onclick="updateQuantity(${item.id}, -1)" class="w-6 h-6 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center text-xs"><i class="fas fa-minus"></i></button>
                            <span class="w-8 text-center font-medium">${item.quantity}</span>
                            <button onclick="updateQuantity(${item.id}, 1)" class="w-6 h-6 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white flex items-center justify-center text-xs"><i class="fas fa-plus"></i></button>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-emerald-600">${formatCurrency(item.totalPrice * item.quantity)}</p>
                            <button onclick="editCartItem(${item.id})" class="text-blue-600 hover:text-blue-700 text-xs"><i class="fas fa-edit mr-1"></i>Edit</button>
                        </div>
                    </div>
                </div>
            `;
            }).join('');
        }

        function editCartItem(cartItemId) {
            const item = cart.find(i => i.id === cartItemId);
            if (!item) return;
            isEditMode = true;
            editingItemId = cartItemId;

            // Open modal and pre-fill selections
            showAddOnsModal(item.menuId, item.name, item.basePrice, item.category);

            setTimeout(() => {
                item.addOns.forEach(addon => {
                    const checkbox = document.querySelector(
                        `#addOnsModal .addon-checkbox[value="${addon.id}"]`);
                    if (checkbox) checkbox.checked = true;
                });

                const noteField = document.getElementById('itemNote');
                if (noteField) noteField.value = item.note || '';

                updateModalTotal();

                const confirmBtn = document.getElementById('confirmAddToCart');
                if (confirmBtn) {
                    confirmBtn.textContent = 'Update Item';
                    confirmBtn.dataset.originalQuantity = item.quantity;
                    confirmBtn.dataset.editMode = 'true';
                }
            }, 80);
        }

        function updateQuantity(cartItemId, change) {
            const item = cart.find(i => i.id === cartItemId);
            if (item) {
                item.quantity += change;
                if (item.quantity <= 0) {
                    removeFromCart(cartItemId);
                } else {
                    renderCart();
                    updateCartSummary();
                }
            }
        }

        function removeFromCart(cartItemId) {
            cart = cart.filter(i => i.id !== cartItemId);
            renderCart();
            updateCartSummary();
            showSuccessMessage('Item berhasil dihapus dari pesanan!');
        }

        function updateCartSummary() {
            const total = cart.reduce((sum, item) => sum + (item.totalPrice * item.quantity), 0);
            const totalEl = document.getElementById('total');
            if (totalEl) totalEl.textContent = formatCurrency(total);

            const processBtn = document.getElementById('processOrder');
            if (processBtn) processBtn.disabled = cart.length === 0;
        }

        function clearCart() {
            if (cart.length === 0) return;
            cart = [];
            renderCart();
            updateCartSummary();
            showSuccessMessage('Keranjang berhasil dikosongkan!');
        }

        function getCartData() {
            return {
                items: cart,
                summary: {
                    total: cart.reduce((s, i) => s + (i.totalPrice * i.quantity), 0)
                }
            };
        }

        // ========== PAYMENT ==========
        function calculateChange() {
            const customerMoney = parseInt(document.getElementById('customerMoney')?.value || 0, 10) || 0;
            const total = currentTotal;
            const changeSection = document.getElementById('changeSection');
            const changeAmount = document.getElementById('changeAmount');
            const changeStatus = document.getElementById('changeStatus');
            const confirmButton = document.getElementById('confirmPayment');

            if (!changeSection || !changeAmount || !changeStatus || !confirmButton) return;

            if (customerMoney <= 0) {
                changeSection.classList.add('hidden');
                confirmButton.disabled = true;
                return;
            }

            const change = customerMoney - total;
            changeSection.classList.remove('hidden');

            if (change < 0) {
                changeSection.className = 'mb-6 p-4 rounded-lg border-2 border-red-200 bg-red-50';
                changeAmount.className = 'text-3xl font-bold text-red-600 mb-2';
                changeAmount.textContent = formatCurrency(Math.abs(change));
                changeStatus.textContent = '❌ Uang customer kurang';
                changeStatus.className = 'text-sm text-red-600 font-medium';
                confirmButton.disabled = true;
            } else if (change === 0) {
                changeSection.className = 'mb-6 p-4 rounded-lg border-2 border-green-200 bg-green-50';
                changeAmount.className = 'text-3xl font-bold text-green-600 mb-2';
                changeAmount.textContent = 'Uang Pas';
                changeStatus.textContent = '✅ Tidak ada kembalian';
                changeStatus.className = 'text-sm text-green-600 font-medium';
                confirmButton.disabled = false;
            } else {
                changeSection.className = 'mb-6 p-4 rounded-lg border-2 border-blue-200 bg-blue-50';
                changeAmount.className = 'text-3xl font-bold text-blue-600 mb-2';
                changeAmount.textContent = formatCurrency(change);
                changeStatus.textContent = '💰 Berikan kembalian ke customer';
                changeStatus.className = 'text-sm text-blue-600 font-medium';
                confirmButton.disabled = false;
            }
        }

        function openPaymentModal() {
            const totalElement = document.getElementById('total');
            if (!totalElement) return;

            const modalTotal = document.getElementById('modalTotal');
            if (modalTotal) modalTotal.textContent = totalElement.textContent;

            currentTotal = parseCurrencyToInt(totalElement.textContent);

            const customerMoneyInput = document.getElementById('customerMoney');
            const changeSection = document.getElementById('changeSection');
            const confirmPayment = document.getElementById('confirmPayment');

            if (customerMoneyInput) customerMoneyInput.value = '';
            if (changeSection) changeSection.classList.add('hidden');
            if (confirmPayment) confirmPayment.disabled = true;

            const paymentModal = document.getElementById('paymentModal');
            if (paymentModal) {
                paymentModal.classList.remove('hidden');
                if (customerMoneyInput) customerMoneyInput.focus();
            }
        }

        function closePaymentModal() {
            const paymentModal = document.getElementById('paymentModal');
            if (paymentModal) paymentModal.classList.add('hidden');
        }

        function confirmPayment() {
            const customerMoneyInput = document.getElementById('customerMoney');
            if (!customerMoneyInput) return;

            const customerMoney = parseInt(customerMoneyInput.value || 0, 10) || 0;
            const change = customerMoney - currentTotal;

            // Build payload: normalize cart item fields for backend
            const payloadCart = cart.map(item => ({
                id: item.menuId, // corresponds to menu_id in DB
                quantity: item.quantity,
                price: parseInt(item.basePrice, 10) || 0,
                subtotal: (item.totalPrice * item.quantity) || 0,
                note: item.note || '',
                addons: (item.addOns || []).map(a => ({
                    id: a.id,
                    price: a.price
                }))
            }));

            const data = {
                cart: payloadCart,
                total: currentTotal,
                payment: customerMoney,
                change_return: change
            };

            // Close payment modal immediately (UX)
            closePaymentModal();

            // POST to Laravel endpoint
            fetch('/transaksi', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                })
                .then(res => res.json())
                .then(response => {
                    if (response.success) {
                        // Fill success modal
                        const successTotal = document.getElementById('successTotal');
                        const successCustomerMoney = document.getElementById('successCustomerMoney');
                        const successChange = document.getElementById('successChange');

                        if (successTotal) successTotal.textContent = formatCurrency(currentTotal);
                        if (successCustomerMoney) successCustomerMoney.textContent = formatCurrency(
                            customerMoney);
                        if (successChange) successChange.textContent = formatCurrency(change);

                        const successModal = document.getElementById('successModal');
                        if (successModal) successModal.classList.remove('hidden');

                        showSuccessMessage('Pesanan Berhasil ditambahkan');

                        // Clear cart after a short delay to allow user to see results
                        setTimeout(() => clearCart(), 1000);

                        // Optionally show invoice number
                        if (response.invoice_number) {
                            console.info('Invoice:', response.invoice_number);
                        }
                    } else {
                        alert(response.message || 'Gagal menyimpan transaksi.');
                    }
                })
                .catch(err => {
                    console.error('Error:', err);
                    alert('Gagal kirim transaksi!');
                });
        }

        function closeSuccessModal() {
            const successModal = document.getElementById('successModal');
            if (successModal) successModal.classList.add('hidden');
        }

        // ========== MENU HELPERS ==========
        // Safe stub — ubah sesuai kebutuhan (simpan ke DB via AJAX, atau render DOM)
        function addNewMenu(menuData) {
            console.log('addNewMenu stub:', menuData);
            // contoh: bisa menambahkan elemen DOM untuk menu baru jika kamu punya container menu list
            // const menuList = document.getElementById('menuList');
            // if (menuList) { /* render item */ }
        }

        function editMenu(menuId) {
            alert(`Edit menu ID: ${menuId}\nFitur edit akan segera tersedia!`);
        }

        function deleteMenu(menuId) {
            if (!confirm('Hapus menu ini?')) return;
            const menuElement = document.querySelector(`button[onclick*="deleteMenu(${menuId})"]`)?.closest(
                '.menu-item');
            if (menuElement) menuElement.style.display = 'none';

            // Remove any cart items with this menuId
            cart = cart.filter(item => item.menuId !== menuId);
            renderCart();
            updateCartSummary();
            showSuccessMessage('Menu berhasil dihapus!');
        }

        function filterMenuItems() {
            const searchTerm = (document.getElementById('menuSearch')?.value || '').toLowerCase();
            const categoryFilter = document.getElementById('categoryFilter')?.value || '';
            const menuItems = document.querySelectorAll('.menu-item');

            menuItems.forEach(item => {
                const itemName = (item.dataset.name || '').toLowerCase();
                const itemCategory = item.dataset.category || '';
                const matchesSearch = itemName.includes(searchTerm);
                const matchesCategory = !categoryFilter || itemCategory === categoryFilter;

                if (matchesSearch && matchesCategory) {
                    item.style.display = 'block';
                    item.classList.add('animate-fade-in');
                } else {
                    item.style.display = 'none';
                    item.classList.remove('animate-fade-in');
                }
            });
        }

        function processOrder() {
            if (cart.length === 0) {
                alert('Keranjang kosong! Tambahkan item terlebih dahulu.');
                return;
            }
            openPaymentModal();
        }

        // ========== INIT & EVENT BINDING ==========
        document.addEventListener('DOMContentLoaded', function() {
            // create modal once
            createAddOnsModal();

            // initial render
            renderCart();
            updateCartSummary();

            // add menu modal controls (if present)
            const addMenuModal = document.getElementById('addMenuModal');
            const addMenuBtn = document.getElementById('addMenuBtn');
            const closeModal = document.getElementById('closeModal');
            const cancelAdd = document.getElementById('cancelAdd');

            if (addMenuBtn) addMenuBtn.addEventListener('click', () => {
                if (addMenuModal) addMenuModal.classList.remove('hidden');
            });
            if (closeModal) closeModal.addEventListener('click', () => {
                if (addMenuModal) addMenuModal.classList.add('hidden');
            });
            if (cancelAdd) cancelAdd.addEventListener('click', () => {
                if (addMenuModal) addMenuModal.classList.add('hidden');
            });

            const addMenuForm = document.getElementById('addMenuForm');
            if (addMenuForm) {
                addMenuForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const menuData = {
                        name: document.getElementById('menuName').value,
                        category: document.getElementById('menuCategory').value,
                        price: parseInt(document.getElementById('menuPrice').value || 0, 10),
                        description: document.getElementById('menuDescription').value ||
                            'Tidak ada deskripsi',
                        image: document.getElementById('menuImage').value || ''
                    };
                    addNewMenu(menuData);
                    if (addMenuModal) addMenuModal.classList.add('hidden');
                    this.reset();
                    showSuccessMessage('Menu berhasil ditambahkan!');
                });
            }

            // Payment modal events
            const processOrderBtn = document.getElementById('processOrder');
            const cancelPaymentBtn = document.getElementById('cancelPayment');
            const confirmPaymentBtn = document.getElementById('confirmPayment');

            if (processOrderBtn) processOrderBtn.addEventListener('click', openPaymentModal);
            if (cancelPaymentBtn) cancelPaymentBtn.addEventListener('click', closePaymentModal);
            if (confirmPaymentBtn) confirmPaymentBtn.addEventListener('click', confirmPayment);

            // Success modal close
            const closeSuccessBtn = document.getElementById('closeSuccess');
            if (closeSuccessBtn) closeSuccessBtn.addEventListener('click', closeSuccessModal);

            // Customer money input events
            const customerMoneyInput = document.getElementById('customerMoney');
            if (customerMoneyInput) {
                customerMoneyInput.addEventListener('input', calculateChange);
                customerMoneyInput.addEventListener('keyup', function(e) {
                    if (e.key === 'Enter') {
                        const confirmBtn = document.getElementById('confirmPayment');
                        if (confirmBtn && !confirmBtn.disabled) confirmPayment();
                    }
                });
            }

            // Close modals when clicking outside
            const paymentModal = document.getElementById('paymentModal');
            if (paymentModal) {
                paymentModal.addEventListener('click', function(e) {
                    if (e.target === this) closePaymentModal();
                });
            }
            const successModal = document.getElementById('successModal');
            if (successModal) {
                successModal.addEventListener('click', function(e) {
                    if (e.target === this) closeSuccessModal();
                });
            }

            // Filter & search bindings
            const menuSearch = document.getElementById('menuSearch');
            const categoryFilter = document.getElementById('categoryFilter');
            const clearCartBtn = document.getElementById('clearCart');

            if (menuSearch) menuSearch.addEventListener('input', filterMenuItems);
            if (categoryFilter) categoryFilter.addEventListener('change', filterMenuItems);
            if (clearCartBtn) clearCartBtn.addEventListener('click', clearCart);

            // Add CSS animations
            const style = document.createElement('style');
            style.textContent = `
            @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
            @keyframes fadeOut { from { opacity: 1; transform: translateY(0); } to { opacity: 0; transform: translateY(-10px); } }
            .animate-fade-in { animation: fadeIn 0.3s ease-in; }
            .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        `;
            document.head.appendChild(style);
        });

        // ========== Expose for global onclick handlers ==========
        window.restaurantOrderSystem = {
            addToCart: showAddOnsModal,
            clearCart,
            getCartData,
            updateQuantity,
            removeFromCart,
            editCartItem,
            openPaymentModal,
            closePaymentModal,
            confirmPayment,
            calculateChange,
            addNewMenu,
            editMenu,
            deleteMenu,
            filterMenuItems,
            formatCurrency,
            showSuccessMessage
        };

        // Also expose individual functions for inline onclick compatibility
        window.addToCart = showAddOnsModal;
        window.removeFromCart = removeFromCart;
        window.updateQuantity = updateQuantity;
        window.editCartItem = editCartItem;
        window.clearCart = clearCart;
        window.processOrder = processOrder;
        window.openPaymentModal = openPaymentModal;
        window.closePaymentModal = closePaymentModal;
        window.confirmPayment = confirmPayment;
        window.closeSuccessModal = closeSuccessModal;
        window.calculateChange = calculateChange;
        window.addNewMenu = addNewMenu;
        window.editMenu = editMenu;
        window.deleteMenu = deleteMenu;
        window.filterMenuItems = filterMenuItems;
        window.formatCurrency = formatCurrency;
        window.showSuccessMessage = showSuccessMessage;

    })(); // end IIFE
</script>
