<script>
    (function() {
        // ====================================
        // RESTAURANT ORDER SYSTEM - REFACTORED (NO ADD-ONS)
        // ====================================

        // ========== GLOBALS ==========
        let cart = [];
        let currentTotal = 0;
        let isEditMode = false;
        let editingItemId = null;
        let editingSaleId = null;

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

            return modal;
        }

        // Nama fungsi dipertahankan sebagai showAddOnsModal agar tombol di HTML (jika ada) tidak rusak
        function showAddOnsModal(menuId, menuName, menuPrice, menuCategory) {
            const modal = document.getElementById('addOnsModal') || createAddOnsModal();

            isEditMode = false;
            editingItemId = null;

            document.getElementById('modalMenuName').textContent = menuName;
            document.getElementById('modalMenuPrice').textContent = formatCurrency(menuPrice);

            document.getElementById('itemNote').value = '';

            const confirmBtn = document.getElementById('confirmAddToCart');
            confirmBtn.textContent = 'Tambah ke Pesanan';
            confirmBtn.dataset.originalQuantity = '';
            confirmBtn.dataset.editMode = '';

            // Attach confirm handler
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

            const total = basePrice;
            const modalTotal = document.getElementById('modalTotal');
            if (modalTotal) modalTotal.textContent = formatCurrency(total);
        }

        // ========== CART FUNCTIONS ==========
        function confirmAddToCart(menuId, menuName, menuPrice, menuCategory) {
            const itemsNote = document.getElementById('itemNote')?.value?.trim() || '';
            const totalItemPrice = (parseInt(menuPrice, 10) || 0);

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
                const noteHtml = item.note ?
                    `<div class="mb-2"><p class="text-xs font-medium text-gray-700">Catatan:</p><p class="text-xs text-gray-600 bg-yellow-50 p-2 rounded">${item.note}</p></div>` :
                    '';

                return `
                <div class="border-b border-gray-100 last:border-b-0 py-4">
                    <div class="flex items-start justify-between mb-2">
                        <div class="flex-1">
                            <h5 class="font-semibold text-gray-900">${item.name}</h5>
                            <p class="text-sm text-gray-600">Harga: ${formatCurrency(item.basePrice)}</p>
                        </div>
                        <button onclick="removeFromCart(${item.id})" class="text-red-600 hover:text-red-700 p-1">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                    </div>
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

            const payloadCart = cart.map(item => ({
                id: item.menuId,
                quantity: item.quantity,
                price: parseInt(item.basePrice, 10) || 0,
                subtotal: (item.totalPrice * item.quantity) || 0,
                note: item.note || ''
            }));

            const data = {
                cart: payloadCart,
                total: currentTotal,
                payment: customerMoney,
                change_return: change
            };

            closePaymentModal();

            const isEditingOrder = !!editingSaleId;
            const url = isEditingOrder ? `/transaksi/${editingSaleId}/update-order` : '/transaksi';
            const method = isEditingOrder ? 'PUT' : 'POST';

            fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                })
                .then(res => res.json())
                .then(response => {
                    if (response.success) {
                        showSuccessMessage(isEditingOrder ? 'Transaksi berhasil diperbarui' :
                            'Pesanan berhasil ditambahkan');
                        editingSaleId = null;
                        setTimeout(() => window.location.href = '/transaksi', 1000);
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

        // ========== MENU HELPERS & EDIT MODAL LOGIC ==========

        function editMenu(menuId) {
            fetch(`/menu/${menuId}/json`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editMenuForm').action = `/menu/${menuId}`;
                    document.getElementById('edit_nama_menu').value = data.name;
                    document.getElementById('edit_deskripsi').value = data.description || '';
                    document.getElementById('edit_harga').value = data.price;
                    document.getElementById('edit_kategori').value = data.category;

                    const previewBox = document.getElementById('edit_previewBox');
                    const previewImg = document.getElementById('edit_previewImage');
                    if (data.image) {
                        previewImg.src = `/storage/${data.image}`;
                        previewBox.classList.remove('hidden');
                    } else {
                        previewBox.classList.add('hidden');
                    }

                    const container = document.getElementById('edit_daftarBahan');
                    if (container) container.innerHTML = '';

                    if (data.menu_ingredients && data.menu_ingredients.length > 0) {
                        data.menu_ingredients.forEach(ing => {
                            addEditBahanRow(ing.product_id, ing.quantity);
                        });
                    } else {
                        addEditBahanRow();
                    }

                    updateEditRingkasan();
                    document.getElementById('editMenuModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching menu data:', error);
                    alert('Gagal mengambil data menu.');
                });
        }

        function closeEditModal() {
            const modal = document.getElementById('editMenuModal');
            if (modal) modal.classList.add('hidden');
        }

        // --- MODAL KONFIRMASI DELETE ---
        function openDeleteModal(actionUrl) {
            const modal = document.getElementById('deleteConfirmModal');
            const form = document.getElementById('deleteMenuForm');

            if (modal && form) {
                form.action = actionUrl;
                modal.classList.remove('hidden');
            }
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteConfirmModal');
            if (modal) {
                modal.classList.add('hidden');
            }
        }

        function addEditBahanRow(productId = '', quantity = '') {
            const templateEl = document.getElementById('editBahanTemplate');
            if (!templateEl) return;

            const template = templateEl.content.cloneNode(true);

            if (productId) template.querySelector('.edit-bahan-select').value = productId;
            if (quantity) template.querySelector('.edit-qty-input').value = quantity;

            document.getElementById('edit_daftarBahan').appendChild(template);
            updateEditRingkasan();
        }

        function updateEditRingkasan() {
            const items = document.querySelectorAll('#edit_daftarBahan .edit-bahan-item');
            let estimasiBiaya = 0;

            items.forEach(item => {
                const select = item.querySelector('.edit-bahan-select');
                const qty = parseFloat(item.querySelector('.edit-qty-input').value) || 0;
                const opt = select.options[select.selectedIndex];
                const price = parseFloat(opt?.dataset?.price) || 0;
                estimasiBiaya += (price * qty);
            });

            const hargaJual = parseFloat(document.getElementById('edit_harga')?.value) || 0;

            const totalBahanEl = document.getElementById('edit_totalBahan');
            const estimasiBiayaEl = document.getElementById('edit_estimasiBiaya');
            const hargaJualRingkasanEl = document.getElementById('edit_hargaJualRingkasan');

            if (totalBahanEl) totalBahanEl.textContent = items.length;
            if (estimasiBiayaEl) estimasiBiayaEl.textContent = formatCurrency(estimasiBiaya);
            if (hargaJualRingkasanEl) hargaJualRingkasanEl.textContent = formatCurrency(hargaJual);
        }

        function addNewMenu(menuData) {
            console.log('addNewMenu stub:', menuData);
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

            // ==== LOAD DATA EDIT TRANSAKSI (jika ada) ====
            if (window.editingSaleData) {
                editingSaleId = window.editingSaleData.id;
                cart = (window.editingSaleData.items || []).map(item => {
                    return {
                        id: Date.now() + Math.random(),
                        menuId: item.menuId,
                        name: item.name,
                        basePrice: item.basePrice,
                        note: item.note,
                        totalPrice: item.basePrice,
                        quantity: item.quantity,
                        category: item.category
                    };
                });

                const processBtn = document.getElementById('processOrder');
                if (processBtn) processBtn.innerHTML = '<i class="fas fa-save mr-2"></i>Update Pesanan';
            }

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
            const deleteConfirmModal = document.getElementById('deleteConfirmModal');
            if (deleteConfirmModal) {
                deleteConfirmModal.addEventListener('click', function(e) {
                    if (e.target === this) closeDeleteModal();
                });
            }

            // Filter & search bindings
            const menuSearch = document.getElementById('menuSearch');
            const categoryFilter = document.getElementById('categoryFilter');
            const clearCartBtn = document.getElementById('clearCart');

            if (menuSearch) menuSearch.addEventListener('input', filterMenuItems);
            if (categoryFilter) categoryFilter.addEventListener('change', filterMenuItems);
            if (clearCartBtn) clearCartBtn.addEventListener('click', clearCart);

            // EVENT BINDINGS UNTUK MODAL EDIT 
            const editHargaInput = document.getElementById('edit_harga');
            if (editHargaInput) {
                editHargaInput.addEventListener('input', updateEditRingkasan);
            }

            const editImageInput = document.getElementById('edit_imageInput');
            if (editImageInput) {
                editImageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const previewImg = document.getElementById('edit_previewImage');
                            const previewBox = document.getElementById('edit_previewBox');
                            if (previewImg && previewBox) {
                                previewImg.src = e.target.result;
                                previewBox.classList.remove('hidden');
                            }
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

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

        function cancelEditOrder() {
            fetch('/transaksi/cancel-edit', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(() => location.reload());
        }
        window.cancelEditOrder = cancelEditOrder;


        // ========== Expose for global onclick handlers ==========
        window.restaurantOrderSystem = {
            addToCart: showAddOnsModal, // Disimpan sebagai alias jika sebelumnya digunakan di HTML
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
            closeEditModal,
            openDeleteModal,
            closeDeleteModal,
            addEditBahanRow,
            updateEditRingkasan,
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
        window.closeEditModal = closeEditModal;
        window.openDeleteModal = openDeleteModal;
        window.closeDeleteModal = closeDeleteModal;
        window.addEditBahanRow = addEditBahanRow;
        window.updateEditRingkasan = updateEditRingkasan;
        window.filterMenuItems = filterMenuItems;
        window.formatCurrency = formatCurrency;
        window.showSuccessMessage = showSuccessMessage;

    })(); // end IIFE
</script>
