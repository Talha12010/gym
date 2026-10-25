<!-- Add Customer Modal -->
<div id="customerModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3 id="modalTitle">Add Customer</h3>
        <form id="customerForm" action="{{ route('customers.store') }}" method="POST">
            @csrf
            <input type="hidden" id="customer_id" name="id">
            <label>Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label>Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label>Password:</label>
            <input type="password" id="password" name="password">
            
            <button type="submit">Save</button>
        </form>
    </div>
</div>

<!-- Customer Management Section -->
<div>
    <h3>Manage Customers</h3>
    <button onclick="openModal()">Add</button>
    <button onclick="editCustomer()">Edit</button>
    <button onclick="deleteCustomer()">Delete</button>
    <button onclick="viewCustomer()">View</button>
</div>

<script>
    function openModal(customer = null) {
        document.getElementById('customerModal').style.display = 'block';
        if (customer) {
            document.getElementById('customer_id').value = customer.id;
            document.getElementById('name').value = customer.name;
            document.getElementById('email').value = customer.email;
            document.getElementById('password').style.display = 'none';
            document.getElementById('modalTitle').innerText = "Edit Customer";
        } else {
            document.getElementById('customerForm').reset();
            document.getElementById('password').style.display = 'block';
            document.getElementById('modalTitle').innerText = "Add Customer";
        }
    }

    function closeModal() {
        document.getElementById('customerModal').style.display = 'none';
    }

    function editCustomer() {
        let id = prompt("Enter Customer ID to Edit:");
        fetch(`/customers/${id}/edit`)
            .then(response => response.json())
            .then(customer => openModal(customer))
            .catch(error => alert("Customer not found"));
    }

    function deleteCustomer() {
        let id = prompt("Enter Customer ID to Delete:");
        if (confirm("Are you sure?")) {
            fetch(`/customers/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
                .then(() => location.reload())
                .catch(error => alert("Error deleting customer"));
        }
    }

    function viewCustomer() {
        let id = prompt("Enter Customer ID to View:");
        fetch(`/customers/${id}`)
            .then(response => response.json())
            .then(customer => alert(`Name: ${customer.name}\nEmail: ${customer.email}`))
            .catch(error => alert("Customer not found"));
    }
</script>

<style>
    .modal {
        display: none;
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        box-shadow: 0px 0px 10px gray;
    }
</style>
